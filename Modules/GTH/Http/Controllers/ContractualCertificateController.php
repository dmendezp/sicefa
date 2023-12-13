<?php

namespace Modules\GTH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Contractor;
use PDF;

class ContractualCertificateController extends Controller
{
    public function viewcontractualcertificate(Request $request)
    {
        $contractors = [];

        // Si se envía el formulario de búsqueda, realiza la búsqueda en la base de datos.
        if ($request->has('person_id')) {
            $contractors = Contractor::where('person_id', $request->input('person_id'))->get();
        }

        return view('gth::contractualcertificate.contractualcertificate', compact('contractors'));
    }
    public function search(Request $request)
    {
        $contractors = [];

        // Si se envía el formulario de búsqueda, realiza la búsqueda en la base de datos.
        if ($request->has('person_id')) {
            $contractors = Contractor::where('person_id', $request->input('person_id'))->get();
        }

        // Devuelve los resultados como JSON
        return response()->json([
            'html' => view('gth::contractualcertificate.search_results', compact('contractors'))->render()
        ]);
    }
}
