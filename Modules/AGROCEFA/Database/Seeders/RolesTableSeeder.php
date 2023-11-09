<?php

namespace Modules\AGROCEFA\Database\Seeders;


use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;
use App\Models\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Consultar la app para realizar la creacion de roles
        $app = App::where('name','AGROCEFA')->first();


        // Registrar o actualizar rol de administrador en AGROCEFA
        $rolinstructor = Role::updateOrCreate(['slug' => 'agrocefa.trainer'], [
            'name' => 'Instructor',
            'description' => 'Rol de Instructor AGROCEFA',
            'description_english' => 'Role of AGROCEFA Trainer',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de Pasante en AGROCEFA
        $rolpasante = Role::updateOrCreate(['slug' => 'agrocefa.passant'], [
            'name' => 'Pasante',
            'description' => 'Rol Pasante para el registro de labores AGROCEFA',
            'description_english' => 'Passant role for registration of AGROCEFA labor',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);


        // Consulta de usuarios
        $useradministrador = User::where('nickname','William')->first(); 
        $useryaya = User::where('nickname','Yaya')->first();
        $useryuderly = User::where('nickname','Yuderly')->first(); 
        $userandres = User::where('nickname','AndresFS')->first(); 

        // Asignacion de roles a usuarios
        $useradministrador->roles()->syncWithoutDetaching([$rolinstructor->id]);
        $useryaya->roles()->syncWithoutDetaching([$rolpasante->id]);
        $userandres->roles()->syncWithoutDetaching([$rolinstructor->id]);
        $useryuderly->roles()->syncWithoutDetaching([$rolpasante->id]);

    }
}
