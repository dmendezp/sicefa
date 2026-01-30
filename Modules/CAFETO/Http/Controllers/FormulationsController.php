<?php

namespace Modules\CAFETO\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

use Modules\CAFETO\Http\Controllers\PUW;

use Modules\AGROINDUSTRIA\Entities\Formulation;
use Modules\AGROINDUSTRIA\Entities\Ingredient;

use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementDetail;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\WarehouseMovement;

class FormulationsController extends Controller
{
    private const MAX_AMOUNT = 100000;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ========================= VISTAS ========================= */

 public function index()
{
    $user = $this->getAuthenticatedUser();
    $this->authorizeByPermission('index');

    $query = Formulation::query()
        ->with(['element', 'ingredients.element'])
        ->orderByDesc('updated_at');

    // person_id real del usuario
    $person_id = $user->person ? $user->person->id : $user->id;

    if ($this->isRouteCashier()) {

        // ✅ Cajero:
        // - ve TODAS las aprobadas
        // - ve SOLO SUS pendientes
        $query->where(function ($q) use ($person_id) {

            // Aprobadas (legacy o JSON)
            $q->where(function ($qq) {
                $qq->where('proccess', 'approved')
                   ->orWhere('proccess', 'like', '%"status":"approved"%');
            })

            // Pendientes SOLO propias (legacy o JSON)
            ->orWhere(function ($qq) use ($person_id) {
                $qq->where('person_id', $person_id)
                   ->where(function ($q2) {
                       $q2->where('proccess', 'pending')
                          ->orWhere('proccess', 'like', '%"status":"pending"%')
                          ->orWhereNull('proccess')
                          ->orWhere('proccess', '');
                   });
            });
        });

    } elseif ($this->isRouteInstructor()) {

        // ✅ Instructor (según tu comentario): solo aprobadas
        $query->where(function ($q) {
            $q->where('proccess', 'approved')
              ->orWhere('proccess', 'like', '%"status":"approved"%');
        });

    } // Admin: todo (sin filtros)

    $formulations = $query->get();

    return view('cafeto::formulations.index', [
        'formulations' => $formulations,
        'view' => [
            'titlePage' => trans('cafeto::formulations.Title'),
            'titleView' => trans('cafeto::formulations.Title_Formulations'),
        ],
    ]);
}

    public function create()
    {
        $this->authorizeByPermission('create');

        return view('cafeto::formulations.create', [
            'elements' => Element::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
            'units' => [
                ['name' => 'Gramos', 'abbreviation' => 'g'],
                ['name' => 'Miligramos', 'abbreviation' => 'mg'],
                ['name' => 'Mililitros', 'abbreviation' => 'ml'],
            ],
            'destinations' => ['Venta', 'Producción', 'Consumo Interno'],
            'today' => now()->format('Y-m-d'),
            'max_amount' => self::MAX_AMOUNT,
            'view' => ['titlePage' => trans('cafeto::formulations.Create')]
        ]);
    }

    public function show(Formulation $formulation)
    {
        $user = $this->getAuthenticatedUser();
        $this->authorizeByPermission('show');

        if ($this->isRouteCashier()) {
    $meta = $this->parseProccessMeta($formulation->proccess);
    $status = $meta['status'] ?? 'pending';

    // ✅ Cajero: puede ver cualquier formulación APROBADA
    if ($status === 'approved') {
        // permitido
    } else {
        // ❌ Si NO está aprobada, solo puede ver las propias
        $person_id = $user->person ? $user->person->id : $user->id;
        if ((int) $formulation->person_id !== (int) $person_id) {
            abort(403, 'No autorizado');
        }
    }
}


        $formulation->load(['element.category', 'ingredients.element']);
        $meta = $this->parseProccessMeta($formulation->proccess);

        return view('cafeto::formulations.show', [
            'formulation' => $formulation,
            'formulation_status' => $meta['status'],
            'formulation_process_text' => $meta['process'],
            'view' => ['titlePage' => trans('cafeto::formulations.Show')]
        ]);
    }

public function edit(Formulation $formulation)
{
    $user = $this->getAuthenticatedUser();
    $this->authorizeByPermission('edit');

    if ($this->isRouteCashier()) {
        $meta = $this->parseProccessMeta($formulation->proccess);
        $status = $meta['status'] ?? 'pending';

        // ❌ Cajero NO edita aprobadas
        if ($status === 'approved') {
            abort(403, 'No autorizado');
        }

        // ✅ Cajero solo edita las propias
        $person_id = $user->person ? $user->person->id : $user->id;
        if ((int) $formulation->person_id !== (int) $person_id) {
            abort(403, 'No autorizado');
        }
    }

    $formulation->load(['element.category', 'ingredients.element']);
    $meta = $this->parseProccessMeta($formulation->proccess);

    return view('cafeto::formulations.edit', [
        'formulation' => $formulation,
        'formulation_status' => $meta['status'],
        'formulation_process_text' => $meta['process'],
        'elements' => Element::orderBy('name')->get(),
        'categories' => Category::orderBy('name')->get(),
        'units' => [
            ['name' => 'Gramos', 'abbreviation' => 'g'],
            ['name' => 'Miligramos', 'abbreviation' => 'mg'],
            ['name' => 'Mililitros', 'abbreviation' => 'ml'],
        ],
        'destinations' => ['Venta', 'Producción', 'Consumo Interno'],
        'max_amount' => self::MAX_AMOUNT,
        'view' => ['titlePage' => trans('cafeto::formulations.Edit')]
    ]);
}

