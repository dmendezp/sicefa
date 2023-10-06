<?php

namespace Modules\SENAEMPRESA\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SENAEMPRESA\Entities\Attendance;
use Modules\SENAEMPRESA\Entities\StaffSenaempresa;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Apprentice;


class AttendanceController extends Controller
{
   
    public function showAttendanceList()
    {
        $attendances = Attendance::with('staffSenaempresa.apprentice.person')->get();
        $title = "Asistencia";
        return view('senaempresa::Company.attendance.index', ['attendances' => $attendances, 'title' => $title]);
    }


    // Métodos anteriores...

    public function registerAttendance(Request $request)
    {
        // Valida los datos del formulario aquí, si es necesario
        $personid = $request->input('person_id');
        
        $apprenticeid = Apprentice::where('person_id', $personid)->pluck('id')->first();

        $staffsenaempresaid = StaffSenaempresa::where('apprentice_id', $apprenticeid)->pluck('id')->first();
        
        // Registra la asistencia en la tabla attendances
        $attendance = new Attendance();
        $attendance->staff_senaempresa_id = $staffsenaempresaid;
        $attendance->start_datetime = now();
        $attendance->end_datetime = now();
        $attendance->save();

        // Redirige a la lista de asistencias o muestra un mensaje de éxito
        return redirect()->route('attendance.list')->with('success', 'Asistencia registrada exitosamente.');
    }

    

    public function getPersonData(Request $request)
{
    $documentNumber = $request->input('document_number');

    // Realiza una consulta para obtener los datos de la persona con el número de documento
    $personData = Person::where('document_number', $documentNumber)->first();

    if ($personData) {
        // Si se encontró una persona, devuelve los datos junto con el ID
        return response()->json([
            'id' => $personData->id,
            'full_name' => $personData->first_name,
            // Agrega otros campos que desees devolver
        ]);
    } else {
        // Si no se encontró una persona, devuelve una respuesta vacía
        return response()->json(null);
    }
}




    

    

}
