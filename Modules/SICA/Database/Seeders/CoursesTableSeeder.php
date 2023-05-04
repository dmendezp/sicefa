<?php

namespace Modules\SICA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Program;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $number_courses = 48       ; // Definir la cantidad de cursos formativos

        $program = Program::where('name','ANÁLISIS Y DESARROLLO DE SISTEMAS DE INFORMACIÓN')->first();
        Course::updateOrCreate(['code' => 2397491],[ // Actualizar o registrar curso de formación
            'star_date' => '2021-10-04',
            'end_date' => '2023-10-03',
            'status' => 'Activo',
            'program_id' => $program->id
        ]);

        Course::factory()->count($number_courses)->create(); // Generar cursos formativos de prueba de acuerdo a la cantidad definida

    }
}
