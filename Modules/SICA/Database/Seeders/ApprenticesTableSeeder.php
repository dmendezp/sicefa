<?php

namespace Modules\SICA\Database\Seeders;

use Exception;
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

        $number_apprentices = 150; // Definir la cantidad aprendices

        $person = Person::where('document_number',1004494010)->first(); // Obtener los datos personales de Jesús David Guevara Munar
        $course = Course::where('code',2397491)->first(); // Obtenere la información del curso de Análisis y Desarrollo de Sitemas de Información (2397491)
        Apprentice::updateOrCreate(['person_id' => $person->id, 'course_id' => $course->id],[ // Actualizar o registrar aprendiz
            'apprentice_status' => 'EN FORMACIÓN'
        ]);

        print_r("Generando " . $number_apprentices . " aprendices.\n");
        $failures = 0;
        for ($i=0; $i < $number_apprentices; $i++) {
            try { // Se almacena el factory dentro de un try catch para capturar el error de exepción por entrada duplicada de la llave apprentices_person_id_course_id_unique
                Apprentice::factory()->create();
            } catch(Exception $e) {
                $failures++;
                print_r("Falla número " . $failures . " en la iteración " . $i . "\n");
            }
        }

    }
}
