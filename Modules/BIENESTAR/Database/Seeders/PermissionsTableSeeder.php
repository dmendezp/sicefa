<?php

namespace Modules\BIENESTAR\Database\Seeders;

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

        // Definir arreglos de PERMISOS que van ser asignados a los ROLES
        $permission_admin = []; // Permisos para Administrador
        $permission_transportation_benefits_leader = []; // Permisos para Líder de Beneficio Transporte
        $permission_food_benefits_leaders = []; // Permisos para Registro Líder de Beneficio Alimenacion
        $permission_feeding_assistant = []; // Permisos para Asistente de Alimentacion
        $permission_route_leader = []; // Permisos para Lider de Ruta


        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name', 'BIENESTAR')->first();



        // ===================== Registro de todos los permisos de la aplicación BIENESTAR ==================
        // Dashboard de administrador
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Admin Dashboard',
            'description' => 'Puede ver el dashboard de administrador',
            'description_english' => 'You can see the admin dashboard',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol
        //________________________________________________________________________________________________________________________________________________________________ //

        // Vista Crud Beneficios (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.crud.benefits'], [ // Registro o actualización de permiso
            'name' => 'CRUD Beneficios',
            'description' => 'Puede ver la vista del CRUD de benefios',
            'description_english' => 'You can see the admin dashboard',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Crud Beneficios (LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.crud.benefits'], [ // Registro o actualización de permiso
            'name' => 'CRUD Beneficios',
            'description' => 'Puede ver la vista del CRUD de benefios',
            'description_english' => 'You can see the admin dashboard',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Guardar de Beneficios(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.save.benefits'], [ // Registro o actualización de permiso
            'name' => 'Guardar Beneficios',
            'description' => 'Puede guardar los benefios',
            'description_english' => 'You can save the benefits',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Guardar de Beneficios(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.save.benefits'], [ // Registro o actualización de permiso
            'name' => 'Guardar Beneficios',
            'description' => 'Puede guardar los benefios',
            'description_english' => 'You can save the benefits',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Editar de Beneficios(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.edit.benefits'], [ // Registro o actualización de permiso
            'name' => 'Guardar Beneficios',
            'description' => 'Puede guardar los benefios',
            'description_english' => 'You can save the benefits',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Editar de Beneficios(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.edit.benefits'], [ // Registro o actualización de permiso
            'name' => 'Editar Beneficios',
            'description' => 'Puede editar los benefios',
            'description_english' => 'You can edit the benefits',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar de Beneficios(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.delete.benefits'], [ // Registro o actualización de permiso
            'name' => 'Guardar Beneficios',
            'description' => 'Puede eliminar los benefios',
            'description_english' => 'You can eliminate the benefits',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar de Beneficios(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.delete.benefits'], [ // Registro o actualización de permiso
            'name' => 'Editar Beneficios',
            'description' => 'Puede eliminar los benefios',
            'description_english' => 'You can eliminate the benefits',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol


        // Botones de la vista CRUD Beneficios (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.buttons.benefits'], [ // Registro o actualización de permiso
            'name' => 'Guardar Beneficios',
            'description' => 'Puede guardar los benefios',
            'description_english' => 'You can save the benefits',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Botones de la vista CRUD Beneficios (LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.buttons.benefits'], [ // Registro o actualización de permiso
            'name' => 'Guardar Beneficios',
            'description' => 'Puede guardar los benefios',
            'description_english' => 'You can save the benefits',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Botones de la vista CRUD Beneficios (LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.buttons.benefits'], [ // Registro o actualización de permiso
            'name' => 'Guardar Beneficios',
            'description' => 'Puede guardar los benefios',
            'description_english' => 'You can save the benefits',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol


        
        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'bienestar.admin')->first(); // Rol Administrador
        $rol_transportation_benefits_leader = Role::where('slug', 'bienestar.transportation.benefits.leader')->first(); // Rol Coordinado Académico
        $rol_food_benefits_leader = Role::where('slug', 'bienestar.food.benefits.leader')->first(); // Rol Registro Asistencia
        $rol_feeding_assistant = Role::where('slug', 'bienestar.feeding.assistant')->first(); // Rol Registro Asistencia
        $rol_route_leader = Role::where('slug', 'bienestar.route.leader')->first(); // Rol Registro Asistencia

        // Asignación de PERMISOS para los ROLES de la aplicación SICA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()->syncWithoutDetaching($permission_admin);
        $rol_transportation_benefits_leader->permissions()->syncWithoutDetaching($permission_transportation_benefits_leader);
        $rol_food_benefits_leader->permissions()->syncWithoutDetaching($permission_food_benefits_leaders);
        $rol_feeding_assistant->permissions()->syncWithoutDetaching($permission_feeding_assistant);
        $rol_route_leader->permissions()->syncWithoutDetaching($permission_route_leader);
    }
}
