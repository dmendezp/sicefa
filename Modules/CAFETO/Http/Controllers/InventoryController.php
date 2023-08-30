<?php

namespace Modules\CAFETO\Http\Controllers;

use Illuminate\Http\Request;
use Modules\SICA\Entities\Warehouse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use TCPDF;
use Modules\SICA\Entities\App;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $view = ['titlePage'=>'Inventario', 'titleView'=>'Administración de inventario'];
        $apps = App::get();
        return view('cafeto::inventory.index', compact('apps', 'view'));
    }

    //Funciones Para Reporte de inventario
    public function reports()
    { //Vista principal del panel de reportes
        $view = ['titlePage' => 'Reportes', 'titleView' => 'Panel de Reportes'];
        $apps = App::get();
        return view('cafeto::reports.index', compact('view', 'apps'));
    }
}
