<?php

namespace Modules\DICSENA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Permission;
use Modules\SICA\Entities\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission_instructor = []; // Permisos para Instrucor

        $app = App::where('name', 'DICSENA')->first();
        // $this->call("OthersTableSeeder");

        $permission = Permission::updateOrCreate(['slug' => 'dicsena.menu'], [
            'name' => 'Subir guias y glosarios',
            'description' => 'Tendra el acceso a gestionar las guias y glosarios.',
            'description_english' => 'You will have access to manage guides and glossaries.',
            'app_id' => $app->id
        ]);
        $permissions_brigadista[] = $permission->id; // Almacenar permiso para rol

        // Consulta de ROLES
        $rol_instructor = Role::where('slug', 'gth.instructor')->first();

        // Asignación de permisos para roles
        $rol_instructor->permissions()->syncWithoutDetaching($permissions_instructor);
    }
}
