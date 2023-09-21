<?php
namespace Modules\GTH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Schema;
use Modules\SICA\Entities\Person;

class BiometricReportController extends Controller
{
    public function viewBiometricReports()
    {
        $people = Person::take(500)->get(); // Cambia 50 por la cantidad de registros que deseas obtener

        return view('gth::biometric_report.biometricreports', ['people' => $people]);
    }

    public function postcreateBiometricReport(Request $request, $id)
    {
        $people = Person::findOrFail($id);
        $people->biometric_code = $request->input('biometric_code');
        $people->save();

        return redirect()->route('gth.biometricreports.view');
    }

    public function updateBiometricReport(Request $request, $id)
    {
        $request->validate([
            'biometric_code' => 'required|max:255',
            'document_number' => 'required|string|max:255', // Agrega más reglas según tus necesidades
            // Agrega más campos y reglas según tus necesidades
        ]);

        $people = Person::findOrFail($id);

        // Actualizar los campos necesarios
        $people->biometric_code = $request->input('biometric_code');
        $people->document_type   = $request->input('document_type') ? : null ;
        // Actualiza otros campos si es necesario

        $people->save();

        // Redirigir a donde quieras después de la actualización
        return redirect()->route('gth.biometricreports.view')->with('success', 'Codigo Biometrico actualizado exitosamente.');
    }

    public function showcontractortypes($id)
    {
        $people = Person::find($id);
        return view('biometric_report.biometricreports', ['people' => $people]);
    }




}
