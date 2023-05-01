<?php

namespace Modules\SICA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Person;

class ApprenticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $number_apprentices = 100; // Definir la cantidad aprendices

        $person = Person::where('document_number',1004494010)->first(); // Obtener los datos personales de Jesús David Guevara Munar
        $course = Course::where('code',2397491)->first(); // Obtenere la información del curso de Análisis y Desarrollo de Sitemas de Información (2397491)
        Apprentice::updateOrCreate(['person_id' => $person->id, 'course_id' => $course->id],[ // Actualizar o registrar aprendiz
            'apprentice_status' => 'EN FORMACIÓN'
        ]);

        Apprentice::factory()->count($number_apprentices)->create();



    }
}
