<?php

namespace Modules\LOMBRISOFT\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Permission;
use Modules\SICA\Entities\Role;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        // Obtener aplicación LOMBRISOFT
        $app = App::where('name', 'LOMBRISOFT')->first();

        /** ============================================
         *  PERMISOS PARA ADMINISTRADOR
         *  ============================================ */
        $permissions_admin = [];

        // Acceso al panel de administrador
        $permissions_admin[] = Permission::updateOrCreate(
            ['slug' => 'lombrisoft.admin.welcome'],
            [
                'name' => 'Acceso al Rol de Administrador',
                'description' => 'Acceso al Rol de Administrador',
                'description_english' => 'Access to the Administrator Role',
                'app_id' => $app->id,
            ]
        )->id;

        // Acceso a la lista de camas (index)
        $permissions_admin[] = Permission::updateOrCreate(
            ['slug' => 'lombrisoft.admin.camas.index'],
            [
                'name' => 'Acceso a la lista de camas',
                'description' => 'Permite acceder a la lista de camas del administrador',
                'description_english' => 'Allows access to the administrator worm bed list',
                'app_id' => $app->id,
            ]
        )->id;

        // Crear camas (create)
        $permissions_admin[] = Permission::updateOrCreate(
            ['slug' => 'lombrisoft.admin.camas.create'],
            [
                'name' => 'Crear camas',
                'description' => 'Permite crear nuevas camas',
                'description_english' => 'Allows creating new worm beds',
                'app_id' => $app->id,
            ]
        )->id;
        $permissions_admin[] = Permission::updateOrCreate(
            ['slug' => 'lombrisoft.admin.camas.store'],
            [
                'name' => 'Crear camas',
                'description' => 'Permite crear nuevas camas',
                'description_english' => 'Allows creating new worm beds',
                'app_id' => $app->id,
            ]
        )->id;

        // Ver detalles de cama (show)
        $permissions_admin[] = Permission::updateOrCreate(
            ['slug' => 'lombrisoft.admin.camas.show'],
            [
                'name' => 'Ver detalles de cama',
                'description' => 'Permite ver los detalles de una cama',
                'description_english' => 'Allows viewing worm bed details',
                'app_id' => $app->id,
            ]
        )->id;

        // Editar camas (edit)
        $permissions_admin[] = Permission::updateOrCreate(
            ['slug' => 'lombrisoft.admin.camas.edit'],
            [
                'name' => 'Editar camas',
                'description' => 'Permite editar la información de las camas',
                'description_english' => 'Allows editing worm beds',
                'app_id' => $app->id,
            ]
        )->id;

        // Guardar cambios (actualizar camas - update)
        $permissions_admin[] = Permission::updateOrCreate(
            ['slug' => 'lombrisoft.admin.camas.update'],
            [
                'name' => 'Guardar cambios de camas',
                'description' => 'Permite guardar los cambios realizados en las camas',
                'description_english' => 'Allows saving worm bed changes',
                'app_id' => $app->id,
            ]
        )->id;

        // Eliminar camas (destroy)
        $permissions_admin[] = Permission::updateOrCreate(
            ['slug' => 'lombrisoft.admin.camas.destroy'],
            [
                'name' => 'Eliminar camas',
                'description' => 'Permite eliminar camas',
                'description_english' => 'Allows deleting worm beds',
                'app_id' => $app->id,
            ]
        )->id;

        // Asignar permisos al rol administrador
        $rol_admin = Role::where('slug', 'lombrisoft.admin')->first();
        $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);


        /** ============================================
         *  PERMISOS PARA PASANTE
         *  ============================================ */
        $permissions_intern = [];

        // Acceso al panel del pasante
        $permissions_intern[] = Permission::updateOrCreate(
            ['slug' => 'lombrisoft.intern.paneli'],
            [
                'name' => 'Acceso al Rol de Pasante',
                'description' => 'Acceso al Rol de Pasante',
                'description_english' => 'Access to the Intern Role',
                'app_id' => $app->id,
            ]
        )->id;

        // Asignar permisos al rol pasante
        $rol_intern = Role::where('slug', 'lombrisoft.intern')->first();
        $rol_intern->permissions()->syncWithoutDetaching($permissions_intern);
    }
}