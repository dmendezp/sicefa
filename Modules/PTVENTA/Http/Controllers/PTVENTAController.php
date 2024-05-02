<?php

namespace Modules\PTVENTA\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\CashCount;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Warehouse;

class PTVENTAController extends Controller
{

    public function index()
    {
        $view = ['titlePage' => trans('ptventa::controllers.PTVENTA_index_title_page'), 'titleView' => trans('ptventa::controllers.PTVENTA_index_title_view')];
        return view('ptventa::index', compact('view'));
    }

    public function devs()
    {
        $view = ['titlePage' => trans('ptventa::controllers.PTVENTA_devs_title_page'), 'titleView' => trans('ptventa::controllers.PTVENTA_devs_title_page')];
        return view('ptventa::developers.index', compact('view'));
    }

    public function info()
    {
        $view = ['titlePage' => trans('ptventa::controllers.PTVENTA_info_title_page'), 'titleView' => trans('ptventa::controllers.PTVENTA_info_title_view')];
        return view('ptventa::information.index', compact('view'));
    }

    public function configuration()
    {
        $view = ['titlePage' => trans('ptventa::controllers.PTVENTA_configuration_title_page'), 'titleView' => trans('ptventa::controllers.PTVENTA_configuration_title_view')];
        return view('ptventa::configuration.index', compact('view'));
    }

    public function admin()
    {
        $view = ['titlePage' => trans('ptventa::controllers.PTVENTA_admin_title_page'), 'titleView' => trans('ptventa::controllers.PTVENTA_admin_title_view')];
        $movement_type = MovementType::where('name', 'Venta')->firstOrFail();

        $app_puw = PUW::getAppPuw(); // Obtener la unidad productiva y bodega de la aplicación

        // Obtén la fecha actual y retrocede dos meses
        $currentDate = Carbon::now();
        $startDate = $currentDate->copy()->subMonths(2)->startOfMonth();
        $endDate = $currentDate->endOfMonth();

        $salesByMonth = Movement::whereHas('warehouse_movements', function ($query) use ($app_puw) {
            $query->where('productive_unit_warehouse_id', $app_puw->id)->where('role', 'Entrega');
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
        $currentYear = null;
        $percentageChange = 0;

        foreach ($salesByMonth as $month => $sales) {
            $salesTotal = $sales->sum('price');

            // Obtén el año actual
            $year = Carbon::createFromFormat('!m', $month)->format('Y');

            // Si el año cambió, verifica si el mes actual tuvo más ventas que el máximo anterior y reinicia
            if ($year !== $currentYear) {
                $currentYear = $year;
                $maxSalesAmount = $salesTotal;
                $maxSalesMonth = Carbon::createFromFormat('!m', $month)->format('F');
            } elseif ($salesTotal > $maxSalesAmount) {
                $maxSalesAmount = $salesTotal;
                $maxSalesMonth = Carbon::createFromFormat('!m', $month)->format('F');
            }

            // Resto del código para calcular el porcentaje de cambio, etc.
            $months[] = Carbon::createFromFormat('!m', $month)->format('F');
            $salesTotals[] = $salesTotal;

            if ($previousSalesAmount !== 0) {
                $percentageChange = (($salesTotal - $previousSalesAmount) / $previousSalesAmount) * 100;
            } else {
                $percentageChange = 0;
            }

            $previousSalesAmount = $salesTotal;
        }

        // Permite hacer el conteo de todas las unidades productivas actuales
        $totalProductiveUnits = ProductiveUnit::count();

        // Permite hacer el conteo de todas las bodegas actuales
        $totalWarehouses = Warehouse::count();

        // Permite obtener el conteo de todas las cajas actuales con estado cerrado
        $closedCashCounts = CashCount::where('productive_unit_warehouse_id', $app_puw->id)
                                    ->where('state', 'Cerrada')
                                    ->count();

        // Permite obtener el conteo de todo el inventario actual
        $totalInventory = Inventory::select('id', 'element_id')
                                    ->where('productive_unit_warehouse_id', $app_puw->id)
                                    ->where('amount', '<>', 0)
                                    ->distinct('element_id')
                                    ->count();

        // Obtener los últimos 6 elementos registrados en el inventario
        $recentlyAddedInventory = Inventory::where('productive_unit_warehouse_id', $app_puw->id)
                                            ->orderBy('created_at', 'desc')->take(6)->get();

        return view('ptventa::admin-index', compact('view', 'months', 'salesTotals', 'maxSalesMonth', 'percentageChange', 'totalProductiveUnits', 'totalWarehouses', 'closedCashCounts', 'totalInventory', 'recentlyAddedInventory'));
    }

    public function cashier()
    {
        $view = ['titlePage' => trans('ptventa::controllers.PTVENTA_cashier_title_page'), 'titleView' => trans('ptventa::controllers.PTVENTA_cashier_title_view')];
        return view('ptventa::cashier-index', compact('view'));
    }
}
