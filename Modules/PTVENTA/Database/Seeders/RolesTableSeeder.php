<?php

namespace Modules\PTVENTA\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name','PTVENTA')->first();


        // Registrar o actualizar rol de ADMINISTRADOR
        $rol_admin = Role::updateOrCreate(['slug' => 'ptventa.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol Administrador de la aplicacion PTVENTA',
            'description_english' => 'PTVENTA Application Administrator Role',
            'app_id' => $app->id
        ]);


        // Consulta de usuarios
        $user_admin = User::where('nickname','LFHerre')->first(); // Usuario Administrador (Lola Fernanda Herrera Hernandez)

        // Asignación de ROLES para los USUARIOS de la aplicación SICA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $user_admin->roles()->syncWithoutDetaching([$rol_admin->id]);

    }
}
