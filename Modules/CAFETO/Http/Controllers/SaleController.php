<?php

namespace Modules\CAFETO\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;

use Modules\SICA\Entities\CashCount;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\MovementDetail;
use Modules\SICA\Entities\Inventory;
use Modules\AGROINDUSTRIA\Entities\Formulation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

// ✅ TU PUW está en Controllers, no en Entities
use Modules\CAFETO\Http\Controllers\PUW;

class SaleController extends Controller
{
    public function index()
    {
        $view = [
            'titlePage' => trans('cafeto::controllers.CAFETO_sale_index_title_page'),
            'titleView' => trans('cafeto::controllers.CAFETO_sale_index_title_view')
        ];

        $app_puw = PUW::getAppPuw();
        $cashCount = CashCount::where('productive_unit_warehouse_id', $app_puw->id)
            ->where('state', 'Abierta')
            ->first();

        if ($cashCount) {
            $movement_type = MovementType::where('name', 'Venta')->first();
            $sales = Movement::where('movement_type_id', $movement_type->id)
                ->whereHas('warehouse_movements', function ($query) use ($app_puw) {
                    $query->where('productive_unit_warehouse_id', $app_puw->id)->where('role', 'Entrega');
                })
                ->where('registration_date', '>=', $cashCount->opening_date)
                ->with(['movement_details.inventory.element'])
                ->orderBy('registration_date', 'DESC')
                ->get();

            return view('cafeto::sale.index', compact('view', 'sales', 'cashCount'));
        }

        return view('cafeto::sale.index', compact('view', 'cashCount'));
    }

   public function register(Request $request, $element_id = null)
{
    $app_puw = PUW::getAppPuw();
    $open_cash_count = CashCount::where('productive_unit_warehouse_id', $app_puw->id)
        ->where('state', 'Abierta')
        ->first();

    if (!$open_cash_count) {
        return redirect(route('cafeto.' . $this->getRoleRouteName() . '.sale.index'))
            ->with('error', trans('cafeto::cash.TextFailedOpen'));
    }

    $formulations = Formulation::where('proccess', 'approved')
        ->whereHas('element', function ($query) {
            if (Schema::hasColumn('elements', 'is_intermediate')) {
                $query->where('is_intermediate', false);
            }
        })
        ->with('element')
        ->get();

    // ✅ element_id recibido por URL (/register/{id}) o por query (?element_id=)
    $preselectedElementId = $element_id ?? $request->query('element_id');

    $view = [
        'titlePage' => trans('cafeto::controllers.CAFETO_sale_register_title_page'),
        'titleView' => trans('cafeto::controllers.CAFETO_sale_register_title_view')
    ];

    return view('cafeto::sale.register', compact('view', 'formulations', 'preselectedElementId'));
}