    public function approve(Formulation $formulation)
{
    // ❌ Cajero nunca aprueba
    if ($this->isRouteCashier()) abort(403, 'No autorizado');

    

        $this->authorizeByPermission('approve');

        $formulation->load(['element.category', 'ingredients.element']);
        $meta = $this->parseProccessMeta($formulation->proccess);

        return view('cafeto::formulations.edit', [
            'formulation' => $formulation,
            'formulation_status' => $meta['status'],
            'formulation_process_text' => $meta['process'],
            'elements' => Element::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
            'units' => [
                ['name' => 'Gramos', 'abbreviation' => 'g'],
                ['name' => 'Miligramos', 'abbreviation' => 'mg'],
                ['name' => 'Mililitros', 'abbreviation' => 'ml'],
            ],
            'destinations' => ['Venta', 'Producción', 'Consumo Interno'],
            'is_approval_mode' => true,
            'max_amount' => self::MAX_AMOUNT,
            'view' => ['titlePage' => trans('cafeto::formulations.Approve')]
        ]);
    }

    /* ========================= ACCIONES ========================= */

    public function store(Request $request)
    {
        $this->authorizeByPermission('store');

        try {
            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'use_new_product' => 'nullable|in:0,1',
                'element_id' => 'nullable|exists:elements,id',
                'new_element_name' => 'nullable|string|max:255',

                'process' => 'nullable|string',

                'amount' => 'required|integer|min:1|max:' . self::MAX_AMOUNT,

                'produced_lot_number' => 'required|string|max:255',
                'produced_expiration_date' => 'nullable|date|after_or_equal:today',

                'produced_inventory_code' => 'nullable|integer|min:0',

                'produced_mark' => 'nullable|string|max:255',
                'produced_destination' => 'required|in:Venta,Producción,Consumo Interno',

                // ✅ NUEVO
                'sale_price' => 'nullable|numeric|min:0',

                'ingredients' => 'required|array|min:1',
                'ingredients.*.element_id' => 'required|exists:elements,id',
                'ingredients.*.amount' => 'required|numeric|min:0.000001',
                'ingredients.*.unit' => 'required|in:g,mg,ml',
            ], [
                'produced_inventory_code.integer' => 'El código de inventario debe contener únicamente números.',
                'produced_inventory_code.min' => 'El código de inventario no puede ser negativo.',
                'produced_lot_number.required' => 'El número de lote del producto producido es obligatorio.',
                'produced_destination.required' => 'Debes seleccionar el destino del producto producido.',
                'ingredients.required' => 'Debes agregar al menos un ingrediente.',
                'ingredients.*.amount.min' => 'La cantidad del ingrediente debe ser mayor que 0.',
            ]);

            $useNew = (string) $request->input('use_new_product', '0') === '1';

            if ($useNew) {
                if (!trim((string) $request->new_element_name)) {
                    throw ValidationException::withMessages([
                        'new_element_name' => 'Debes escribir el nombre del producto nuevo.',
                    ]);
                }
            } else {
                if (!$request->element_id) {
                    throw ValidationException::withMessages([
                        'element_id' => 'Debes seleccionar un producto.',
                    ]);
                }
            }

            // ✅ NUEVO: precio de venta (obligatorio si crea producto nuevo)
            $salePrice = $request->filled('sale_price') ? (float) $request->input('sale_price') : null;
            if ($useNew && $salePrice === null) {
                throw ValidationException::withMessages([
                    'sale_price' => 'Debes ingresar el precio de venta del producto nuevo.',
                ]);
            }

            $user = $this->getAuthenticatedUser();

            DB::beginTransaction();

            $elementIdToUse = $useNew
                ? $this->createElementFromRequest(trim((string) $request->new_element_name), (int) $request->category_id, $salePrice)
                : (int) $request->element_id;

            // ✅ NUEVO (opcional, no rompe): si elige existente y manda precio, actualiza Element.price
            if (!$useNew && $salePrice !== null) {
                $this->updateElementSalePriceIfProvided($elementIdToUse, $salePrice);
            }

            $productiveUnitId = $this->getProductiveUnitId($user);

            // Caja crea pendiente, otros crean aprobado
            $status = ($this->isRouteCashier()) ? 'pending' : 'approved';

            $person_id = $user->person ? $user->person->id : $user->id;

