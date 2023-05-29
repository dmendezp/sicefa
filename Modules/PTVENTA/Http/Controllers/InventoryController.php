<?php

namespace Modules\PTVENTA\Http\Controllers;
use Modules\SICA\Entities\Inventory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;


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

    public function status(Request $request ) { // Estado de productos vencidos y por vencer 
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


}