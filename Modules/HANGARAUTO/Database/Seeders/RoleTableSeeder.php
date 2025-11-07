<?php

namespace Modules\HANGARAUTO\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\App;
use App\Models\User;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name','HANGARAUTO')->first();


        // Registrar o actualizar rol de Administrador
        $role_admin = Role::updateOrCreate(['slug' => 'hangarauto.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol Administrador de Hangar',
            'description_english' => 'Role administrator of Hangar',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de Encargado
        $role_charge= Role::updateOrCreate(['slug' => 'hangarauto.charge'], [
            'name' => 'Encargado',
            'description' => 'Rol Encargado de la aplicacion HANGAR',
            'description_english' => 'HANGAR Application Charge Role',
            'app_id' => $app->id
        ]);


        // Registrar o actualizar rol de Conductor
        $role_charge= Role::updateOrCreate(['slug' => 'hangarauto.driver'], [
            'name' => 'Conductor',
            'description' => 'Rol Conductor de la aplicacion HANGAR',
            'description_english' => 'HANGAR Application Driver Role',
            'app_id' => $app->id
        ]);

        // Consultar el usuario
        $user_admin = User::where('nickname','DCumaco')->first(); // Usuario Administrador (Manuel Steven Ossa Lievano)

        // Asignacion de rol
        $user_admin->roles()->syncWithoutDetaching([$role_admin->id]);
    }
}
