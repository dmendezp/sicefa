<?php

namespace Modules\GTH\Database\Seeders;


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
        $app = App::where('name','GTH')->first();


        // Registrar o actualizar rol de administrador en GTH
        $roladministrador = Role::updateOrCreate(['slug' => 'gth.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol de Administrador GTH',
            'description_english' => 'Role of GTH Administrator',
            'full_access' => 'no',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de Brigadista en GTH
        $rolbrigadista = Role::updateOrCreate(['slug' => 'gth.brigadista'], [
            'name' => 'Brigadista',
            'description' => 'Rol Brigadista para el registro de labores GTH',
            'description_english' => 'Brigadista role for registration of GTH labor',
            'full_access' => 'no',
            'app_id' => $app->id
        ]);


        // Consulta de usuarios
        $useradministrador = User::where('nickname','Daniel')->first();
        $userbrigadista = User::where('nickname','Mayerly')->first();


        // Asignacion de roles a usuarios
        $useradministrador->roles()->syncWithoutDetaching([$roladministrador->id]);
        $userbrigadista->roles()->syncWithoutDetaching([$roladministrador->id]);


    }
}
