<?php

namespace Modules\PTVENTA\Http\Controllers;
use Modules\SICA\Entities\Inventory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Modules\SICA\Entities\Element;

use Illuminate\Routing\Controller;

class InventoryController extends Controller
{

    public function index() { // Listado del inventario actual
        $inventories = Inventory::orderBy('updated_at', 'DESC')->get(); // Consultar registros de inventario de manera descende por el dato updated_at
        $view = ['titlePage'=>'Inventario - Listado', 'titleView'=>'Administración de inventario'];
        return view('ptventa::inventory.index', compact('view', 'inventories'));
    }

    public function create() { // Formulario de registro (entrada) de inventario
        $view = ['titlePage'=>'Inventario - Registro', 'titleView'=>'Registro de inventario'];
        return view('ptventa::inventory.create', compact('view'));
    }

    public function pdf(){ //Descarga de archivos PDF
        $inventories = Inventory::orderBy('updated_at', 'DESC')->get();
        $pdf = Pdf::loadView('ptventa::inventory.pdf', compact('inventories'));
        return $pdf->stream();

    }

    public function status(Request $request) { // Estado de productos vencidos y por vencer

        $inventories = Inventory::orderBy('updated_at', 'DESC')->get();
        $view = ['titlePage'=>'Inventario - Registro', 'titleView'=>'Registro de inventario'];
        $productosVencidos = Inventory::where('expiration_date', '<', now())->get()->toArray();
        $productosPorVencer = Inventory::where('expiration_date', '>=', now())->get()->toArray();

        $resultados = array_merge($productosVencidos, $productosPorVencer);
        return $resultados;

    //return view('ptventa::inventory.status', compact('view'),$productosPorVencer, $productosVencidos );
    }
 
    public function low() { //registro de bajas
        $view = ['titlePage'=>'Inventario - Registro', 'titleView'=>'Registro de inventario'];
        return view('ptventa::inventory.low', compact('view'));

    }

    //funciones para reporte
    public function form(Request $request) { //formulario de fechas para generar reporte
        $view = ['titlePage'=>'Reporte - Productos', 'titleView'=>'Reporte de productos'];
        $fi = $request->fecha_ini.' 00:00:00';
        $ff = $request->fecha_fin.' 23:59:59';
        $element = Element::whereBetween('created_at', [$fi, $ff])->get();
        return view('ptventa::report.form', compact('view', 'element'));
    }

    public function table() { //Tabla con resultados de busqueda
        $view = ['titlePage'=>'Reporte - Productos', 'titleView'=>'Reporte de productos'];
        $element = Element::whereDate('created_at', Carbon::now())->get();
        return view('ptventa::report.table', compact('view', 'element'));
    }


}
