<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

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
        $permission_intern = []; // Permisos para Pasante
        $permission_user = []; // Permisos para usuario


        // Consultar aplicación SENAEMPRESA para registrar los roles
        $app = App::where('name', 'SENAEMPRESA')->first();

        // Home de todos los roles
        $permission = Permission::updateOrCreate(['slug' => 'senamepresa.index'], [ // Registro o actualización de permiso
            'name' => 'Vista Inicio',
            'description' => 'Puede ver el inicio',
            'description_english' => 'You can see the start',
            'app_id' => $app->id
        ]);
        $permission_intern[] = $permission->id; // Almacenar permiso para rol
        $permission_user[] = $permission->id; // Almacenar permiso para rol

        // Vista Contactos
        $permission = Permission::updateOrCreate(['slug' => 'company.contact'], [ // Registro o actualización de permiso
            'name' => 'Vista Contacto',
            'description' => 'Puede ver vista de contactos',
            'description_english' => 'You can see contact view',
            'app_id' => $app->id
        ]);
        $permission_intern[] = $permission->id; // Almacenar permiso para rol
        $permission_user[] = $permission->id; // Almacenar permiso para rol

        // Vista Estrategias senaempresa
        $permission = Permission::updateOrCreate(['slug' => 'company.senaempresa'], [ // Registro o actualización de permiso
            'name' => 'Vista SenaEmpresa Estrategias',
            'description' => 'Puede ver vista de SenaEmpresa Estrategias',
            'description_english' => 'You can see a view of SenaEmpresa Estrategias',
            'app_id' => $app->id
        ]);
        $permission_intern[] = $permission->id; // Almacenar permiso para rol
        $permission_user[] = $permission->id; // Almacenar permiso para rol

        // Consulta de ROLES
        $rol_pasante = Role::where('slug', 'senaempresa.pasante')->first(); // Rol Pasante Senaempresa
        $rol_usuario = Role::where('slug', 'senaempresa.usuario')->first(); // Rol Usuario Senaempresa

        // Asignación de PERMISOS para los ROLES de la aplicación SENAEMPRESA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_pasante->permissions()->syncWithoutDetaching($permission_intern);
        $rol_usuario->permissions()->syncWithoutDetaching($permission_user);
    }
}
