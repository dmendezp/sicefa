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

        $destinations = ['Venta', 'Producción', 'Consumo Interno']; // Hardcoded from enum values in inventory

        return view('cafeto::formulations.create', [
            'elements' => $elements,
            'units' => $units,
            'destinations' => $destinations,
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
            'element_id' => 'required|exists:elements,id',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'ingredients' => 'required|array|min:1',
            'ingredients.*.element_id' => 'required|exists:elements,id',
            'ingredients.*.amount' => 'required|numeric|min:0',
            'ingredients.*.unit' => 'required|in:g,mg,ml',
            // Nuevos campos para producto producido (no se guardan en BD, se usan en consume si approved)
            'produced_expiration_date' => 'nullable|date|after:date',
            'produced_lot_number' => 'required|string|max:255',
            'produced_inventory_code' => 'nullable|string|max:255',
            'produced_mark' => 'nullable|string|max:255',
            'produced_destination' => 'required|in:Venta,Producción,Consumo Interno',
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
                $producedData = $request->only([
                    'produced_expiration_date',
                    'produced_lot_number',
                    'produced_inventory_code',
                    'produced_mark',
                    'produced_destination'
                ]);
                $this->consumeInventory($formulation, $producedData);
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
     * Show the form for approving the specified formulation.
     *
     * @param \Modules\AGROINDUSTRIA\Entities\Formulation $formulation
     * @return \Illuminate\View\View
     */
    public function approve(Formulation $formulation)
    {
        $this->authorizeAdminOrInstructor();

        $units = [
            ['name' => 'Gramos', 'abbreviation' => 'g'],
            ['name' => 'Miligramos', 'abbreviation' => 'mg'],
            ['name' => 'Mililitros', 'abbreviation' => 'ml'],
        ];

        $destinations = ['Venta', 'Producción', 'Consumo Interno'];

        return view('cafeto::formulations.approve', [
            'formulation' => $formulation->load('ingredients.element', 'element'),
            'units' => $units,
            'destinations' => $destinations,
            'view' => ['titlePage' => trans('cafeto::formulations.Approve', [], 'Approve Formulation')]
        ]);
    }

    /**
     * Approve the specified formulation with produced data.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Modules\AGROINDUSTRIA\Entities\Formulation $formulation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approveStore(Request $request, Formulation $formulation)
    {
        $this->authorizeAdminOrInstructor();

        $request->validate([
            'produced_expiration_date' => 'nullable|date|after:date',
            'produced_lot_number' => 'required|string|max:255',
            'produced_inventory_code' => 'nullable|string|max:255',
            'produced_mark' => 'nullable|string|max:255',
            'produced_destination' => 'required|in:Venta,Producción,Consumo Interno',
        ]);

        try {
            $user = $this->getAuthenticatedUser();
            $formulation->update(['proccess' => 'approved']);

            $producedData = $request->only([
                'produced_expiration_date',
                'produced_lot_number',
                'produced_inventory_code',
                'produced_mark',
                'produced_destination'
            ]);

            $this->consumeInventory($formulation, $producedData);

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
     * @param array $producedData
     * @return void
     * @throws \Exception
     */
    private function consumeInventory(Formulation $formulation, array $producedData = [])
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

        $totalCost = 0; // Inicializar costo total de insumos

        foreach ($formulation->ingredients as $ingredient) {
            $totalToDeduct = $ingredient->amount * $formulation->amount;
            \Log::info('Consuming ingredient', ['element_id' => $ingredient->element_id, 'total_to_deduct' => $totalToDeduct]);

            $inventories = Inventory::where('element_id', $ingredient->element_id)
                ->where('productive_unit_warehouse_id', PUW::getAppPuw()->id)
                ->where('amount', '>', 0)
                ->orderBy('production_date', 'asc') // FIFO
                ->get();

            \Log::info('Available inventories for ingredient', ['element_id' => $ingredient->element_id, 'count' => $inventories->count(), 'total_available' => $inventories->sum('amount')]);

            if ($inventories->sum('amount') < $totalToDeduct) {
                throw new \Exception('Not enough stock for ingredient ' . $ingredient->element->name . '. Required: ' . $totalToDeduct . ', Available: ' . $inventories->sum('amount'));
            }

            foreach ($inventories as $inv) {
                if ($totalToDeduct <= 0) break;

                $deduct = min($inv->amount, $totalToDeduct);
                $inv->amount -= $deduct;
                $inv->save();

                // Acumular costo total basado en el precio del insumo y la cantidad deductida
                $totalCost += $deduct * $inv->price;

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

            // Calcular precio por unidad del producto producido (costo total / cantidad producida)
            $pricePerUnit = ($formulation->amount > 0) ? $totalCost / $formulation->amount : 0;

            // Create new Inventory for the produced product
            $newInventory = new Inventory();
            $newInventory->person_id = $formulation->person_id; // Asignar person_id para consistencia
            $newInventory->productive_unit_warehouse_id = PUW::getAppPuw()->id;
            $newInventory->element_id = $formulation->element_id;
            $newInventory->destination = $producedData['produced_destination'] ?? 'Venta'; // Usar del array o default
            $newInventory->price = $pricePerUnit; // Precio calculado basado en insumos
            $newInventory->amount = $formulation->amount;
            $newInventory->stock = 0; // Stock inicial
            $newInventory->production_date = $formulation->date;
            $newInventory->expiration_date = $producedData['produced_expiration_date'] ?? null;
            $newInventory->lot_number = $producedData['produced_lot_number'] ?? 'FORM-' . $formulation->id;
            $newInventory->inventory_code = $producedData['produced_inventory_code'] ?? null;
            $newInventory->state = 'Disponible';
            $newInventory->mark = $producedData['produced_mark'] ?? null;
            $newInventory->save();

            // Movement for adding produced product (Entry)
            $movementProduce = new Movement();
            $movementProduce->movement_type_id = $movementTypeEntry->id;
            $movementProduce->registration_date = now();
            $movementProduce->state = 'Aprobado';
            $movementProduce->price = $totalCost; // Precio total del movimiento (costo total de insumos)
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
            $movementDetailProduce->price = $pricePerUnit;
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