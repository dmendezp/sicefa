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
