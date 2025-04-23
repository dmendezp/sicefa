<?php

namespace Modules\SSTSENA\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name', 'SSTSENA')->firstOrFail();

        

        // Registrar o actualizar rol de ADMINISTRADOR
        $rol_admin = Role::updateOrCreate(['slug' => 'sstsena.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol administrador de la aplicación SSTSENA',
            'description_english' => 'SSTSENA application administrator role',
            'full_access' => 'no',
            'app_id' => $app->id
        ]);
        $useradministrador = User::where('nickname', 'Wchilito')->firstOrFail();

        $useradministrador->roles()->syncWithoutDetaching([$rol_admin->id]);
    }
}
