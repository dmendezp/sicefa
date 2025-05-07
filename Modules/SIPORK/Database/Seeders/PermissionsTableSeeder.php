<?php

namespace Modules\SIPORK\Database\Seeders;

use Illuminate\Database\Seeder;
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
        // Crear una lista de permisos para el rol 
        $permissions_admin = []; // Lista de permisos para el rol de administrador
        $permissions_liderDeUnidad = []; // Lista de permisos para el rol de liderDeUnidad
        $permissions_aprendiz = []; // Lista de permisos para el rol de aprendiz
        
        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name', 'sipork')->first();


        // Vista de configuración (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sipork.admin.welcome'], [ // Registro o actualización de permiso
            'name' => 'Acceso al Rol de Administrador',
            'description' => 'Acceso al Rol de Administrador',
            'description_english' => 'Access to the Administrator Role',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Permiso para que el administrador pueda acceder al índice
        $permission_index = Permission::updateOrCreate(['slug' => 'sipork.admin.index'], [ // Registro o actualización de permiso
            'name' => 'Acceso al índice como Administrador',
            'description' => 'Permiso para que el Administrador pueda acceder al índice',
            'description_english' => 'Permission for the Administrator to access the index',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission_index->id; // Almacenar permiso para rol

        // Permiso para que el administrador pueda crear
        $permission_create = Permission::updateOrCreate(['slug' => 'sipork.admin.create'], [ // Registro o actualización de permiso
            'name' => 'Crear contenido como Administrador',
            'description' => 'Permiso para que el Administrador pueda crear contenido',
            'description_english' => 'Permission for the Administrator to create content',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission_create->id; // Almacenar permiso para rol

        // Permiso para que el administrador pueda almacenar
        $permission_store = Permission::updateOrCreate(['slug' => 'sipork.admin.store'], [ // Registro o actualización de permiso
            'name' => 'Almacenar contenido como Administrador',
            'description' => 'Permiso para que el Administrador pueda almacenar contenido',
            'description_english' => 'Permission for the Administrator to store content',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission_store->id; // Almacenar permiso para rol

        // Permiso para que el administrador pueda editar
        $permission_edit = Permission::updateOrCreate(['slug' => 'sipork.admin.edit'], [ // Registro o actualización de permiso
            'name' => 'Editar contenido como Administrador',
            'description' => 'Permiso para que el Administrador pueda editar contenido',
            'description_english' => 'Permission for the Administrator to edit content',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission_edit->id; // Almacenar permiso para rol

        // Permiso para que el administrador pueda mostrar
        $permission_show = Permission::updateOrCreate(['slug' => 'sipork.admin.show'], [ // Registro o actualización de permiso
            'name' => 'Mostrar contenido como Administrador',
            'description' => 'Permiso para que el Administrador pueda mostrar contenido',
            'description_english' => 'Permission for the Administrator to show content',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission_show->id; // Almacenar permiso para rol

        // Permiso para que el administrador pueda actualizar
        $permission_update = Permission::updateOrCreate(['slug' => 'sipork.admin.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar contenido como Administrador',
            'description' => 'Permiso para que el Administrador pueda actualizar contenido',
            'description_english' => 'Permission for the Administrator to update content',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission_update->id; // Almacenar permiso para rol

        // Permiso para que el administrador pueda eliminar
        $permission_destroy = Permission::updateOrCreate(['slug' => 'sipork.admin.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar contenido como Administrador',
            'description' => 'Permiso para que el Administrador pueda eliminar contenido',
            'description_english' => 'Permission for the Administrator to destroy content',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission_destroy->id; // Almacenar permiso para rol

        // Vista de configuración (liderDeUnidad)
        $permission_liderDeUnidad = Permission::updateOrCreate(['slug' => 'sipork.liderDeUnidad.panelLider'], [ // Registro o actualización de permiso
            'name' => 'Acceso al Rol de liderDeUnidad',
            'description' => 'Acceso al Rol de liderDeUnidad',
            'description_english' => 'Access to the liderDeUnidad Role',
            'app_id' => $app->id
        ]);
        $permissions_liderDeUnidad[] = $permission_liderDeUnidad->id; // Almacenar permiso para rol

        // Vista de configuración (Aprendiz)
        $permission_aprendiz = Permission::updateOrCreate(['slug' => 'sipork.aprendiz.panelAprendiz'], [ // Registro o actualización de permiso
            'name' => 'Acceso al Rol de Aprendiz',
            'description' => 'Acceso al Rol de Aprendiz',
            'description_english' => 'Access to the Apprentice Role',
            'app_id' => $app->id
        ]);
        $permissions_aprendiz[] = $permission_aprendiz->id; // Almacenar permiso para rol
        


        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'sipork.admin')->first(); // Rol Administrador
        $rol_liderDeUnidad = Role::where('slug', 'sipork.liderDeUnidad')->first(); // Rol liderDeUnidad
        $rol_aprendiz = Role::where('slug', 'sipork.aprendiz')->first(); // Rol Aprendiz
       

        // Asignación de PERMISOS para los ROLES de la aplicación SIPORK (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);
        $rol_liderDeUnidad->permissions()->syncWithoutDetaching($permissions_liderDeUnidad); // Asignar permisos al rol de liderDeUnidad
        $rol_aprendiz->permissions()->syncWithoutDetaching($permissions_aprendiz); // Asignar permisos al rol de aprendiz
      
    }
}