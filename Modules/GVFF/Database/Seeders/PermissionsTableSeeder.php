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
        $nurseries_permissions = [
            [
                'slug' => 'gvff.admin.nurseries.index',
                'name' => 'Ver lista de viveros',
                'description' => 'Permite ver la lista de viveros',
                'description_english' => 'Allows viewing the list of viveros',
            ],
            [
                'slug' => 'gvff.admin.nurseries.create',
                'name' => 'Crear viveros',
                'description' => 'Permite crear nuevos viveros',
                'description_english' => 'Allows creating new viveros',
            ],
            [
                'slug' => 'gvff.admin.nurseries.store',
                'name' => 'Crear un nuevo vivero',
                'description' => 'Permite crear nuevos viveros',
                'description_english' => 'Creating new viveros',
            ],
            [
                'slug' => 'gvff.admin.nurseries.edit',
                'name' => 'Editar viveros',
                'description' => 'Permite editar viveros existentes',
                'description_english' => 'Allows editing existing viveros',
            ],
            [
                'slug' => 'gvff.admin.nurseries.update',
                'name' => 'Actualizar viveros',
                'description' => 'Permite actualizar un vivero editado',
                'description_english' => 'Allows updating viveros',
            ],
            [
                'slug' => 'gvff.admin.nurseries.destroy',
                'name' => 'Eliminar viveros',
                'description' => 'Permite eliminar viveros',
                'description_english' => 'Allows deleting viveros',
            ],
            [
                'slug' => 'gvff.admin.nurseries.showPlants',
                'name' => 'Mostrar las plantas',
                'description' => 'Permite mostrar la splantas',
                'description_english' => 'Allows deleting plants',
            ],


            
        ];

        // Crear permisos para Viveros y añadirlos a la lista de permisos del administrador
        foreach ($nurseries_permissions as $perm) {
            $permission = Permission::updateOrCreate(
                ['slug' => $perm['slug']],
                [
                    'name' => $perm['name'],
                    'description' => $perm['description'],
                    'description_english' => $perm['description_english'],
                    'app_id' => $app->id
                ]
            );
            $permissions_admin[] = $permission->id;
        }

        

        // Permisos para el CRUD de Plantas
        $plants_permissions = [
            [
                'slug' => 'gvff.admin.plants.index',
                'name' => 'Ver lista de plantas',
                'description' => 'Permite ver la lista de plantas',
                'description_english' => 'Allows viewing the list of plants',
            ],
            [
                'slug' => 'gvff.admin.plants.create',
                'name' => 'Crear plantas',
                'description' => 'Permite crear nuevas plantas',
                'description_english' => 'Allows creating new plants',
            ],
            [
                'slug' => 'gvff.admin.plants.store',
                'name' => 'Crear una nueva planta',
                'description' => 'Permite crear nuevas plantas',
                'description_english' => 'Creating new plants',
            ],
            [
                'slug' => 'gvff.admin.plants.edit',
                'name' => 'Editar plantas',
                'description' => 'Permite editar plantas existentes',
                'description_english' => 'Allows editing existing plants',
            ],
            [
                'slug' => 'gvff.admin.plants.update',
                'name' => 'Actualizar plantas',
                'description' => 'Permite actualizar una planta editada',
                'description_english' => 'Allows updating plants',
            ],
            [
                'slug' => 'gvff.admin.plants.destroy',
                'name' => 'Eliminar plantas',
                'description' => 'Permite eliminar plantas',
                'description_english' => 'Allows deleting plants',
            ],
        
            [
                'slug' => 'gvff.admin.plants.sell',
                'name' => 'Vender plantas',
                'description' => 'Permite vender plantas',
                'description_english' => 'Allows selling plants',
            ],
            [
                'slug' => 'gvff.admin.plants.processSell',
                'name' => 'Procesar venta de plantas',
                'description' => 'Permite procesar la venta de plantas',
                'description_english' => 'Allows processing the sale of plants',
            ],
            // Nuevos permisos para rutas de creación por tipo
            [
                'slug' => 'gvff.admin.plants.ornamental.create',
                'name' => 'Crear planta ornamental',
                'description' => 'Permite mostrar el formulario para crear plantas ornamentales',
                'description_english' => 'Allows displaying the form to create ornamental plants',
            ],
            [
                'slug' => 'gvff.admin.plants.ornamental.store',
                'name' => 'Almacenar planta ornamental',
                'description' => 'Permite guardar una nueva planta ornamental',
                'description_english' => 'Allows storing a new ornamental plant',
            ],
            [
                'slug' => 'gvff.admin.plants.medicinal.create',
                'name' => 'Crear planta medicinal',
                'description' => 'Permite mostrar el formulario para crear plantas medicinales',
                'description_english' => 'Allows displaying the form to create medicinal plants',
            ],
            [
                'slug' => 'gvff.admin.plants.medicinal.store',
                'name' => 'Almacenar planta medicinal',
                'description' => 'Permite guardar una nueva planta medicinal',
                'description_english' => 'Allows storing a new medicinal plant',
            ],
            [
                'slug' => 'gvff.admin.plants.venta.create',
                'name' => 'Crear planta en venta',
                'description' => 'Permite mostrar el formulario para crear plantas en venta',
                'description_english' => 'Allows displaying the form to create plants for sale',
            ],
            [
                'slug' => 'gvff.admin.plants.venta.store',
                'name' => 'Almacenar planta en venta',
                'description' => 'Permite guardar una nueva planta en venta',
                'description_english' => 'Allows storing a new plant for sale',
            ],
            [
                'slug' => 'gvff.admin.plants.forestal.create',
                'name' => 'Crear planta forestal',
                'description' => 'Permite mostrar el formulario para crear plantas forestales',
                'description_english' => 'Allows displaying the form to create forestal plants',
            ],
            [
                'slug' => 'gvff.admin.plants.forestal.store',
                'name' => 'Almacenar planta forestal',
                'description' => 'Permite guardar una nueva planta forestal',
                'description_english' => 'Allows storing a new forestal plant',
            ],
        ];

        // Crear permisos para Plantas y añadirlos a la lista de permisos del administrador
        foreach ($plants_permissions as $perm) {
            $permission = Permission::updateOrCreate(
                ['slug' => $perm['slug']],
                [
                    'name' => $perm['name'],
                    'description' => $perm['description'],
                    'description_english' => $perm['description_english'],
                    'app_id' => $app->id
                ]
            );
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