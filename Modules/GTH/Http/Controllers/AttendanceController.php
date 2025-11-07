<?php

namespace Modules\GTH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Course;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function viewattendance()
{
    $courses = Course::with('program')->get();

    // Inicializa un array para almacenar los nombres y códigos de los programas
    $selectData = [];

    // Recorre la colección de cursos
    foreach ($courses as $course) {
        // Obtén el nombre y código del curso y programa relacionado
        $name = $course->name . ' ' . $course->code;
        $programName = $course->program->name;

        // Concatena el nombre del curso con el nombre del programa
        $fullName = $name . ' - ' . $programName;

        // Agrega un array asociativo con el ID y el nombre completo al array de datos
        $selectData[$course->id] =  $fullName;
    }

    return view('gth::attendances', [
        'selectprogram' => $selectData,
    ]);
}
public function search(Request $request)
{
    $courseid = $request->input('courseid');

    // Obtén la información del curso
    $course = Course::with('apprentices.person')->findOrFail($courseid);
    

    // Obtén la fecha y hora actual
    $currentDateOnly = Carbon::today()->toDateString();

    // Obtén las asistencias de los aprendices para la fecha actual
    $attendances = $course->apprentices->map(function ($apprentice) use ($currentDateOnly) {
        return [
            'person' => $apprentice->person,
            'attendance' => $apprentice->person->attendances->firstWhere('date', $currentDateOnly),
        ];
    });
   

    return view('gth::resultattendance', [
        'attendances' => $attendances,
    ]);
}
}
