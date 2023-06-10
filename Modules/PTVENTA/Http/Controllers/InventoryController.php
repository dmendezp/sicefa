<?php

namespace Modules\PTVENTA\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\MovementDetail;
use Elibyy\TCPDF\Facades\TCPDF;

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

    public function pdf(Request $request)
    {
        $inventories = Inventory::orderBy('updated_at', 'DESC')->get();
        $filename = 'Producto.pdf';
  
        $data = [
            'title' => 'Generate PDF'
        ];
  
        $html = view()->make('ptventa::inventory.pdf', compact('inventories'))->render();
  
        $pdf = new TCPDF;
          
        $pdf::SetTitle('Lista de Productos ');
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');
  
        $pdf::Output(public_path($filename), 'F');
  
        return response()->download(public_path($filename));
    }


    public function status(Request $request) { // Estado de productos vencidos y por vencer

        $inventories = Inventory::orderBy('updated_at', 'DESC')->get();
        $view = ['titlePage'=>'Inventario - Registro', 'titleView'=>'Estado de productos '];
        $productosVencidos = Inventory::where('expiration_date', '<', now())->get();
        $productosPorVencer = Inventory::where('expiration_date', '>=', now())
                                    ->where('expiration_date', '<=', now()->addDays(3))
                                    ->orderBy('expiration_date')
                                        ->get();
    return view('ptventa::inventory.status', compact('view','productosVencidos', 'productosPorVencer'));

    }

    public function low() { //registro de bajas
        $view = ['titlePage'=>'Inventario - Registro', 'titleView'=>'Registro de Bajas'];
        return view('ptventa::inventory.low', compact('view'));

    }

    //funciones para reporte
    public function form(){
        $view = ['titlePage'=>'Reporte - Inventario', 'titleView'=>'Reporte de inventario'];
        return view('ptventa::report.form', compact('view'));
    }

    public function result_form(Request $request) { //formulario de fechas para generar reporte
        $view = ['titlePage'=>'Reporte - Inventario', 'titleView'=>'Reporte de inventario'];
        $fi = $request->fecha_ini.' 00:00:00';
        $ff = $request->fecha_fin.' 23:59:59';
        $report = MovementDetail::whereBetween('created_at', [$fi, $ff])->get();
        return view('ptventa::report.table', compact('view', 'report'));
    }

    public function table() { //Tabla con resultados de busqueda
        $view = ['titlePage'=>'Reporte - Inventario', 'titleView'=>'Reporte de Inventario'];
        $report = MovementDetail::whereDate('created_at', Carbon::today('America/Bogota'))->get();
        return view('ptventa::report.table', compact('view', 'report'));
    }


}
