<?php

namespace Modules\GTH\Database\Seeders;

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
        // crear listas para almacenar los permisos de cada rol
        $permissions_admin = [];
        $permissions_brigadista = [];


        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name', 'GTH')->first();


        // ---------- Registro o actualización de permiso ---------

        // Gestionar Asistencia
        $permission = Permission::updateOrCreate(['slug' => 'gth.attendance.index'], [
            'name' => 'Gestionar los Asistencia',
            'description' => 'Tendra el acceso a gestionar las asistencias',
            'description_english' => 'You will have access to manage the attendance',
            'app_id' => $app->id
        ]);
        $permissions_brigadista[] = $permission->id; // Almacenar permiso para rol



        // Consulta de ROLES
        $rol_brigadista = Role::where('slug', 'gth.brigadista')->first();

        // Asignación de permisos para roles
        $rol_brigadista->permissions()->syncWithoutDetaching($permissions_brigadista);
    }
}
