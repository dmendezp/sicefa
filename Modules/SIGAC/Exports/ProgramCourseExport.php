<?php
namespace Modules\SIGAC\Exports;

use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Course;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProgramCourseExport implements FromCollection
{
    public function collection()
    {
        $programs = Program::with('courses')->get();
        $courses = Course::all();

        // Agrega la columna de programa a los datos de cursos
        $coursesWithProgram = $courses->map(function ($course) {
            $course['program_name'] = $course->program->name; // Ajusta según tu estructura de datos
            return $course;
        });

        // Combina los datos de programas y cursos
        $combinedData = $coursesWithProgram;

        return $combinedData;
    }
}


