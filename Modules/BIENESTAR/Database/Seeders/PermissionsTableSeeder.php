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

        // Vista Crud Beneficios (LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.crud.benefits'], [ // Registro o actualización de permiso
            'name' => 'CRUD Beneficios',
            'description' => 'Puede ver la vista del CRUD de benefios',
            'description_english' => 'You can see the admin dashboard',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

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

        // Ruta Fromulario Guardar de Beneficios(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.save.benefits'], [ // Registro o actualización de permiso
            'name' => 'Guardar Beneficios',
            'description' => 'Puede guardar los benefios',
            'description_english' => 'You can save the benefits',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Editar de Beneficios(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.edit.benefits'], [ // Registro o actualización de permiso
            'name' => 'Editar Beneficios',
            'description' => 'Puede guardar los benefios',
            'description_english' => 'You can edit the benefits',
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

        // Ruta Fromulario Editar de Beneficios(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.edit.benefits'], [ // Registro o actualización de permiso
            'name' => 'Editar Beneficios',
            'description' => 'Puede editar los benefios',
            'description_english' => 'You can edit the benefits',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar de Beneficios(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.delete.benefits'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Beneficios',
            'description' => 'Puede eliminar los benefios',
            'description_english' => 'You can eliminate the benefits',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar de Beneficios(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.delete.benefits'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Beneficios',
            'description' => 'Puede eliminar los benefios',
            'description_english' => 'You can eliminate the benefits',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar de Beneficios(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.delete.benefits'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Beneficios',
            'description' => 'Puede eliminar los benefios',
            'description_english' => 'You can eliminate the benefits',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rols


        // Botones de la vista CRUD Beneficios (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.buttons.benefits'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD Beneficios',
            'description' => 'Restricion a los botones de los benefios',
            'description_english' => 'Restriction on benefit buttons',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Botones de la vista CRUD Beneficios (LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.buttons.benefits'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD Beneficios',
            'description' => 'Restricion a los botones de los benefios',
            'description_english' => 'Restriction on benefit buttons',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Botones de la vista CRUD Beneficios (LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.buttons.benefits'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD Beneficios',
            'description' => 'Restricion a los botones de los benefios',
            'description_english' => 'Restriction on benefit buttons',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        //*-----Permisos Vista Tipo de Beneficiarios-----*//
        // Vista Crud Tipo de Beneficiarios (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.crud.typeofbenefitss'], [ // Registro o actualización de permiso
            'name' => 'CRUD Tipo de Beneficiarios',
            'description' => 'Puede ver la vista del CRUD de tipos de beneficiario',
            'description_english' => 'You can see the CRUD view of types of beneficiaries',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Crud Tipo de Beneficiarios (LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.crud.typeofbenefitss'], [ // Registro o actualización de permiso
            'name' => 'CRUD Tipo de Beneficiarios',
            'description' => 'Puede ver la vista del CRUD de tipos de beneficiario',
            'description_english' => 'You can see the CRUD view of types of beneficiaries',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Vista Crud Tipo de Beneficiarios (LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.crud.typeofbenefitss'], [ // Registro o actualización de permiso
            'name' => 'CRUD Tipo de Beneficiarios',
            'description' => 'Puede ver la vista del CRUD de tipos de beneficiario',
            'description_english' => 'You can see the CRUD view of types of beneficiaries',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Guardar Tipo de Beneficiarios(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.save.typeofbenefitss'], [ // Registro o actualización de permiso
            'name' => 'Guardar Beneficios',
            'description' => 'Puede guardar los Tipos de beneficiariosos',
            'description_english' => 'You can save the benefits',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Guardar Tipo de Beneficiarios(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.save.typeofbenefitss'], [ // Registro o actualización de permiso
            'name' => 'Guardar Beneficios',
            'description' => 'Puede guardar los Tipos de beneficiariosos',
            'description_english' => 'You can save the benefits',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Guardar Tipo de Beneficiarios(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.save.typeofbenefitss'], [ // Registro o actualización de permiso
            'name' => 'Guardar Beneficios',
            'description' => 'Puede guardar los Tipos de beneficiariosos',
            'description_english' => 'You can save the benefits',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Editar Tipo de Beneficiarios(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.edit.typeofbenefitss'], [ // Registro o actualización de permiso
            'name' => 'Guardar Tipos de Beneficiarios',
            'description' => 'Puede editar los Tipos de beneficiariosos',
            'description_english' => 'You can edit the Beneficiary Types',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Editar Tipo de Beneficiarios(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.edit.typeofbenefitss'], [ // Registro o actualización de permiso
            'name' => 'Editar Tipos de beneficiarios',
            'description' => 'Puede Editar los Tipos de beneficiarios',
            'description_english' => 'You can edit the Beneficiary Types',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Editar Tipo de Beneficiarios(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.edit.typeofbenefitss'], [ // Registro o actualización de permiso
            'name' => 'Editar Tipos de Beneficiarios',
            'description' => 'Puede Editar los Tipos de beneficiarios',
            'description_english' => 'You can edit the Beneficiary Types',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

         // Ruta Fromulario Eliminar Tipo de Beneficiarios(ADMINISTRADOR)//
         $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.delete.typeofbenefitss'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Beneficios',
            'description' => 'Puede eliminar los benefios',
            'description_english' => 'You can eliminate the benefits',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Tipo de Beneficiarios(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.delete.typeofbenefitss'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Beneficios',
            'description' => 'Puede eliminar los benefios',
            'description_english' => 'You can eliminate the benefits',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Tipo de Beneficiarios(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.delete.typeofbenefitss'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Beneficios',
            'description' => 'Puede eliminar los benefios',
            'description_english' => 'You can eliminate the benefits',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rols

        // Botones de la vista CRUD Tipo de Beneficiarios (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.buttons.typeofbenefitss'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD Beneficios',
            'description' => 'Restricción a los botones de los tipos de beneficiarios',
            'description_english' => 'Restriction to the buttons of the types of beneficiaries',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Botones de la vista CRUD Tipo de Beneficiarios (LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.buttons.typeofbenefitss'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD Beneficios',
            'description' => 'Restricción a los botones de los tipos de beneficiarios',
            'description_english' => 'Restriction to the buttons of the types of beneficiaries',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Botones de la vista CRUD Tipo de Beneficiarios (LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.buttons.typeofbenefitss'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD Beneficios',
            'description' => 'Restricción a los botones de los tipos de beneficiarios',
            'description_english' => 'Restriction to the buttons of the types of beneficiaries',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        //*-----Permisos Buses-----*//
        // Vista Crud Buses (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.crud.buses'], [ // Registro o actualización de permiso
            'name' => 'CRUD de Buses',
            'description' => 'Puede ver la vista del CRUD de buses',
            'description_english' => 'You can see the CRUD view of buses',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Crud Buses (LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.crud.buses'], [ // Registro o actualización de permiso
            'name' => 'CRUD de Buses',
            'description' => 'Puede ver la vista del CRUD de buses',
            'description_english' => 'You can see the CRUD view of buses',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Vista Crud Buses (LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.crud.buses'], [ // Registro o actualización de permiso
            'name' => 'CRUD de Buses',
            'description' => 'Puede ver la vista del CRUD de buses',
            'description_english' => 'You can see the CRUD view of buses',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

         // Ruta Fromulario Guardar Buses(ADMINISTRADOR)//
         $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.save.buses'], [ // Registro o actualización de permiso
            'name' => 'Guardar Buses',
            'description' => 'Puede guardar los buses',
            'description_english' => 'You can save the buses',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Guardar Buses(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.save.buses'], [ // Registro o actualización de permiso
            'name' => 'Guardar Buses',
            'description' => 'Puede guardar los buses',
            'description_english' => 'You can save the buses',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Guardar Buses(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.save.buses'], [ // Registro o actualización de permiso
            'name' => 'Guardar Buses',
            'description' => 'Puede guardar los buses',
            'description_english' => 'You can save the buses',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Editar Buses(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.edit.buses'], [ // Registro o actualización de permiso
            'name' => 'Editar Buses',
            'description' => 'Puede editar los buses',
            'description_english' => 'You can edit the buses',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Editar Buses(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.edit.buses'], [ // Registro o actualización de permiso
            'name' => 'Editar Buses',
            'description' => 'Puede Editar los buses',
            'description_english' => 'You can edit the buses',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Editar Buses(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.edit.buses'], [ // Registro o actualización de permiso
            'name' => 'Editar Buses',
            'description' => 'Puede Editar los buses',
            'description_english' => 'You can edit the buses',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Buses(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.delete.buses'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Buses',
            'description' => 'Puede eliminar los Buses',
            'description_english' => 'You can eliminate the Buses',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Buses(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.delete.buses'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Buses',
            'description' => 'Puede eliminar los Buses',
            'description_english' => 'You can eliminate the Buses',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Buses(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.delete.buses'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Buses',
            'description' => 'Puede eliminar los Buses',
            'description_english' => 'You can eliminate the Buses',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rols

        // Botones de la vista CRUD Buses (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.buttons.buses'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD Buses',
            'description' => 'Restricción a los botones de los Buses',
            'description_english' => 'Restriction to the buttons of the Buses',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Botones de la vista CRUD Buses (LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.buttons.buses'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD Buses',
            'description' => 'Restricción a los botones de los Buses',
            'description_english' => 'Restriction to the buttons of the Buses',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Botones de la vista CRUD Buses (LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.buttons.buses'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD Buses',
            'description' => 'Restricción a los botones de los Buses',
            'description_english' => 'Restriction to the buttons of the Buses',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        //*-----Permisos Pivote Benefits Types Of Benefits-----*//
        // Vista Pivote Benefits Types Of Benefits (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.view.benefitstypeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'Pivote Beneficios y Tipo de beneficiarios',
            'description' => 'Puede ver la vista Pivote de Beneficios y tipos de beneficiario',
            'description_english' => 'You can view the Benefits Pivot view and types of beneficiaries.',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Pivote Benefits Types Of Benefits (LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.view.benefitstypeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'Pivote Beneficios y Tipo de beneficiarios',
            'description' => 'Puede ver la vista Pivote de Beneficios y tipos de beneficiario',
            'description_english' => 'You can view the Benefits Pivot view and types of beneficiaries.',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Vista Pivote Benefits Types Of Benefits (LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.view.benefitstypeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'Pivote Beneficios y Tipo de beneficiarios',
            'description' => 'Puede ver la vista Pivote de Beneficios y tipos de beneficiario',
            'description_english' => 'You can view the Benefits Pivot view and types of beneficiaries.',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol 
        
        // Ruta Actualizar Estado Check(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.updateInline.benefitstypeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'Actualiza Estado Check',
            'description' => 'Puede Actualizar el Estado Check',
            'description_english' => 'You can update the Check Status',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Actualizar Estado Check(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.updateInline.benefitstypeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'Actualiza Estado Check',
            'description' => 'Puede Actualizar el Estado Check',
            'description_english' => 'You can update the Check Status',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Actualizar Estado Check(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.updateInline.benefitstypeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'Actualiza Estado Check',
            'description' => 'Puede Actualizar el Estado Check',
            'description_english' => 'You can update the Check Status',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rols

         // Ruta Obtener Estado Check(ADMINISTRADOR)//
         $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.getCurrentState.benefitstypeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'Obtiene Estado Check',
            'description' => 'Puede Obtener el Estado Check',
            'description_english' => 'You can obtain the Check Status',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Obtener Estado Check(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.getCurrentState.benefitstypeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'Obtiene Estado Check',
            'description' => 'Puede Obtener el Estado Check',
            'description_english' => 'You can obtain the Check Status',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Obtener Estado Check(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.getCurrentState.benefitstypeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'Obtiene Estado Check',
            'description' => 'Puede Obtener el Estado Check',
            'description_english' => 'You can obtain the Check Status',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rols

        //*-----Permisos Postulations Management-----*//

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