            $today = now()->format('Y-m-d');

            $processText = $request->filled('process') ? trim((string) $request->process) : null;
            $proccessStored = $this->buildProccessStoredValue($status, $processText);

            $inventoryCode = $request->filled('produced_inventory_code')
                ? (int) $request->input('produced_inventory_code')
                : null;

            $formulation = Formulation::create([
                'element_id' => (int) $elementIdToUse,
                'person_id' => (int) $person_id,
                'productive_unit_id' => (int) $productiveUnitId,
                'proccess' => $proccessStored,

                'amount' => (int) $request->amount,
                'date' => $today,

                'produced_expiration_date' => $request->produced_expiration_date,
                'produced_lot_number' => $request->produced_lot_number,
                'produced_inventory_code' => $inventoryCode,
                'produced_mark' => $request->produced_mark,
                'produced_destination' => $request->produced_destination,
            ]);

            foreach ($request->ingredients as $ingredientData) {
                Ingredient::create([
                    'formulation_id' => $formulation->id,
                    'element_id' => (int) $ingredientData['element_id'],
                    'amount' => $this->toDecimal($ingredientData['amount']), // BASE
                ]);
            }

            $alerts = [];

            if ($status === 'approved') {
                $formulation->load('ingredients.element', 'element');
                $alerts = $this->consumeInventory($formulation);
                $this->addFinalProductToInventory($formulation, $user);
            }

            DB::commit();

            $successMessage = trans('cafeto::formulations.Created');
            if (!empty($alerts)) $successMessage .= ' ' . implode(' ', $alerts);

            return redirect()
                ->route($this->getRedirectRouteByRoutePrefix() . '.formulations.index')
                ->with('success', $successMessage);

        } catch (ValidationException $e) {
            throw $e;

        } catch (\Throwable $e) {
            DB::rollBack();

            $userMsg = $this->humanizeDbException($e);

            Log::error('Failed to create formulation', [
                'error' => $e->getMessage(),
                'class' => get_class($e),
            ]);

            return back()->withInput()->withErrors([
                'error' => $userMsg,
            ]);
        }
    }

    public function update(Request $request, Formulation $formulation)
    {
        $this->authorizeByPermission('update');

        try {
            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'use_new_product' => 'nullable|in:0,1',
                'element_id' => 'nullable|exists:elements,id',
                'new_element_name' => 'nullable|string|max:255',

                'process' => 'nullable|string',

                'amount' => 'required|integer|min:1|max:' . self::MAX_AMOUNT,

                'produced_lot_number' => 'nullable|string|max:255',
                'produced_expiration_date' => 'nullable|date|after_or_equal:today',

                'produced_inventory_code' => 'nullable|integer|min:0',

                'produced_mark' => 'nullable|string|max:255',
                'produced_destination' => 'nullable|in:Venta,Producción,Consumo Interno',

                // ✅ NUEVO
                'sale_price' => 'nullable|numeric|min:0',

                'ingredients' => 'required|array|min:1',
                'ingredients.*.element_id' => 'required|exists:elements,id',
                'ingredients.*.amount' => 'required|numeric|min:0.000001',
                'ingredients.*.unit' => 'required|in:g,mg,ml',
            ], [
                'produced_inventory_code.integer' => 'El código de inventario debe contener únicamente números.',
                'produced_inventory_code.min' => 'El código de inventario no puede ser negativo.',
                'ingredients.required' => 'Debes agregar al menos un ingrediente.',
            ]);

            $useNew = (string) $request->input('use_new_product', '0') === '1';
            if ($useNew) {
                if (!trim((string) $request->new_element_name)) {
                    throw ValidationException::withMessages([
                        'new_element_name' => 'Debes escribir el nombre del producto nuevo.',
                    ]);
                }
            } else {
                if (!$request->element_id) {
                    throw ValidationException::withMessages([
                        'element_id' => 'Debes seleccionar un producto.',
                    ]);
                }
            }

            // ✅ NUEVO: precio de venta (obligatorio si crea producto nuevo)
            $salePrice = $request->filled('sale_price') ? (float) $request->input('sale_price') : null;
            if ($useNew && $salePrice === null) {
                throw ValidationException::withMessages([
                    'sale_price' => 'Debes ingresar el precio de venta del producto nuevo.',
                ]);
            }

            DB::beginTransaction();

            $formulation->load('ingredients');
            $oldAmount = (int) $formulation->amount;
            $oldIngredients = $formulation->ingredients->map(fn($i) => [
                'element_id' => (int) $i->element_id,
                'amount' => (float) $i->amount,
            ])->toArray();

            $elementIdToUse = $useNew
                ? $this->createElementFromRequest(trim((string) $request->new_element_name), (int) $request->category_id, $salePrice)
                : (int) $request->element_id;

            // ✅ NUEVO (opcional, no rompe): si elige existente y manda precio, actualiza Element.price
            if (!$useNew && $salePrice !== null) {
                $this->updateElementSalePriceIfProvided($elementIdToUse, $salePrice);
            }

            $meta = $this->parseProccessMeta($formulation->proccess);
            $currentStatus = $meta['status'] ?: 'pending';
            $currentProcess = $meta['process'];

            $newProcess = $request->has('process')
                ? (trim((string) $request->process) !== '' ? trim((string) $request->process) : null)
                : $currentProcess;

            $proccessStored = $this->buildProccessStoredValue($currentStatus, $newProcess);

            $inventoryCode = $request->filled('produced_inventory_code')
                ? (int) $request->input('produced_inventory_code')
                : null;

            $formulation->update([
                'element_id' => (int) $elementIdToUse,
                'amount' => (int) $request->amount,
                'proccess' => $proccessStored,

                'produced_expiration_date' => $request->has('produced_expiration_date') ? $request->produced_expiration_date : $formulation->produced_expiration_date,
                'produced_lot_number'      => $request->has('produced_lot_number') ? $request->produced_lot_number : $formulation->produced_lot_number,
                'produced_inventory_code'  => $request->has('produced_inventory_code') ? $inventoryCode : $formulation->produced_inventory_code,
                'produced_mark'            => $request->has('produced_mark') ? $request->produced_mark : $formulation->produced_mark,
                'produced_destination'     => $request->has('produced_destination') ? $request->produced_destination : $formulation->produced_destination,
            ]);

            $formulation->ingredients()->delete();
            foreach ($request->ingredients as $ingredient) {
                Ingredient::create([
                    'formulation_id' => $formulation->id,
                    'element_id' => (int) $ingredient['element_id'],
                    'amount' => $this->toDecimal($ingredient['amount']),
                ]);
            }

            $alerts = [];
            if ($currentStatus === 'approved') {
                $user = $this->getAuthenticatedUser();
                $formulation->load('ingredients.element', 'element');

                $alerts = $this->syncInventoryAfterUpdate(
                    $formulation,
                    $oldAmount,
                    $oldIngredients,
                    $user
                );
            }

            DB::commit();

            $msg = trans('cafeto::formulations.Updated');
            if (!empty($alerts)) $msg .= ' ' . implode(' ', $alerts);

            return redirect()
                ->route($this->getRedirectRouteByRoutePrefix() . '.formulations.index')
                ->with('success', $msg);

        } catch (ValidationException $e) {
            throw $e;

        } catch (\Throwable $e) {
            DB::rollBack();

            $userMsg = $this->humanizeDbException($e);

            Log::error('Failed to update formulation', [
                'error' => $e->getMessage(),
                'class' => get_class($e),
            ]);

            return back()->withInput()->withErrors([
                'error' => $userMsg,
            ]);
        }
    }

