<?php

namespace Modules\CAFETO\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Modules\AGROINDUSTRIA\Entities\Formulation;
use Modules\AGROINDUSTRIA\Entities\Ingredient;

use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementDetail;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\WarehouseMovement;

class FormulationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ========================= VISTAS ========================= */

    public function index()
    {
        $user = $this->getAuthenticatedUser();
        $this->authorizeByPermission('index');

        if ($this->isRouteCashier()) {
            $person_id = $user->person ? $user->person->id : $user->id;

            $formulations = Formulation::with(['element', 'ingredients.element'])
                ->where('person_id', $person_id)
                ->get();
        } else {
            $formulations = Formulation::with(['element', 'ingredients.element'])->get();
        }

        return view('cafeto::formulations.index', [
            'formulations' => $formulations,
            'view' => ['titlePage' => trans('cafeto::formulations.Title', [], 'Formulations')]
        ]);
    }

    public function create()
    {
        $this->authorizeByPermission('create');

        return view('cafeto::formulations.create', [
            'elements' => Element::all(),
            'units' => [
                ['name' => 'Gramos', 'abbreviation' => 'g'],
                ['name' => 'Miligramos', 'abbreviation' => 'mg'],
                ['name' => 'Mililitros', 'abbreviation' => 'ml'],
            ],
            'destinations' => ['Venta', 'Producción', 'Consumo Interno'],
            'today' => now()->format('Y-m-d'),
            'view' => ['titlePage' => trans('cafeto::formulations.Create', [], 'Create Formulation')]
        ]);
    }

    public function show(Formulation $formulation)
    {
        $user = $this->getAuthenticatedUser();
        $this->authorizeByPermission('show');

        if ($this->isRouteCashier()) {
            $person_id = $user->person ? $user->person->id : $user->id;
            if ((int) $formulation->person_id !== (int) $person_id) {
                abort(403, 'No autorizado');
            }
        }

        return view('cafeto::formulations.show', [
            'formulation' => $formulation->load('ingredients.element', 'element'),
            'view' => ['titlePage' => trans('cafeto::formulations.Show', [], 'Formulation Details')]
        ]);
    }

    public function edit(Formulation $formulation)
    {
        $this->authorizeByPermission('edit');

        return view('cafeto::formulations.edit', [
            'formulation' => $formulation->load('ingredients.element'),
            'elements' => Element::all(),
            'units' => [
                ['name' => 'Gramos', 'abbreviation' => 'g'],
                ['name' => 'Miligramos', 'abbreviation' => 'mg'],
                ['name' => 'Mililitros', 'abbreviation' => 'ml'],
            ],
            'view' => ['titlePage' => trans('cafeto::formulations.Edit', [], 'Edit Formulation')]
        ]);
    }

    public function approve(Formulation $formulation)
    {
        $this->authorizeByPermission('approve');

        return view('cafeto::formulations.approve', [
            'formulation' => $formulation->load('ingredients.element', 'element'),
            'units' => [
                ['name' => 'Gramos', 'abbreviation' => 'g'],
                ['name' => 'Miligramos', 'abbreviation' => 'mg'],
                ['name' => 'Mililitros', 'abbreviation' => 'ml'],
            ],
            'destinations' => ['Venta', 'Producción', 'Consumo Interno'],
            'view' => ['titlePage' => trans('cafeto::formulations.Approve', [], 'Approve Formulation')]
        ]);
    }

    /* ========================= ACCIONES ========================= */

    public function store(Request $request)
    {
        $this->authorizeByPermission('store');

        $request->validate([
            'element_id' => 'required|exists:elements,id',

            // Cantidad FINAL: ENTERO
            'amount' => 'required|integer|min:1',

            // Fecha: NO se modifica, no se valida desde input
            // 'date' => 'required|date',

            'produced_lot_number' => 'required|string|max:255',

            // Expiración: >= HOY (no depende de "date")
            'produced_expiration_date' => 'nullable|date|after_or_equal:today',

            'produced_inventory_code' => 'nullable|string|max:255',
            'produced_mark' => 'nullable|string|max:255',
            'produced_destination' => 'required|in:Venta,Producción,Consumo Interno',

            'ingredients' => 'required|array|min:1',
            'ingredients.*.element_id' => 'required|exists:elements,id',

            // Ingredientes pueden ser decimales (g/ml/mg)
            'ingredients.*.amount' => 'required|numeric|min:0.001',
            'ingredients.*.unit' => 'required|in:g,mg,ml',
        ]);

        $user = $this->getAuthenticatedUser();

        try {
            DB::beginTransaction();

            $productiveUnitId = $this->getProductiveUnitId($user);
            $proccess = ($this->isRouteCashier()) ? 'pending' : 'approved';
            $person_id = $user->person ? $user->person->id : $user->id;

            // Fecha fija (HOY), no depende del formulario
            $today = now()->format('Y-m-d');

            $formulation = Formulation::create([
                'element_id' => (int) $request->element_id,
                'person_id' => (int) $person_id,
                'productive_unit_id' => (int) $productiveUnitId,
                'proccess' => $proccess,

                // Entero garantizado
                'amount' => (int) $request->amount,

                // Fecha fija
                'date' => $today,

                'produced_expiration_date' => $request->produced_expiration_date,
                'produced_lot_number' => $request->produced_lot_number,
                'produced_inventory_code' => $request->produced_inventory_code,
                'produced_mark' => $request->produced_mark,
                'produced_destination' => $request->produced_destination,
            ]);

            foreach ($request->ingredients as $ingredientData) {
                Ingredient::create([
                    'formulation_id' => $formulation->id,
                    'element_id' => (int) $ingredientData['element_id'],
                    'amount' => (float) $ingredientData['amount'],
                ]);
            }

            $alerts = [];
            if ($proccess === 'approved') {
                // recarga ingredientes para consumeInventory
                $formulation->load('ingredients.element');
                $alerts = $this->consumeInventory($formulation);
            }

            DB::commit();

            $successMessage = trans('cafeto::formulations.Created', [], 'Formulation created successfully.');
            if (!empty($alerts)) $successMessage .= ' ' . implode(' ', $alerts);

            return redirect()
                ->route($this->getRedirectRouteByRoutePrefix() . '.formulations.index')
                ->with('success', $successMessage);

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Failed to create formulation', ['error' => $e->getMessage()]);
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error al crear la formulación: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, Formulation $formulation)
    {
        $this->authorizeByPermission('update');

        $request->validate([
            'element_id' => 'nullable|exists:elements,id',
            'amount' => 'required|integer|min:1',
            'produced_lot_number' => 'required|string|max:255',
            'produced_expiration_date' => 'nullable|date|after_or_equal:today',
            'produced_inventory_code' => 'nullable|string|max:255',
            'produced_mark' => 'nullable|string|max:255',
            'produced_destination' => 'required|in:Venta,Producción,Consumo Interno',
            'ingredients' => 'required|array|min:1',
            'ingredients.*.element_id' => 'required|exists:elements,id',
            'ingredients.*.amount' => 'required|numeric|min:0.001',
            'ingredients.*.unit' => 'required|in:g,mg,ml',
        ]);

        try {
            DB::beginTransaction();

            // No permitimos cambiar "date": queda como está en BD
            $formulation->update([
                'element_id' => $request->element_id ? (int) $request->element_id : null,
                'amount' => (int) $request->amount,
                'produced_expiration_date' => $request->produced_expiration_date,
                'produced_lot_number' => $request->produced_lot_number,
                'produced_inventory_code' => $request->produced_inventory_code,
                'produced_mark' => $request->produced_mark,
                'produced_destination' => $request->produced_destination,
            ]);

            $formulation->ingredients()->delete();

            foreach ($request->ingredients as $ingredient) {
                Ingredient::create([
                    'formulation_id' => $formulation->id,
                    'element_id' => (int) $ingredient['element_id'],
                    'amount' => (float) $ingredient['amount'],
                ]);
            }

            DB::commit();

            return redirect()
                ->route($this->getRedirectRouteByRoutePrefix() . '.formulations.index')
                ->with('success', trans('cafeto::formulations.Updated', [], 'Formulation updated successfully.'));

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error al actualizar: ' . $e->getMessage()]);
        }
    }

    public function approveStore(Request $request, Formulation $formulation)
    {
        $this->authorizeByPermission('approve.store');

        $request->validate([
            'produced_expiration_date' => 'nullable|date|after_or_equal:today',
            'produced_lot_number' => 'required|string|max:255',
            'produced_inventory_code' => 'nullable|string|max:255',
            'produced_mark' => 'nullable|string|max:255',
            'produced_destination' => 'required|in:Venta,Producción,Consumo Interno',
        ]);

        try {
            $formulation->update([
                'proccess' => 'approved',
                'produced_expiration_date' => $request->produced_expiration_date,
                'produced_lot_number' => $request->produced_lot_number,
                'produced_inventory_code' => $request->produced_inventory_code,
                'produced_mark' => $request->produced_mark,
                'produced_destination' => $request->produced_destination,
            ]);

            $formulation->load('ingredients.element');
            $alerts = $this->consumeInventory($formulation);

            $successMessage = trans('cafeto::formulations.Approved', [], 'Formulation approved successfully.');
            if (!empty($alerts)) $successMessage .= ' ' . implode(' ', $alerts);

            return redirect()
                ->route($this->getRedirectRouteByRoutePrefix() . '.formulations.index')
                ->with('success', $successMessage);

        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Error al aprobar: ' . $e->getMessage()]);
        }
    }

    public function destroy(Formulation $formulation)
    {
        $this->authorizeByPermission('destroy');

        try {
            $formulation->delete();

            return redirect()
                ->route($this->getRedirectRouteByRoutePrefix() . '.formulations.index')
                ->with('success', trans('cafeto::formulations.Deleted', [], 'Formulation deleted successfully.'));

        } catch (\Throwable $e) {
            return back()->withErrors(['error' => 'Error al eliminar: ' . $e->getMessage()]);
        }
    }

    /* ========================= HELPERS ========================= */

    private function getAuthenticatedUser()
    {
        $user = Auth::user();
        if (!$user) abort(403, 'Debes iniciar sesión');
        return $user;
    }

    private function authorizeByPermission(string $action): void
    {
        $user = $this->getAuthenticatedUser();

        $prefix = $this->getRoutePrefix();
        $permissionSlug = $prefix . '.formulations.' . $action;

        if ($action === 'approve.store') {
            $permissionSlug = $prefix . '.formulations.approve.store';
        }

        if (!$user->havePermission($permissionSlug)) {
            abort(403, 'No autorizado');
        }
    }

    private function getRoutePrefix(): string
    {
        $name = request()->route()?->getName() ?? '';

        if (str_starts_with($name, 'cafeto.admin.')) return 'cafeto.admin';
        if (str_starts_with($name, 'cafeto.instructor.')) return 'cafeto.instructor';
        return 'cafeto.cashier';
    }

    private function isRouteCashier(): bool
    {
        return $this->getRoutePrefix() === 'cafeto.cashier';
    }

    private function getRedirectRouteByRoutePrefix(): string
    {
        return $this->getRoutePrefix();
    }

    private function getProductiveUnitId($user)
    {
        return $user->productive_unit_id ?? config('cafeto.default_productive_unit_id', 1);
    }

    /* ========================= INVENTARIO (TU MÉTODO ORIGINAL) ========================= */
    private function consumeInventory(Formulation $formulation)
    {
        $movementTypeBaja = MovementType::where('name', 'Baja')->first();
        if (!$movementTypeBaja) {
            throw new \Exception('Movement type "Baja" not found.');
        }

        $movementConsume = new Movement();
        $movementConsume->movement_type_id = $movementTypeBaja->id;
        $movementConsume->registration_date = now();
        $movementConsume->state = 'Aprobado';
        $movementConsume->price = 0;
        $movementConsume->voucher_number = $formulation->id;
        $movementConsume->save();

        $warehouseMovementConsume = new WarehouseMovement();
        $warehouseMovementConsume->productive_unit_warehouse_id = PUW::getAppPuw()->id;
        $warehouseMovementConsume->role = 'Entrega';
        $warehouseMovementConsume->movement_id = $movementConsume->id;
        $warehouseMovementConsume->save();

        $totalCost = 0;
        $alerts = [];

        foreach ($formulation->ingredients as $ingredient) {
            // ingredient->amount puede ser decimal, formulation->amount entero
            $totalToDeduct = (float) $ingredient->amount * (int) $formulation->amount;

            $inventories = Inventory::where('element_id', $ingredient->element_id)
                ->where('productive_unit_warehouse_id', PUW::getAppPuw()->id)
                ->where('amount', '>', 0)
                ->orderBy('production_date', 'asc')
                ->get();

            $available = $inventories->sum('amount');
            if ($available < $totalToDeduct) {
                $alerts[] = "Alerta: Stock insuficiente para {$ingredient->element->name}. Disponible: {$available}, requerido: {$totalToDeduct}.";
            }

            $totalToDeductCopy = $totalToDeduct;

            foreach ($inventories as $inv) {
                if ($totalToDeductCopy <= 0) break;

                $deduct = min($inv->amount, $totalToDeductCopy);
                $inv->amount -= $deduct;
                $inv->save();

                $totalCost += $deduct * $inv->price;

                $movementDetail = new MovementDetail();
                $movementDetail->movement_id = $movementConsume->id;
                $movementDetail->inventory_id = $inv->id;
                $movementDetail->amount = -$deduct;
                $movementDetail->price = $inv->price;
                $movementDetail->save();

                $totalToDeductCopy -= $deduct;
            }
        }

        return $alerts;
    }
}
