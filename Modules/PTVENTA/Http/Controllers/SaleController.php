<?php

namespace Modules\PTVENTA\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementType;
use Modules\PTVENTA\Entities\CashCount;

class SaleController extends Controller
{

    public function index(){
        $movement_type = MovementType::where('name','Venta')->first();
        $sales = Movement::whereDate('registration_date', Carbon::today()->toDateString())
                            ->where('movement_type_id',$movement_type->id)
                            ->orderBy('registration_date','DESC')
                            ->get();
        $view = ['titlePage'=>'Ventas', 'titleView'=>'Ventas realizadas hoy'];
        return view('ptventa::sale.index', compact('view','sales'));
    }

    public function register(){
        // Verificar si hay una caja abierta
        $openCashCount = CashCount::where('state', 'Abierta')->first();
        if (!$openCashCount) {
            return redirect()->route('ptventa.sale.index')->with('error', 'Primero debes abrir una caja.');
        }
                
        // Continuar con la vista de registro de venta si hay una caja abierta
        $view = ['titlePage' => 'Ventas', 'titleView' => 'Registro de venta'];
        return view('ptventa::sale.register', compact('view'));
    }

}
