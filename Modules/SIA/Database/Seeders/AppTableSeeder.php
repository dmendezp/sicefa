<?php

namespace Modules\SIA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\SIA\Entities\App;

class AppTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ejemplo de inserción de datos en la tabla 'apps'
        DB::table('apps')->insert([
            [
                'name' => 'SIA',
                'color' => '#8cf700',
            'icon' => 'fa-solid fa-users-gear',
            'description' => 'El sistema de gestión del Semillero de Investigación La Angostura es una aplicación web diseñada para apoyar las actividades del grupo S.I.A., facilitando la administración de usuarios, proyectos, eventos y recursos de investigación. Permite a los administradores (ADM) supervisar y eliminar cuentas de instructores (Instr.Inv) y aprendices (Ap.Inv), mientras que todos los usuarios pueden gestionar su propia cuenta, incluyendo la opción de eliminarla. Con una interfaz sencilla y funciones esenciales, el programa fomenta la colaboración, la innovación y la difusión del conocimiento.',
            'description_english' => 'The La Angostura Research Seedbed Management System is a web application designed to support the activities of the S.I.A. group, facilitating the administration of users, projects, events, and research resources. It allows administrators (ADMs) to monitor and delete instructor (Instr.Inv) and apprentice (Ap.Inv) accounts, while all users can manage their own accounts, including the option to delete them. With a simple interface and essential functions, the program fosters collaboration, innovation, and knowledge dissemination.'
            ],
        ]);

         /* Obtener ubicación de la finca */
         $country = Country::firstOrCreate([
            'name' => 'Colombia'
        ]);
        $department = Department::firstOrCreate([
            'country_id' => $country->id,
            'name' => 'Huila'
        ]);
        $municipality = Municipality::firstOrCreate([
            'department_id' => $department->id,
            'name' => 'Campoalegre'
        ]);
        $farm = Farm::firstOrCreate(['name'=>'CEFA'],[
            'description'=>'Centro de Formación Agroindustrial La Angostura',
            'area'=>100000,
            'person_id'=>$leader->id,
            'municipality_id'=>$municipality->id,
        ]);
    }
}