    public function store(Request $request)
    {
        $request->validate([
            'formulation_id' => 'required|exists:formulations,id',
            'quantity'       => 'required|integer|min:1',
            'customer_id'    => 'nullable|string|max:255',
            'is_internal'    => 'boolean',
        ]);

        $app_puw = PUW::getAppPuw();

        $cashCount = CashCount::where('productive_unit_warehouse_id', $app_puw->id)
            ->where('state', 'Abierta')
            ->first();

        if (!$cashCount) {
            return redirect(route('cafeto.' . $this->getRoleRouteName() . '.sale.index'))
                ->with('error', trans('cafeto::cash.TextFailedOpen'));
        }

        $formulation = Formulation::with('element')->findOrFail($request->formulation_id);

        if ($formulation->proccess !== 'approved') {
            return redirect()->back()->withErrors(['formulation' => 'La formulación no está aprobada.']);
        }

        if (
            $formulation->element &&
            Schema::hasColumn('elements', 'is_intermediate') &&
            $formulation->element->is_intermediate
        ) {
            return redirect()->back()->withErrors(['formulation' => 'No se pueden vender insumos intermedios directamente.']);
        }

        // ✅ Vender el producto final (ya existe en inventario por la migración)
        $productElementId = (int) ($formulation->element_id ?? 0);
        if ($productElementId <= 0) {
            return redirect()->back()->withErrors(['formulation' => 'La formulación no tiene producto final asociado (element_id).']);
        }

        $qtyToSell     = (int) $request->quantity;
        $saleUnitPrice = (float) ($formulation->element?->price ?? 0);

        $movement_type = MovementType::where('name', 'Venta')->firstOrFail();

        DB::beginTransaction();
        try {
            // 1) Crear movimiento
            $sale = new Movement();
            $sale->registration_date = now();
            $sale->movement_type_id  = $movement_type->id;
            $sale->voucher_number    = 'SALE-' . now()->format('YmdHis');
            $sale->price             = $saleUnitPrice * $qtyToSell;
            $sale->observation       = $request->boolean('is_internal') ? 'Venta interna' : 'Venta al cliente';
            $sale->state             = 'Aprobado';
            $sale->cash_count_id     = $cashCount->id;

            if (Schema::hasColumn('movements', 'productive_unit_warehouse_id')) {
                $sale->productive_unit_warehouse_id = $app_puw->id;
            }

            $sale->save();

            // 2) warehouse_movements (Entrega)
            $sale->warehouse_movements()->create([
                'productive_unit_warehouse_id' => $app_puw->id,
                'role' => 'Entrega',
            ]);

            // 3) Descontar inventario del PRODUCTO FINAL por lotes
            $need = $qtyToSell;

            $lots = Inventory::with('element')
                ->where('productive_unit_warehouse_id', $app_puw->id)
                ->where('element_id', $productElementId)
                ->where('amount', '>', 0)
                ->orderByRaw('CASE WHEN expiration_date IS NULL THEN 1 ELSE 0 END, expiration_date ASC')
                ->orderBy('updated_at', 'ASC')
                ->lockForUpdate()
                ->get();

            $available = (int) $lots->sum('amount');
            if ($available < $need) {
                DB::rollBack();
                $name = optional($lots->first()?->element)->name ?? 'Producto';
                return redirect()->back()->withErrors([
                    'stock' => "Inventario insuficiente para {$name}. Necesita {$need} y hay {$available}."
                ]);
            }

            foreach ($lots as $lot) {
                if ($need <= 0) break;

                $take = min((int)$lot->amount, $need);

                $lot->amount = (int)$lot->amount - $take;
                $lot->save();

                $detail = new MovementDetail();
                $detail->movement_id = $sale->id;

                if (Schema::hasColumn('movement_details', 'inventory_id')) {
                    $detail->inventory_id = $lot->id;
                }
                if (Schema::hasColumn('movement_details', 'element_id')) {
                    $detail->element_id = $productElementId;
                }

                $detail->amount = $take;

                if (Schema::hasColumn('movement_details', 'price')) {
                    $detail->price = $saleUnitPrice;
                }
                if (Schema::hasColumn('movement_details', 'subtotal')) {
                    $detail->subtotal = $take * $saleUnitPrice;
                }

                $detail->save();

                $need -= $take;
            }

            DB::commit();

            if (!$request->boolean('is_internal')) {
                $this->generateReceipt($sale, $formulation, $qtyToSell, $request->customer_id);
            }

            return redirect(route('cafeto.' . $this->getRoleRouteName() . '.sale.index'))
                ->with('success', 'Venta registrada con éxito.');
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('CAFETO sale.store error: ' . $e->getMessage(), [
                'line'  => $e->getLine(),
                'file'  => $e->getFile(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'Operación rechazada. Ha ocurrido un error en el registro de la venta en DETALLES DE MOVIMIENTO. Por favor, intente nuevamente');
        }
    }

    public function show($movement_id)
    {
        $movement = Movement::with('movement_details.inventory.element.measurement_unit')->findOrFail($movement_id);
        $view = [
            'titlePage' => trans('cafeto::controllers.CAFETO_sale_show_title_page'),
            'titleView' => trans('cafeto::controllers.CAFETO_sale_show_title_view')
        ];
        return view('cafeto::sale.show', compact('view', 'movement'));
    }

    protected function generateReceipt(Movement $sale, Formulation $formulation, $quantity, $customerId)
    {
        // Implementación futura
    }

    private function getRoleRouteName()
    {
        return getRoleRouteName(Route::currentRouteName());
    }
}