public function approveStore(Request $request, Formulation $formulation)
{
    // ❌ Cajero nunca aprueba
    if ($this->isRouteCashier()) abort(403, 'No autorizado');

        try {
            $request->validate([
                'produced_expiration_date' => 'nullable|date|after_or_equal:today',
                'produced_lot_number' => 'required|string|max:255',
                'produced_inventory_code' => 'nullable|integer|min:0',
                'produced_mark' => 'nullable|string|max:255',
                'produced_destination' => 'required|in:Venta,Producción,Consumo Interno',
            ], [
                'produced_inventory_code.integer' => 'El código de inventario debe contener únicamente números.',
                'produced_inventory_code.min' => 'El código de inventario no puede ser negativo.',
            ]);

            $user = $this->getAuthenticatedUser();

            DB::beginTransaction();

            $meta = $this->parseProccessMeta($formulation->proccess);
            $processText = $meta['process'];

            $inventoryCode = $request->filled('produced_inventory_code')
                ? (int) $request->input('produced_inventory_code')
                : null;

            $formulation->update([
                'proccess' => $this->buildProccessStoredValue('approved', $processText),
                'produced_expiration_date' => $request->produced_expiration_date,
                'produced_lot_number' => $request->produced_lot_number,
                'produced_inventory_code' => $inventoryCode,
                'produced_mark' => $request->produced_mark,
                'produced_destination' => $request->produced_destination,
            ]);

            $formulation->load('ingredients.element', 'element');

            $alerts = $this->consumeInventory($formulation);
            $this->addFinalProductToInventory($formulation, $user);

            DB::commit();

            $successMessage = trans('cafeto::formulations.Approved');
            if (!empty($alerts)) $successMessage .= ' ' . implode(' ', $alerts);

            return redirect()
                ->route($this->getRedirectRouteByRoutePrefix() . '.formulations.index')
                ->with('success', $successMessage);

        } catch (ValidationException $e) {
            throw $e;

        } catch (\Throwable $e) {
            DB::rollBack();

            $userMsg = $this->humanizeDbException($e);

            Log::error('Failed to approve formulation', [
                'error' => $e->getMessage(),
                'class' => get_class($e),
            ]);

            return back()->withInput()->withErrors([
                'error' => $userMsg,
            ]);
        }
    }

    public function destroy(Formulation $formulation)
    {
        $this->authorizeByPermission('destroy');

        try {
            $formulation->delete();

            return redirect()
                ->route($this->getRedirectRouteByRoutePrefix() . '.formulations.index')
                ->with('success', trans('cafeto::formulations.Deleted'));

        } catch (\Throwable $e) {
            $userMsg = $this->humanizeDbException($e);

            Log::error('Failed to delete formulation', [
                'error' => $e->getMessage(),
                'class' => get_class($e),
            ]);

            return back()->withErrors(['error' => $userMsg]);
        }
    }

    /* ========================= MENSAJES DE ERROR CLAROS ========================= */

    private function humanizeDbException(\Throwable $e): string
    {
        $msg = (string) $e->getMessage();

        if (str_contains($msg, 'Incorrect integer value') && str_contains($msg, 'inventory_code')) {
            return 'No se pudo guardar porque el Código de inventario debe contener solo números. Corrige el campo “Código de inventario” e intenta de nuevo.';
        }

        if (str_contains($msg, 'Duplicate entry')) {
            return 'No se pudo guardar porque ya existe un registro con datos repetidos. Revisa el número de lote o el código de inventario.';
        }

        if (str_contains($msg, 'foreign key constraint fails')) {
            return 'No se pudo guardar porque hay un dato relacionado que no existe o fue eliminado. Revisa el producto, la categoría y los ingredientes.';
        }

        if (str_contains($msg, 'cannot be null')) {
            return 'No se pudo guardar porque faltan campos obligatorios. Revisa los campos marcados con *.';
        }

        return 'No se pudo completar la operación. Revisa los datos e intenta nuevamente.';
    }

    /* ========================= SINCRONIZACIÓN INVENTARIO EN UPDATE ========================= */

    private function syncInventoryAfterUpdate(Formulation $formulation, int $oldAmount, array $oldIngredients, $user): array
    {
        $alerts = [];

        $oldTotals = [];
        foreach ($oldIngredients as $row) {
            $eid = (int) $row['element_id'];
            $base = (float) $row['amount'];
            $oldTotals[$eid] = ($oldTotals[$eid] ?? 0) + ($base * $oldAmount);
        }

        $newAmount = (int) $formulation->amount;
        $newTotals = [];
        foreach ($formulation->ingredients as $ing) {
            $eid = (int) $ing->element_id;
            $base = (float) $ing->amount;
            $newTotals[$eid] = ($newTotals[$eid] ?? 0) + ($base * $newAmount);
        }

        $allIds = array_unique(array_merge(array_keys($oldTotals), array_keys($newTotals)));

        foreach ($allIds as $elementId) {
            $oldT = (float) ($oldTotals[$elementId] ?? 0);
            $newT = (float) ($newTotals[$elementId] ?? 0);
            $diff = $newT - $oldT;

            if (abs($diff) < 0.0000001) continue;

            if ($diff > 0) {
                $alerts = array_merge($alerts, $this->deductIngredientDiff($formulation, $elementId, $diff));
            } else {
                $this->returnIngredientDiff($formulation, $user, $elementId, abs($diff));
            }
        }

        $oldFinal = $oldAmount;
        $newFinal = $newAmount;
        $finalDiff = $newFinal - $oldFinal;

        if ($finalDiff > 0) {
            $this->addFinalProductDiffToInventory($formulation, $user, $finalDiff);
        } elseif ($finalDiff < 0) {
            $alerts = array_merge($alerts, $this->deductFinalProductDiffFromInventory($formulation, abs($finalDiff)));
        }

        return $alerts;
    }

    private function deductIngredientDiff(Formulation $formulation, int $elementId, float $diff): array
    {
        $movementConsume = $this->createMovementWithWarehouse(
            'Baja',
            $formulation->id,
            'Ajuste por edición formulación #' . $formulation->id,
            'Entrega'
        );

        $alerts = [];

        $inventories = Inventory::where('element_id', $elementId)
            ->where('productive_unit_warehouse_id', PUW::getAppPuw()->id)
            ->where('amount', '>', 0)
            ->orderBy('production_date', 'asc')
            ->get();

        $available = (float) $inventories->sum('amount');
        if ($available < $diff) {
            $el = Element::find($elementId);
            $name = $el ? $el->name : ('Elemento #' . $elementId);
            $alerts[] = "Alerta: Stock insuficiente para {$name}. Disponible: {$available}, requerido: {$diff}.";
        }

        $remaining = $diff;

        foreach ($inventories as $inv) {
            if ($remaining <= 0) break;

            $deduct = min((float) $inv->amount, (float) $remaining);

            $inv->amount = (float) $inv->amount - (float) $deduct;
            $inv->save();

            $detail = new MovementDetail();
            $detail->movement_id = $movementConsume->id;
            $detail->inventory_id = $inv->id;
            $detail->amount = -1 * (float) $deduct;
            $detail->price = (float) $inv->price;
            $detail->save();

            $remaining -= $deduct;
        }

        return $alerts;
    }

    private function returnIngredientDiff(Formulation $formulation, $user, int $elementId, float $qty): void
    {
        $movementIn = $this->createMovementWithWarehouse(
            'Movimiento Entrada',
            $formulation->id,
            'Reintegro por edición formulación #' . $formulation->id,
            'Recibe'
        );

        $person_id = $user->person ? $user->person->id : $user->id;

        $el = Element::find($elementId);
        $price = ($el && $el->price !== null) ? (float) $el->price : 0;

        $inv = Inventory::create([
            'person_id' => (int) $person_id,
            'productive_unit_warehouse_id' => PUW::getAppPuw()->id,
            'element_id' => (int) $elementId,

            'destination' => 'Consumo Interno',
            'description' => 'Reintegro ajuste formulación #' . $formulation->id,

            'price' => $price,

            'amount' => (float) $qty,
            'stock' => (float) $qty,

            'production_date' => now()->format('Y-m-d'),
            'lot_number' => 'AJUSTE-FORM-' . $formulation->id,
            'expiration_date' => null,

            'state' => 'Disponible',
            'mark' => null,
            'inventory_code' => null,
        ]);

        $detail = new MovementDetail();
        $detail->movement_id = $movementIn->id;
        $detail->inventory_id = $inv->id;
        $detail->amount = (float) $qty;
        $detail->price = $price;
        $detail->save();
    }

    private function addFinalProductDiffToInventory(Formulation $formulation, $user, int $diffUnits): void
    {
        $movementIn = $this->createMovementWithWarehouse(
            'Movimiento Entrada',
            $formulation->id,
            'Ajuste (más producción) formulación #' . $formulation->id,
            'Recibe'
        );

        $person_id = $user->person ? $user->person->id : $user->id;

        $element = Element::find($formulation->element_id);
        $finalPrice = ($element && $element->price !== null) ? (float) $element->price : 0;

        $inventory = Inventory::create([
            'person_id' => (int) $person_id,
            'productive_unit_warehouse_id' => PUW::getAppPuw()->id,
            'element_id' => (int) $formulation->element_id,

            'destination' => (string) $formulation->produced_destination,
            'description' => 'Ajuste (más) por edición formulación #' . $formulation->id . " [FORM:{$formulation->id}]",

            'price' => $finalPrice,

            'amount' => (float) $diffUnits,
            'stock' => (float) $diffUnits,

            'production_date' => $formulation->date,
            'lot_number' => $formulation->produced_lot_number,
            'expiration_date' => $formulation->produced_expiration_date,

            'state' => 'Disponible',
            'mark' => $formulation->produced_mark,
            'inventory_code' => $formulation->produced_inventory_code,
        ]);

        $detail = new MovementDetail();
        $detail->movement_id = $movementIn->id;
        $detail->inventory_id = $inventory->id;
        $detail->amount = (float) $diffUnits;
        $detail->price = $finalPrice;
        $detail->save();
    }

    private function deductFinalProductDiffFromInventory(Formulation $formulation, int $diffUnits): array
    {
        $movementOut = $this->createMovementWithWarehouse(
            'Baja',
            $formulation->id,
            'Ajuste (menos producción) formulación #' . $formulation->id,
            'Entrega'
        );

        $alerts = [];

        $inventories = Inventory::where('element_id', $formulation->element_id)
            ->where('productive_unit_warehouse_id', PUW::getAppPuw()->id)
            ->where('amount', '>', 0)
            ->orderBy('production_date', 'asc')
            ->get();

        $available = (float) $inventories->sum('amount');
        if ($available < $diffUnits) {
            $el = Element::find($formulation->element_id);
            $name = $el ? $el->name : ('Elemento #' . $formulation->element_id);
            $alerts[] = "Alerta: Stock insuficiente para ajustar producto final {$name}. Disponible: {$available}, requerido: {$diffUnits}.";
        }

        $remaining = (float) $diffUnits;

        foreach ($inventories as $inv) {
            if ($remaining <= 0) break;

            $deduct = min((float) $inv->amount, (float) $remaining);

            $inv->amount = (float) $inv->amount - (float) $deduct;
            $inv->save();

            $detail = new MovementDetail();
            $detail->movement_id = $movementOut->id;
            $detail->inventory_id = $inv->id;
            $detail->amount = -1 * (float) $deduct;
            $detail->price = (float) $inv->price;
            $detail->save();

            $remaining -= $deduct;
        }

        return $alerts;
    }

    private function createMovementWithWarehouse(string $movementTypeName, int $voucherNumber, string $observation, string $role): Movement
    {
        $movementType = MovementType::where('name', $movementTypeName)->first();
        if (!$movementType) {
            throw new \Exception("Movement type \"{$movementTypeName}\" not found.");
        }

        $movement = new Movement();
        $movement->movement_type_id = $movementType->id;
        $movement->registration_date = now();
        $movement->state = 'Aprobado';
        $movement->price = 0;
        $movement->voucher_number = $voucherNumber;
        $movement->observation = $observation;
        $movement->save();

        $wm = new WarehouseMovement();
        $wm->productive_unit_warehouse_id = PUW::getAppPuw()->id;
        $wm->role = $role;
        $wm->movement_id = $movement->id;
        $wm->save();

        return $movement;
    }

    /* ========================= HELPERS PROCCESS (estado + proceso) ========================= */

    private function parseProccessMeta($value): array
    {
        $raw = is_null($value) ? '' : (string) $value;
        $rawTrim = trim($raw);

        if ($rawTrim === '') return ['status' => 'pending', 'process' => null];

        $decoded = json_decode($rawTrim, true);
        if (is_array($decoded) && (array_key_exists('status', $decoded) || array_key_exists('process', $decoded))) {
            $status = isset($decoded['status']) && is_string($decoded['status']) && $decoded['status'] !== ''
                ? $decoded['status']
                : 'pending';
            $process = isset($decoded['process']) && is_string($decoded['process']) && trim($decoded['process']) !== ''
                ? trim($decoded['process'])
                : null;
            return ['status' => $status, 'process' => $process];
        }

        if (in_array($rawTrim, ['approved', 'pending'], true)) return ['status' => $rawTrim, 'process' => null];

        return ['status' => $rawTrim, 'process' => null];
    }

    private function buildProccessStoredValue(string $status, ?string $processText): string
    {
        $status = $status ?: 'pending';
        $processText = ($processText !== null && trim($processText) !== '') ? trim($processText) : null;

        if ($processText === null) return $status;

        return json_encode([
            'status' => $status,
            'process' => $processText,
        ], JSON_UNESCAPED_UNICODE);
    }

    /* ========================= HELPERS AUTH/PERM ========================= */

    private function getAuthenticatedUser()
    {
        $user = Auth::user();
        if (!$user) abort(403, 'Debes iniciar sesión');
        return $user;
    }

