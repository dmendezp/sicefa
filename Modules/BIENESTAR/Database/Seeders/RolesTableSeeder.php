<?php

namespace Modules\BIENESTAR\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;

class RolesTableSeeder extends Seeder
{

    public function run()
    {

        // Consultar aplicación BIENESTAR para registrar los roles
        $app = App::where('name','BIENESTAR')->firstOrFail();

        // Consultar rol  de superadministrador
        $rol_superadmin = Role::where('slug','superadmin')->firstOrFail();

        // Registrar o actualizar rol de ADMINISTRADOR
        $rol_admin = Role::updateOrCreate(['slug' => 'bienestar.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol administrador de la aplicación BIENESTAR',
            'description_english' => 'BIENESTAR application administrator role',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de Líder de Beneficio Transporte
        $rol_transportation_benefits_leader = Role::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader'], [
            'name' => 'Líder de Beneficio Transporte',
            'description' => 'Rol Líder de Beneficio Transportes de la aplicación BIENESTAR',
            'description_english' => 'BIENESTAR application Transportation Benefits Leader role',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de Líder de Beneficio Alimentación
        $rol_food_benefits_leader = Role::updateOrCreate(['slug' => 'bienestar.food_benefits_leader'], [
            'name' => 'Lider de Beneficio Alimentación',
            'description' => 'Rol Líder de Beneficio Alimentación de la aplicación BIENESTAR',
            'description_english' => 'BIENESTAR application Food Benefits Leader role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de Asistente de Alimentación
        $rol_feeding_assistant = Role::updateOrCreate(['slug' => 'bienestar.feeding_assistant'], [
            'name' => 'Asistente de alimentación',
            'description' => 'Rol Asistente de alimentación de la aplicación BIENESTAR',
            'description_english' => 'BIENESTAR application feeding assistant',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);


         // Registrar o actualizar rol de Lider de Ruta  
         $rol_route_leader = Role::updateOrCreate(['slug' => 'bienestar.route_leader'], [
            'name' => 'Lider de Ruta',
            'description' => 'Rol Líder de rutas de la aplicación BIENESTAR',
            'description_english' => 'BIENESTAR application apprentice role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        // Consulta de usuarios|
        $user_food_benefits_leader = User::where('nickname','LenadraDD')->firstOrFail();

        // Asignación de ROLES para los USUARIOS de la aplicación BIENESTAR (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $user_food_benefits_leader->roles()->syncWithoutDetaching([$rol_food_benefits_leader->id]);


    }
}