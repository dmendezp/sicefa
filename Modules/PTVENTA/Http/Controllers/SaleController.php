<?php

namespace Modules\PTVENTA\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\CashCount;

class SaleController extends Controller
{

    public function index(){
        $view = ['titlePage'=> trans('ptventa::controllers.PTVENTA_sale_index_title_page'), 'titleView'=> trans('ptventa::controllers.PTVENTA_sale_index_title_view')];
        $app_puw = PUW::getAppPuw(); // Obtner la unidad productiva y bodega de la aplicación
        $cashCount = CashCount::where('productive_unit_warehouse_id',$app_puw->id)
                                ->where('state','Abierta')
                                ->first();
        if($cashCount){
            $movement_type = MovementType::where('name','Venta')->first();
            $sales = Movement::where('movement_type_id',$movement_type->id)
                                ->whereHas('warehouse_movements', function ($query) use ($app_puw) {
                                    $query->where('productive_unit_warehouse_id', $app_puw->id)->where('role', 'Entrega');
                                })->where('registration_date','>=',$cashCount->opening_date)
                                ->orderBy('registration_date','DESC')
                                ->get();
            return view('ptventa::sale.index', compact('view', 'sales', 'cashCount'));
        }else{
            return view('ptventa::sale.index', compact('view', 'cashCount'));
        }
    }

    public function register(){
        // Verificar si hay una caja abierta
        $app_puw = PUW::getAppPuw(); // Obtner la unidad productiva y bodega de la aplicación
        $open_cash_count = CashCount::where('productive_unit_warehouse_id',$app_puw->id)
                                    ->where('state', 'Abierta')
                                    ->first();
        if (!$open_cash_count) {
            return redirect(route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.sale.index'))->with('error', 'Primero debes abrir una caja.');
        }
        // Continuar con la vista de registro de venta si hay una caja abierta
        $view = ['titlePage' => trans('ptventa::controllers.PTVENTA_sale_register_title_page'), 'titleView' => trans('ptventa::controllers.PTVENTA_sale_register_title_view')];
        return view('ptventa::sale.register', compact('view'));
    }

    /* Ver detalle de venta */
    public function show($movement_id){
        $movement = Movement::with('movement_details.inventory.element.measurement_unit')->find($movement_id);
        $view = ['titlePage' => trans('ptventa::controllers.PTVENTA_sale_show_title_page'), 'titleView' => trans('ptventa::controllers.PTVENTA_sale_show_title_view')];
        return view('ptventa::sale.show', compact('view', 'movement'));
    }

}