private function authorizeByPermission(string $action): void
{
    $user = $this->getAuthenticatedUser();

    // prefijo devuelve: cafeto.admin | cafeto.cashier | cafeto.instructor
    $prefix = $this->getRoutePrefix();

    // slug final: cafeto.{role}.formulations.{action}
    $permissionSlug = "{$prefix}.formulations.{$action}";

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

    private function isRouteInstructor(): bool
    {
        return $this->getRoutePrefix() === 'cafeto.instructor';
    }

    private function getRedirectRouteByRoutePrefix(): string
    {
        return $this->getRoutePrefix();
    }

    private function getProductiveUnitId($user)
    {
        return $user->productive_unit_id ?? config('cafeto.default_productive_unit_id', 1);
    }

    /* ========================= HELPERS NUM ========================= */

    private function toDecimal($value): float
    {
        $v = trim((string) $value);
        $v = str_replace(' ', '', $v);
        $v = str_replace(',', '.', $v);
        $v = preg_replace('/[^0-9.]/', '', $v);

        if (substr_count($v, '.') > 1) {
            $parts = explode('.', $v);
            $v = array_shift($parts) . '.' . implode('', $parts);
        }

        return (float) $v;
    }

    /* ========================= PRODUCTO NUEVO (con price opcional) ========================= */

    private function createElementFromRequest(string $name, int $categoryId, ?float $salePrice = null): int
    {
        $name = trim($name);

        $existing = DB::table('elements')
            ->select('id')
            ->whereRaw('LOWER(name) = ?', [mb_strtolower($name)])
            ->whereNull('deleted_at')
            ->first();

        if ($existing) {
            // ✅ si ya existe y viene precio, lo actualiza
            if ($salePrice !== null) {
                $this->updateElementSalePriceIfProvided((int) $existing->id, (float) $salePrice);
            }
            return (int) $existing->id;
        }

        $template = DB::table('elements')
            ->select('measurement_unit_id', 'kind_of_purchase_id')
            ->whereNull('deleted_at')
            ->where('category_id', $categoryId)
            ->orderByDesc('id')
            ->first();

        if (!$template) {
            $template = DB::table('elements')
                ->select('measurement_unit_id', 'kind_of_purchase_id')
                ->whereNull('deleted_at')
                ->orderByDesc('id')
                ->first();
        }

        if (!$template) {
            throw new \Exception('No hay elementos existentes para obtener measurement_unit_id y kind_of_purchase_id.');
        }

        $measurementUnitId = (int) $template->measurement_unit_id;
        $kindOfPurchaseId  = (int) $template->kind_of_purchase_id;

        $baseSlug = Str::slug($name);
        if ($baseSlug === '') $baseSlug = 'producto';

        $slug = $baseSlug;
        $i = 2;
        while (DB::table('elements')->where('slug', $slug)->whereNull('deleted_at')->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        return (int) DB::table('elements')->insertGetId([
            'name' => $name,
            'measurement_unit_id' => $measurementUnitId,
            'kind_of_purchase_id' => $kindOfPurchaseId,
            'category_id' => $categoryId,
            'slug' => $slug,

            'description' => null,
            'price' => $salePrice, // ✅ queda con precio si se envía
            'UNSPSC_code' => null,
            'image' => null,

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function updateElementSalePriceIfProvided(int $elementId, float $salePrice): void
    {
        if (!is_finite($salePrice) || $salePrice < 0) return;

        DB::table('elements')
            ->where('id', $elementId)
            ->whereNull('deleted_at')
            ->update([
                'price' => $salePrice,
                'updated_at' => now(),
            ]);
    }

    /* ========================= INVENTARIO (approve/store) ========================= */

    private function consumeInventory(Formulation $formulation): array
    {
        $movementTypeBaja = MovementType::where('name', 'Baja')->first();
        if (!$movementTypeBaja) throw new \Exception('Movement type "Baja" not found.');

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

        $alerts = [];

        foreach ($formulation->ingredients as $ingredient) {
            $totalToDeduct = (float) $ingredient->amount * (int) $formulation->amount;

            $inventories = Inventory::where('element_id', $ingredient->element_id)
                ->where('productive_unit_warehouse_id', PUW::getAppPuw()->id)
                ->where('amount', '>', 0)
                ->orderBy('production_date', 'asc')
                ->get();

            $available = (float) $inventories->sum('amount');
            if ($available < $totalToDeduct) {
                $name = $ingredient->element ? $ingredient->element->name : ('Elemento #' . $ingredient->element_id);
                $alerts[] = "Alerta: Stock insuficiente para {$name}. Disponible: {$available}, requerido: {$totalToDeduct}.";
            }

            $totalToDeductCopy = $totalToDeduct;

            foreach ($inventories as $inv) {
                if ($totalToDeductCopy <= 0) break;

                $deduct = min((float) $inv->amount, (float) $totalToDeductCopy);

                $inv->amount = (float) $inv->amount - (float) $deduct;
                $inv->save();

                $movementDetail = new MovementDetail();
                $movementDetail->movement_id = $movementConsume->id;
                $movementDetail->inventory_id = $inv->id;
                $movementDetail->amount = -1 * (float) $deduct;
                $movementDetail->price = (float) $inv->price;
                $movementDetail->save();

                $totalToDeductCopy -= $deduct;
            }
        }

        return $alerts;
    }

    private function addFinalProductToInventory(Formulation $formulation, $user): void
    {
        $movementTypeEntrada = MovementType::where('name', 'Movimiento Entrada')->first();
        if (!$movementTypeEntrada) throw new \Exception('Movement type "Movimiento Entrada" not found.');

        $element = Element::find($formulation->element_id);
        $finalPrice = ($element && $element->price !== null) ? (float) $element->price : 0;

        $movementIn = new Movement();
        $movementIn->movement_type_id = $movementTypeEntrada->id;
        $movementIn->registration_date = now();
        $movementIn->state = 'Aprobado';
        $movementIn->price = $finalPrice;
        $movementIn->voucher_number = $formulation->id;
        $movementIn->observation = 'Producción por formulación #' . $formulation->id;
        $movementIn->save();

        $wmIn = new WarehouseMovement();
        $wmIn->productive_unit_warehouse_id = PUW::getAppPuw()->id;
        $wmIn->role = 'Recibe';
        $wmIn->movement_id = $movementIn->id;
        $wmIn->save();

        $person_id = $user->person ? $user->person->id : $user->id;

        $inventoryCode = $formulation->produced_inventory_code !== null && $formulation->produced_inventory_code !== ''
            ? (int) $formulation->produced_inventory_code
            : null;

        $inventory = Inventory::create([
            'person_id' => (int) $person_id,
            'productive_unit_warehouse_id' => PUW::getAppPuw()->id,
            'element_id' => (int) $formulation->element_id,

            'destination' => (string) $formulation->produced_destination,
            'description' => 'Producto final por formulación #' . $formulation->id . " [FORM:{$formulation->id}]",

            'price' => $finalPrice,

            'amount' => (float) $formulation->amount,
            'stock' => (float) $formulation->amount,

            'production_date' => $formulation->date,
            'lot_number' => $formulation->produced_lot_number,
            'expiration_date' => $formulation->produced_expiration_date,

            'state' => 'Disponible',
            'mark' => $formulation->produced_mark,
            'inventory_code' => $inventoryCode,
        ]);

        $detailIn = new MovementDetail();
        $detailIn->movement_id = $movementIn->id;
        $detailIn->inventory_id = $inventory->id;
        $detailIn->amount = (float) $formulation->amount;
        $detailIn->price = $finalPrice;
        $detailIn->save();
    }
}
