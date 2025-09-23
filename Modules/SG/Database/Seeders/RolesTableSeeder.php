<?php

namespace Modules\SG\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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

            echo "a\n";
            // Consultar aplicación SICA para registrar los roles
            $app = App::where('name', 'SG')->firstOrFail();
            echo "c\n";
        // Consultar rol  de superadministrador
        $rol_superadmin = Role::where('slug', 'superadmin')->firstOrFail();

        // Registrar o actualizar rol de ADMINISTRADOR
        $rol_admin = Role::updateOrCreate(['slug' => 'sg.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol administrador de la aplicación sg',
            'description_english' => 'sg application administrator role',
            'full_access' => 'no',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de CAJERO
        $rol_cashier = Role::updateOrCreate(['slug' => 'sg.cashier'], [
            'name' => 'Cajero',
            'description' => 'Rol cajero de la aplicación sg',
            'description_english' => 'sg application cashier role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        // Consulta de usuarios
        $user_admin = User::where('nickname', 'Darwin')->firstOrFail(); // Usuario Administrador (Lola Fernanda Herrera Hernandez)
        // $user_cashier = User::where('nickname', 'Resmerveilons')->firstOrFail(); // Usuario Cajero (Manuel Steven Ossa Lievano)
        // $user_superadmin = User::where('nickname', 'JDGM0331')->firstOrFail(); // Usuario Super Administrador (Jesús David Guevara Munar)

        // Asignación de ROLES para los USUARIOS de la aplicación sg (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $user_admin->roles()->syncWithoutDetaching([$rol_admin->id]);
        // $user_cashier->roles()->syncWithoutDetaching([$rol_cashier->id]);
        // $user_superadmin->roles()->syncWithoutDetaching([$rol_superadmin->id]);
    }
}
