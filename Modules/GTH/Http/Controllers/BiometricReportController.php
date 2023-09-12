<?php
namespace Modules\GTH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Person;

class BiometricReportController extends Controller
{
    public function viewBiometricReports()
    {
        $people = Person::take(50)->get(); // Cambia 50 por la cantidad de registros que deseas obtener

        return view('gth::biometric_report.biometricreports', ['people' => $people]);
    }

}
