<?php

namespace Modules\GVFF\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Permission;
use Modules\SICA\Entities\Role;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        // Lista de permisos
        $permissions_admin = [];

        // Consultar aplicación GVFF
        $app = App::where('name', 'GVFF')->firstOrFail();

        // Permiso para el panel de administrador
        $permission = Permission::updateOrCreate(['slug' => 'gvff.index'], [
            'name' => 'Acceso al Panel de Administrador',
            'description' => 'Permite acceder al panel de bienvenida de administrador',
            'description_english' => 'Allows access to the administrator welcome panel',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        // Permisos para el CRUD de Viveros
        $viveros_permissions = [
            [
                'slug' => 'gvff.admin.viveros.index',
                'name' => 'Ver lista de viveros',
                'description' => 'Permite ver la lista de viveros',
                'description_english' => 'Allows viewing the list of viveros',
            ],
            [
                'slug' => 'gvff.admin.viveros.create',
                'name' => 'Crear viveros',
                'description' => 'Permite crear nuevos viveros',
                'description_english' => 'Allows creating new viveros',
            ],
            [
                'slug' => 'gvff.admin.viveros.edit',
                'name' => 'Editar viveros',
                'description' => 'Permite editar viveros existentes',
                'description_english' => 'Allows editing existing viveros',
            ],
            [
                'slug' => 'gvff.admin.viveros.delete',
                'name' => 'Eliminar viveros',
                'description' => 'Permite eliminar viveros',
                'description_english' => 'Allows deleting viveros',
            ],
        ];

        // Crear permisos para Viveros y añadirlos a la lista de permisos del administrador
        foreach ($viveros_permissions as $perm) {
            $permission = Permission::updateOrCreate(['slug' => $perm['slug']], [
                'name' => $perm['name'],
                'description' => $perm['description'],
                'description_english' => $perm['description_english'],
                'app_id' => $app->id
            ]);
            $permissions_admin[] = $permission->id;
        }

        // Consultar rol de administrador
        $rol_admin = Role::where('slug', 'gvff.admin')->first();

        // Asignar permisos al rol administrador
        if ($rol_admin) {
            $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);
        }
    }
}

