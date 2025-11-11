<?php

namespace Modules\CAFETO\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\AGROINDUSTRIA\Entities\Formulation;
use Modules\AGROINDUSTRIA\Entities\Ingredient;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementDetail;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\WarehouseMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FormulationsController extends Controller
{
    /**
     * Display a listing of the formulations.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = $this->getAuthenticatedUser();

        $formulations = collect();

        $roles = $user->roles->pluck('slug')->toArray();
        if (in_array('cafeto.admin', $roles) || in_array('cafeto.instructor', $roles)) {
            $formulations = Formulation::with(['element', 'ingredients.element'])->get();
        } elseif (in_array('cafeto.cashier', $roles)) {
            $person_id = $user->person ? $user->person->id : $user->id;
            $formulations = Formulation::with(['element', 'ingredients.element'])
                ->where('person_id', $person_id)
                ->get();
        } else {
            abort(403, trans('cafeto::errors.unauthorized', ['action' => 'view formulations']));
        }

        return view('cafeto::formulations.index', [
            'formulations' => $formulations,
            'view' => ['titlePage' => trans('cafeto::formulations.Title', [], 'Formulations')]
        ]);
    }

    /**
     * Show the form for creating a new formulation.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorizeFormulationAccess();

        $elements = Element::all();

        $units = [
            ['name' => 'Gramos', 'abbreviation' => 'g'],
            ['name' => 'Miligramos', 'abbreviation' => 'mg'],
            ['name' => 'Mililitros', 'abbreviation' => 'ml'],
        ];

        return view('cafeto::formulations.create', [
            'elements' => $elements,
            'units' => $units,
            'view' => ['titlePage' => trans('cafeto::formulations.Create', [], 'Create Formulation')]
        ]);
    }

    /**
     * Store a newly created formulation in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        \Log::info('Starting store method', $request->all());
        $this->authorizeFormulationAccess();

        $request->validate([
            'element_id' => 'nullable|exists:elements,id',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'ingredients' => 'required|array|min:1',
            'ingredients.*.element_id' => 'required|exists:elements,id',
            'ingredients.*.amount' => 'required|numeric|min:0',
            'ingredients.*.unit' => 'required|in:g,mg,ml', // Validación en el frontend
        ], [
            'ingredients.min' => trans('cafeto::formulations.validation.ingredients_required', [], 'At least one ingredient is required.')
        ]);

        try {
            \Log::info('Starting transaction');
            DB::beginTransaction();
            $user = $this->getAuthenticatedUser();
            \Log::info('User data', ['user_id' => $user->id, 'person_id' => $user->person ? $user->person->id : $user->id]);
            $productiveUnitId = $this->getProductiveUnitId($user);
            \Log::info('Productive unit ID', ['productive_unit_id' => $productiveUnitId]);
            $roles = $user->roles->pluck('slug')->toArray();
            $proccess = in_array('cafeto.cashier', $roles) ? 'pending' : 'approved';
            $person_id = $user->person ? $user->person->id : $user->id;

            $formulation = Formulation::create([
                'element_id' => $request->element_id,
                'person_id' => $person_id,
                'productive_unit_id' => $productiveUnitId,
                'proccess' => $proccess,
                'amount' => $request->amount,
                'date' => $request->date,
            ]);
            \Log::info('Formulation created', ['formulation_id' => $formulation->id]);

            foreach ($request->ingredients as $ingredient) {
                \Log::info('Creating ingredient', $ingredient);
                Ingredient::create([
                    'formulation_id' => $formulation->id,
                    'element_id' => $ingredient['element_id'],
                    'amount' => $ingredient['amount'],
                    // 'unit' no se guarda porque no está en $fillable
                ]);
            }

            if ($proccess === 'approved') {
                $this->consumeInventory($formulation);
            }

            DB::commit();
            \Log::info('Transaction committed', ['formulation_id' => $formulation->id]);
            return redirect()->route($this->getRedirectRoute($user) . '.formulations.index')
                ->with('success', trans('cafeto::formulations.Created', [], 'Formulation created successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Failed to create formulation', ['error' => $e->getMessage(), 'user_id' => Auth::id(), 'request' => $request->all()]);
            return back()->withErrors(['error' => trans('cafeto::formulations.errors.create_failed', [], 'Failed to create formulation. Please try again.') . ' Details: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified formulation.
     *
     * @param \Modules\AGROINDUSTRIA\Entities\Formulation $formulation
     * @return \Illuminate\View\View
     */
    public function edit(Formulation $formulation)
    {
        $this->authorizeAdminOrInstructor();

        $elements = Element::all();

        $units = [
            ['name' => 'Gramos', 'abbreviation' => 'g'],
            ['name' => 'Miligramos', 'abbreviation' => 'mg'],
            ['name' => 'Mililitros', 'abbreviation' => 'ml'],
        ];

        return view('cafeto::formulations.edit', [
            'formulation' => $formulation->load('ingredients.element'),
            'elements' => $elements,
            'units' => $units,
            'view' => ['titlePage' => trans('cafeto::formulations.Edit', [], 'Edit Formulation')]
        ]);
    }

    /**
     * Update the specified formulation in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Modules\AGROINDUSTRIA\Entities\Formulation $formulation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Formulation $formulation)
    {
        $this->authorizeAdminOrInstructor();

        $request->validate([
            'element_id' => 'nullable|exists:elements,id',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'ingredients' => 'required|array|min:1',
            'ingredients.*.element_id' => 'required|exists:elements,id',
            'ingredients.*.amount' => 'required|numeric|min:0',
            'ingredients.*.unit' => 'required|in:g,mg,ml',
        ], [
            'ingredients.min' => trans('cafeto::formulations.validation.ingredients_required', [], 'At least one ingredient is required.')
        ]);

        try {
            DB::beginTransaction();
            $user = $this->getAuthenticatedUser();

            $formulation->update([
                'element_id' => $request->element_id,
                'amount' => $request->amount,
                'date' => $request->date,
                'proccess' => $formulation->proccess,
            ]);

            $formulation->ingredients()->delete();

            foreach ($request->ingredients as $ingredient) {
                Ingredient::create([
                    'formulation_id' => $formulation->id,
                    'element_id' => $ingredient['element_id'],
                    'amount' => $ingredient['amount'],
                ]);
            }

            DB::commit();
            return redirect()->route($this->getRedirectRoute($user) . '.formulations.index')
                ->with('success', trans('cafeto::formulations.Updated', [], 'Formulation updated successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update formulation: ' . $e->getMessage(), ['user_id' => Auth::id(), 'formulation_id' => $formulation->id]);
            return back()->withErrors(['error' => trans('cafeto::formulations.errors.update_failed', [], 'Failed to update formulation. Please try again.') . ' Details: ' . $e->getMessage()]);
        }
    }

    /**
     * Approve the specified formulation.
     *
     * @param \Modules\AGROINDUSTRIA\Entities\Formulation $formulation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(Formulation $formulation)
    {
        $this->authorizeAdminOrInstructor();

        try {
            $user = $this->getAuthenticatedUser();
            $formulation->update(['proccess' => 'approved']);
            $this->consumeInventory($formulation);
            return redirect()->route($this->getRedirectRoute($user) . '.formulations.index')
                ->with('success', trans('cafeto::formulations.Approved', [], 'Formulation approved successfully.'));
        } catch (\Exception $e) {
            Log::error('Failed to approve formulation: ' . $e->getMessage(), ['user_id' => Auth::id(), 'formulation_id' => $formulation->id]);
            return back()->withErrors(['error' => trans('cafeto::formulations.errors.approve_failed', [], 'Failed to approve formulation. Please try again.') . ' Details: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified formulation from storage.
     *
     * @param \Modules\AGROINDUSTRIA\Entities\Formulation $formulation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Formulation $formulation)
    {
        $this->authorizeAdminOrInstructor();

        try {
            $user = $this->getAuthenticatedUser();
            $formulation->delete();
            return redirect()->route($this->getRedirectRoute($user) . '.formulations.index')
                ->with('success', trans('cafeto::formulations.Deleted', [], 'Formulation deleted successfully.'));
        } catch (\Exception $e) {
            Log::error('Failed to delete formulation: ' . $e->getMessage(), ['user_id' => Auth::id(), 'formulation_id' => $formulation->id]);
            return back()->withErrors(['error' => trans('cafeto::formulations.errors.delete_failed', [], 'Failed to delete formulation. Please try again.') . ' Details: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified formulation.
     *
     * @param \Modules\AGROINDUSTRIA\Entities\Formulation $formulation
     * @return \Illuminate\View\View
     */
    public function show(Formulation $formulation)
    {
        $user = $this->getAuthenticatedUser();

        $roles = $user->roles->pluck('slug')->toArray();
        if (in_array('cafeto.cashier', $roles)) {
            $person_id = $user->person ? $user->person->id : $user->id;
            if ($formulation->person_id !== $person_id) {
                abort(403, trans('cafeto::errors.unauthorized', ['action' => 'view this formulation']));
            }
        } elseif (!in_array('cafeto.admin', $roles) && !in_array('cafeto.instructor', $roles)) {
            abort(403, trans('cafeto::errors.unauthorized', ['action' => 'view formulations']));
        }

        return view('cafeto::formulations.show', [
            'formulation' => $formulation->load('ingredients.element', 'element'),
            'view' => ['titlePage' => trans('cafeto::formulations.Show', [], 'Formulation Details')]
        ]);
    }

    /**
     * Consume inventory based on the formulation ingredients and add the produced product to inventory.
     *
     * @param Formulation $formulation
     * @return void
     * @throws \Exception
     */
    private function consumeInventory(Formulation $formulation)
    {
        $movementTypeBaja = MovementType::where('name', 'Baja')->first();
        if (!$movementTypeBaja) {
            throw new \Exception('Movement type "Baja" not found.');
        }

        // Movement for consuming ingredients (Baja)
        $movementConsume = new Movement();
        $movementConsume->movement_type_id = $movementTypeBaja->id;
        $movementConsume->registration_date = now();
        $movementConsume->state = 'Aprobado';
        $movementConsume->price = 0; // Set to 0 or calculate if needed
        $movementConsume->voucher_number = $formulation->id; // Use integer ID
        $movementConsume->save();

        $warehouseMovementConsume = new WarehouseMovement();
        $warehouseMovementConsume->productive_unit_warehouse_id = PUW::getAppPuw()->id;
        $warehouseMovementConsume->role = 'Entrega';
        $warehouseMovementConsume->movement_id = $movementConsume->id;
        $warehouseMovementConsume->save();

        foreach ($formulation->ingredients as $ingredient) {
            $totalToDeduct = $ingredient->amount * $formulation->amount;

            $inventories = Inventory::where('element_id', $ingredient->element_id)
                ->where('productive_unit_warehouse_id', PUW::getAppPuw()->id)
                ->where('amount', '>', 0)
                ->orderBy('production_date', 'asc') // FIFO
                ->get();

            foreach ($inventories as $inv) {
                if ($totalToDeduct <= 0) break;

                $deduct = min($inv->amount, $totalToDeduct);
                $inv->amount -= $deduct;
                $inv->save();

                $movementDetail = new MovementDetail();
                $movementDetail->movement_id = $movementConsume->id;
                $movementDetail->inventory_id = $inv->id;
                $movementDetail->amount = - $deduct;
                $movementDetail->price = $inv->price;
                $movementDetail->save();

                $totalToDeduct -= $deduct;
            }

            if ($totalToDeduct > 0) {
                throw new \Exception('Not enough stock for ingredient ' . $ingredient->element->name);
            }
        }

        // Add the produced product to inventory if element_id is set
        if ($formulation->element_id) {
            $movementTypeEntry = MovementType::where('name', 'Movimiento Interno')->first(); // Assuming 'Movimiento Interno' is for entries
            if (!$movementTypeEntry) {
                throw new \Exception('Movement type "Movimiento Interno" not found.');
            }

            // Create new Inventory for the produced product
            $newInventory = new Inventory();
            $newInventory->productive_unit_warehouse_id = PUW::getAppPuw()->id;
            $newInventory->element_id = $formulation->element_id;
            $newInventory->amount = $formulation->amount;
            $newInventory->price = 0; // Set price to 0 or calculate based on ingredients if needed
            $newInventory->production_date = $formulation->date;
            $newInventory->expiration_date = null; // Set if needed
            $newInventory->lot_number = 'FORM-' . $formulation->id; // Generate lot number
            $newInventory->inventory_code = null; // Set if needed
            $newInventory->state = 'Disponible';
            $newInventory->destination = null; // Set if needed
            $newInventory->description = 'Origen: Agroindustria';
            $newInventory->save();

            // Movement for adding produced product (Entry)
            $movementProduce = new Movement();
            $movementProduce->movement_type_id = $movementTypeEntry->id;
            $movementProduce->registration_date = now();
            $movementProduce->state = 'Aprobado';
            $movementProduce->price = 0; // Set to 0 or calculate
            $movementProduce->voucher_number = $formulation->id; // Use integer ID
            $movementProduce->save();

            $warehouseMovementProduce = new WarehouseMovement();
            $warehouseMovementProduce->productive_unit_warehouse_id = PUW::getAppPuw()->id;
            $warehouseMovementProduce->role = 'Recibe'; // Receiving the produced product
            $warehouseMovementProduce->movement_id = $movementProduce->id;
            $warehouseMovementProduce->save();

            // Movement Detail for the produced product
            $movementDetailProduce = new MovementDetail();
            $movementDetailProduce->movement_id = $movementProduce->id;
            $movementDetailProduce->inventory_id = $newInventory->id;
            $movementDetailProduce->amount = $formulation->amount;
            $movementDetailProduce->price = $newInventory->price;
            $movementDetailProduce->save();
        }
    }

    /**
     * Get the authenticated user or abort if unauthenticated.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    private function getAuthenticatedUser()
    {
        $user = Auth::user();
        if (!$user) {
            abort(403, trans('cafeto::errors.unauthenticated', [], 'Please log in to access this page.'));
        }
        return $user;
    }

    /**
     * Authorize access for creating or viewing formulations.
     *
     * @return void
     */
    private function authorizeFormulationAccess()
    {
        $user = $this->getAuthenticatedUser();
        $roles = $user->roles->pluck('slug')->toArray();
        if (!in_array('cafeto.admin', $roles) &&
            !in_array('cafeto.instructor', $roles) &&
            !in_array('cafeto.cashier', $roles)) {
            abort(403, trans('cafeto::errors.unauthorized', ['action' => 'perform this action']));
        }
    }

    /**
     * Authorize access for admin or instructor actions (edit, update, approve, destroy).
     *
     * @return void
     */
    private function authorizeAdminOrInstructor()
    {
        $user = $this->getAuthenticatedUser();
        $roles = $user->roles->pluck('slug')->toArray();
        if (!in_array('cafeto.admin', $roles) && !in_array('cafeto.instructor', $roles)) {
            abort(403, trans('cafeto::errors.unauthorized', ['action' => 'perform this action']));
        }
    }

    /**
     * Get the redirect route prefix based on user role.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @return string
     */
    private function getRedirectRoute($user)
    {
        $roles = $user->roles->pluck('slug')->toArray();
        if (in_array('cafeto.admin', $roles)) {
            return 'cafeto.admin';
        } elseif (in_array('cafeto.instructor', $roles)) {
            return 'cafeto.instructor';
        } elseif (in_array('cafeto.cashier', $roles)) {
            return 'cafeto.cashier';
        }
        Log::warning('User has no valid formulation permission for redirect', ['user_id' => $user->id]);
        return 'cafeto.cashier'; // Default fallback
    }

    /**
     * Get the productive unit ID for the user.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @return int|null
     */
    private function getProductiveUnitId($user)
    {
        if (!$user->productive_unit_id) {
            Log::warning('User has no productive unit ID, using fallback', ['user_id' => $user->id]);
        }
        return $user->productive_unit_id ?? config('cafeto.default_productive_unit_id', 1);
    }
}