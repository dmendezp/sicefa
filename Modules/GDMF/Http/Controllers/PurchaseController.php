<?php

namespace Modules\GDMF\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\PurchaseImport;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Modules\GDMF\Entities\Purchase;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Contracts\Support\Renderable;
use Modules\GDMF\Entities\PurchaseFailure;

class PurchaseController extends Controller
{

    public function index()
    {
        $titleView = 'Registrar compra de materiales';
        $titlePage = 'Registrar Compra';
        return view('gdmf::purchase.index')->with([
            'titleView' => $titleView,
            'titlePage' => $titlePage
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            $fileHash = md5_file($request->file('file')->getRealPath());
            $import = new PurchaseImport($fileHash);

            Excel::import($import, $request->file('file'));

            if (!empty($import->errores)) {
                // Si hay fallos, redirige con hash para mostrar en la vista
                return redirect()->route('gdmf.academic_coordination.purchase.failure', $fileHash)
                    ->with('warning', 'El archivo se procesó pero hubo registros con errores.');
            }

            return back()->with('success', 'Archivo procesado correctamente sin errores.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al importar: ' . $e->getMessage());
        }
    }

    public function history_failure()
    {
        $titleView = 'Reporte historial de fallos';
        $titlePage = 'Reporte Historial de Fallos';
        // Agrupar por file_hash para mostrar historial por archivo cargado
        $historial = PurchaseFailure::select('file_hash')
            ->selectRaw('COUNT(*) as total_failures')
            ->selectRaw('MAX(created_at) as last_failed_at')
            ->groupBy('file_hash')
            ->orderByDesc('last_failed_at')
            ->get();

        return view('gdmf::purchase.history_failure', compact('historial', 'titleView', 'titlePage'));
    }

    public function failures($hash)
    {
        $titleView = 'Reporte historial de fallos';
        $titlePage = 'Reporte Historial de Fallos';
        $fallos = PurchaseFailure::where('file_hash', $hash)->latest()->get();
        return view('gdmf::purchase.failure', compact('fallos', 'hash', 'titleView', 'titlePage'));
    }


    public function report(Request $request)
    {
        $query = Purchase::query();

        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('purchase_date', [$request->fecha_inicio, $request->fecha_fin]);
        }

        $compras = $query->latest()->paginate(10);
        $titleView = 'Reporte de compras';
        $titlePage = 'Reporte de compras';
        return view('gdmf::purchase.report', compact('compras', 'titleView', 'titlePage'));
    }

    public function report_show($id)
    {
        $purchase = Purchase::with([
            'purchase_details.element',
            'purchase_details.material_request.person',
            'purchase_details.material_request.course'
        ])->findOrFail($id);

        $detalles = $purchase->purchase_details;

        $titleView = 'Detalles de compra';
        $titlePage = 'Detalles de compra';

        return view('gdmf::purchase.detail', compact('purchase', 'detalles', 'titleView', 'titlePage'));
    }
}
