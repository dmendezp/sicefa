<?php

namespace Modules\CAFETO\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $app = App::where('name', 'CAFETO')->firstOrFail();
        $rol_superadmin = Role::where('slug', 'superadmin')->firstOrFail();

        // Registrar o actualizar rol de ADMINISTRADOR
        $rol_admin = Role::updateOrCreate(['slug' => 'cafeto.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol administrador de la aplicación CAFETO',
            'description_english' => 'CAFETO application administrator role',
            'full_access' => 'no',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de CAJERO
        $rol_cashier = Role::updateOrCreate(['slug' => 'cafeto.cashier'], [
            'name' => 'Cajero',
            'description' => 'Rol cajero de la aplicación CAFETO',
            'description_english' => 'CAFETO application cashier role',
            'full_access' => 'no',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de INSTRUCTOR
        $rol_instructor = Role::updateOrCreate(['slug' => 'cafeto.instructor'], [
            'name' => 'Instructor',
            'description' => 'Rol instructor de la aplicación CAFETO',
            'description_english' => 'CAFETO application instructor role',
            'full_access' => 'no',
            'app_id' => $app->id
        ]);

        // Consulta de usuarios
        $user_admin = User::where('nickname', 'LFHerre')->firstOrFail();
        $user_cashier = User::where('nickname', 'Resmerveilons')->firstOrFail();
        $user_superadmin = User::where('nickname', 'JDGM0331')->firstOrFail();
        $user_instructor = User::where('nickname', 'InstructorJesu')->firstOrFail();
        $user_cashier_intern = User::where('nickname', 'SofiaAscencio')->firstOrFail();

        // Asignación de ROLES para los USUARIOS
        $user_admin->roles()->syncWithoutDetaching([$rol_admin->id]);
        $user_cashier->roles()->syncWithoutDetaching([$rol_cashier->id]);
        $user_superadmin->roles()->syncWithoutDetaching([$rol_superadmin->id]);
        $user_instructor->roles()->syncWithoutDetaching([$rol_instructor->id]);
    }
}