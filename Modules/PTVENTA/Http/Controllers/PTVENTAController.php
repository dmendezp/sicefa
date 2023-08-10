<?php

namespace Modules\PTVENTA\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Modules\PTVENTA\Entities\CashCount;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementType;
use Modules\PTVENTA\Http\Controllers\InventoryController;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Warehouse;

class PTVENTAController extends Controller
{

    public function index()
    {
        $view = ['titlePage' => trans('ptventa::mainPage.Main page'), 'titleView' => trans('ptventa::mainPage.Main page')];
        return view('ptventa::index', compact('view'));
    }

    public function devs()
    {
        $view = ['titlePage' => trans('ptventa::devs.Developers'), 'titleView' => trans('ptventa::devs.Developers and credits')];
        return view('ptventa::developers.index', compact('view'));
    }

    public function info()
    {
        $view = ['titlePage' => trans('ptventa::about.About us'), 'titleView' => trans('ptventa::about.About us')];
        return view('ptventa::information.index', compact('view'));
    }

    public function configuration()
    {
        $view = ['titlePage' => trans('ptventa::configuration.Configuration'), 'titleView' => trans('ptventa::configuration.Configuration')];
        return view('ptventa::configuration.index', compact('view'));
    }

    public function admin()
    {
        $view = ['titlePage' => trans('ptventa::controllers.PTVENTA_admin_title_page'), 'titleView' => trans('ptventa::controllers.PTVENTA_admin_title_view')];

        $movement_type = MovementType::where('name', 'Venta')->firstOrFail();

        $app_puw = (new InventoryController())->getAppPuw(); // Obtner la unidad productiva y bodega de la aplicación

        // Obtén la fecha actual y retrocede dos meses
        $currentDate = Carbon::now();
        $startDate = $currentDate->copy()->subMonths(2)->startOfMonth();
        $endDate = $currentDate->endOfMonth();

        $salesByMonth = Movement::whereHas('warehouse_movements', function ($query) use ($app_puw) {
            $query->where('productive_unit_warehouse_id', $app_puw->id)
                ->where('role', 'Entrega');
        })
            ->where('movement_type_id', $movement_type->id)
            ->where('state', 'Aprobado')
            ->whereBetween('registration_date', [$startDate, $endDate])
            ->orderBy('registration_date', 'ASC')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->registration_date)->format('m'); // Agrupar por mes
            });

        $months = [];
        $salesTotals = [];

        $maxSalesMonth = null;
        $maxSalesAmount = 0;
        $previousSalesAmount = 0;

        foreach ($salesByMonth as $month => $sales) {
            $months[] = Carbon::createFromFormat('!m', $month)->format('F');
            $salesTotal = $sales->sum('price');
            $salesTotals[] = $salesTotal;

            if ($salesTotal > $maxSalesAmount) {
                $maxSalesAmount = $salesTotal;
                $maxSalesMonth = Carbon::createFromFormat('!m', $month)->format('F');
            }

            if ($previousSalesAmount !== 0) {
                $percentageChange = (($salesTotal - $previousSalesAmount) / $previousSalesAmount) * 100;
            } else {
                $percentageChange = 0;
            }

            $previousSalesAmount = $salesTotal;
        }

        //Permite hacer el conteo de todas las unidades productivas actuales
        $totalProductiveUnits = ProductiveUnit::count();

        //Permite hacer el conteo de todas las unidades productivas actuales
        $totalWarehouses = Warehouse::count();

        // Obtener la unidad productiva con el nombre "Punto de venta"
        $productiveUnitWarehouse = ProductiveUnitWarehouse::whereHas('productive_unit', function ($query) {
            $query->where('name', 'Punto de venta');
        })->first();
        if ($productiveUnitWarehouse) {
            // Contar el número de cajas cerradas para la unidad productiva
            $closedCashCounts = CashCount::where('productive_unit_warehouse_id', $productiveUnitWarehouse->id)
                ->where('state', 'Cerrada')
                ->count();
        } else {
            $closedCashCounts = 0;
        }

        // Obtener la unidad productiva con el nombre "Punto de venta"
        $productiveUnit = ProductiveUnit::where('name', 'Punto de venta')->first();

        if ($productiveUnit) {
            // Obtener las unidades productivas y bodegas asociadas a la unidad productiva "Punto de venta"
            $productiveUnitWarehouses = $productiveUnit->productive_unit_warehouses;

            // Inicializar un arreglo para almacenar los element_id únicos
            $uniqueElementIds = [];

            // Recorrer las unidades productivas y bodegas para obtener los element_id únicos
            foreach ($productiveUnitWarehouses as $puw) {
                foreach ($puw->inventories as $inventory) {
                    if (!in_array($inventory->element_id, $uniqueElementIds)) {
                        $uniqueElementIds[] = $inventory->element_id;
                    }
                }
            }

            // Obtener la cantidad total de elementos únicos en el inventario
            $totalInventory = count($uniqueElementIds);
        } else {
            $totalInventory = 0;
        }

        // Obtener los últimos 5 elementos registrados en el inventario
        $recentlyAddedInventory = Inventory::orderBy('created_at', 'desc')->take(5)->get();

        return view('ptventa::admin-index', compact('view', 'months', 'salesTotals', 'maxSalesMonth', 'percentageChange', 'totalProductiveUnits', 'totalWarehouses', 'closedCashCounts', 'totalInventory', 'recentlyAddedInventory'));
    }

    public function cashier()
    {
        $view = ['titlePage' => trans('ptventa::controllers.PTVENTA_cashier_title_page'), 'titleView' => trans('ptventa::controllers.PTVENTA_cashier_title_view')];
        return view('ptventa::cashier-index', compact('view'));
    }
}
