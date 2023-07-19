<?php

namespace Modules\PTVENTA\Http\Controllers;
use Illuminate\Http\Request;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\Warehouse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\MovementDetail;
use TCPDF;

//Pueba de funcion reporte por fecha
use Modules\SICA\Entities\Element;



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

    public function pdf()

        {
            $inventories = Inventory::orderBy('updated_at', 'DESC')->get();
            $pdf = new TCPDF();
            $html = view('ptventa::inventory.pdf', compact('inventories'))->render();
            $pdf->AddPage();
            $pdf->writeHTML($html, true, false, true, false);
            $pdf->Output('ReporteProductos');
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

    //Funciones para reporte de inventario por rango de fecha
    public function report() { //Tabla con resultados de busqueda
        $view = ['titlePage'=>'Reporte - Inventario', 'titleView'=>'Reporte de Inventario'];
        $report = Element::whereDate('created_at', Carbon::today('America/Bogota'))
                                    ->orderBy('created_at','DESC')
                                    ->get();
        return view('ptventa::report.report', compact('view', 'report'));
    }

    public function report_results(Request $request) { //formulario de fechas para generar reporte
        $fi = $request->fecha_ini.' 00:00:00';
        $ff = $request->fecha_fin.' 23:59:59';
        $report = Element::whereBetween('created_at', [$fi, $ff])->get();
        return view('ptventa::report.report', compact('report'));
    }


    public function rpdf(){
        $pdf = new TCPDF();

        $html = view('ptventa::report.rpdf')->render();
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false);
        $pdf->Output('ReporteEntradasInventario');
    }

    //Funciones para reporte de inventario
    public function reports() { //Vista principal del panel de reportes
        $view = ['titlePage'=>'Reportes', 'titleView'=>'Panel de Reportes'];
        return view('ptventa::reports.index', compact('view'));
    }

    public function saleReports() { //Vista de reportes de ventas
        $view = ['titlePage'=>'Reportes', 'titleView'=>'Reportes de ventas'];
        return view('ptventa::reports.saleReports.index', compact('view'));
    }

    public function lowReports() { //Vista de reportes de bajas
        $view = ['titlePage'=>'Reportes', 'titleView'=>'Reportes de bajas'];
        return view('ptventa::reports.lowReports.index', compact('view'));
    }

    public function inventoryReports() { //Vista de reportes de inventario
        $view = ['titlePage'=>'Reportes', 'titleView'=>'Reportes de inventario'];
        return view('ptventa::reports.inventoryReports.index', compact('view'));
    }

}
