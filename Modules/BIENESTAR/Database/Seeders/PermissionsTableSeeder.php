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
        // Dashboard de administrador//
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
            'description_english' => 'You can see the CRUD view of benefits',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Crud Beneficios (LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.crud.benefits'], [ // Registro o actualización de permiso
            'name' => 'CRUD Beneficios',
            'description' => 'Puede ver la vista del CRUD de benefios',
            'description_english' => 'You can see the CRUD view of benefits',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Vista Crud Beneficios (LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.crud.benefits'], [ // Registro o actualización de permiso
            'name' => 'CRUD Beneficios',
            'description' => 'Puede ver la vista del CRUD de benefios',
            'description_english' => 'You can see the CRUD view of benefits',
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
            'description' => 'Puede editar los benefios',
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



        //*-----Permisos Transport Routes-----*//

        // Vista Crud Rutas de Trasporte (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.crud.transportroutes'], [ // Registro o actualización de permiso
            'name' => 'CRUD Rutas de Trasporte',
            'description' => 'Puede ver la vista del CRUD de rutas de transporte',
            'description_english' => 'You can see the CRUD view of transportation routes',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Crud Rutas de Trasporte(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.crud.transportroutes'], [ // Registro o actualización de permiso
            'name' => 'CRUD Rutas Trasporte',
            'description' => 'Puede ver la vista del CRUD de rutas de transporte',
            'description_english' => 'You can see the CRUD view of transportation routes',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Guardar Rutas de Trasporte(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.save.transportroutes'], [ // Registro o actualización de permiso
            'name' => 'Guardar Rutas de Trasporte',
            'description' => 'Puede guardar las rutas de transporte',
            'description_english' => 'You can save transport routes',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Guardar Rutas de Trasporte(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.save.transportroutes'], [ // Registro o actualización de permiso
            'name' => 'Guardar Rutas de Trasporte',
            'description' => 'Puede guardar las rutas de transporte',
            'description_english' => 'You can save transport routes',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Editar Rutas de Trasporte(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.edit.transportroutes'], [ // Registro o actualización de permiso
            'name' => 'Editar Rutas de Trasporte',
            'description' => 'Puede editar las rutas de trasporte',
            'description_english' => 'You can edit the transport routes',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Editar Rutas de Trasporte(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.edit.transportroutes'], [ // Registro o actualización de permiso
            'name' => 'Editar Rutas de Trasporte',
            'description' => 'Puede editar las rutas de trasporte',
            'description_english' => 'You can edit the transport routes',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Rutas de Trasporte(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.delete.transportroutes'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Rutas de Trasporte',
            'description' => 'Puede eliminar las rutas de trasporte',
            'description_english' => 'You can delete the transport routes',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Rutas de Trasporte(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.delete.transportroutes'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Rutas de Trasporte',
            'description' => 'Puede eliminar las rutas de trasporte',
            'description_english' => 'You can delete the transport routes',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rols

        // Botones de la vista CRUD Rutas de Trasporte (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.buttons.transportroutes'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD Rutas de Trasporte',
            'description' => 'Restricion a los botones de las rutas de trasporte',
            'description_english' => 'Restrictions on transportation route buttons',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Botones de la vista CRUD Rutas de Trasporte (LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.buttons.transportroutes'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD Rutas de Trasporte',
            'description' => 'Restricion a los botones de las rutas de trasporte',
            'description_english' => 'RRestrictions on transportation route buttons',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol


        //*-----Permisos Drivers-----*//

        // Vista Crud Conductores (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.crud.drivers'], [ // Registro o actualización de permiso
            'name' => 'CRUD Conductores',
            'description' => 'Puede ver la vista del CRUD de Conductores',
            'description_english' => 'You can see the CRUD view of transportation routes',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Crud Conductores(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.crud.drivers'], [ // Registro o actualización de permiso
            'name' => 'CRUD Conductores',
            'description' => 'Puede ver la vista del CRUD de conductores',
            'description_english' => 'You can see the CRUD view of transportation routes',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Guardar Conductores(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.save.drivers'], [ // Registro o actualización de permiso
            'name' => 'Guardar Conductores',
            'description' => 'Puede guardar los conductores',
            'description_english' => 'You can save the drivers',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Guardar Conductores(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.save.drivers'], [ // Registro o actualización de permiso
            'name' => 'Guardar Conductores',
            'description' => 'Puede guardar los conductores',
            'description_english' => 'You can save the driverss',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Editar Conductores(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.edit.drivers'], [ // Registro o actualización de permiso
            'name' => 'Editar Conductores',
            'description' => 'Puede editar los conductores',
            'description_english' => 'You can edit the drivers',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Editar Conductores(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.edit.drivers'], [ // Registro o actualización de permiso
            'name' => 'Editar Conductores',
            'description' => 'Puede editar los conductores',
            'description_english' => 'You can edit the drivers',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Conductores(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.delete.drivers'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Conductores',
            'description' => 'Puede eliminar los conductores',
            'description_english' => 'You can delete the drivers',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Conductores(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.delete.drivers'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Conductoress',
            'description' => 'Puede eliminar los conductores',
            'description_english' => 'You can delete the drivers',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rols


        // Botones de la vista CRUD Conductores (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.buttons.drivers'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD Conductores',
            'description' => 'Restricion a los botones de los conductores',
            'description_english' => 'Restriction on drivers buttons',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Botones de la vista CRUD Conductores (LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.buttons.drivers'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD Conductores',
            'description' => 'Restricion a los botones de los conductores',
            'description_english' => 'Restriction on drivers buttons',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        //*-----Permisos Gestions de Convocatorias-----*//
        // Vista Crud Convocations (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.crud.convocations'], [ // Registro o actualización de permiso
            'name' => 'CRUD Convocations',
            'description' => 'Puede ver la vista del CRUD de convocatorias',
            'description_english' => 'You can see the CRUD view of benefits',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Crud Convocations (LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.crud.convocations'], [ // Registro o actualización de permiso
            'name' => 'CRUD Convocations',
            'description' => 'Puede ver la vista del CRUD de convocatorias',
            'description_english' => 'You can see the CRUD view of benefits',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Vista Crud Convocations (LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.crud.convocations'], [ // Registro o actualización de permiso
            'name' => 'CRUD Convocations',
            'description' => 'Puede ver la vista del CRUD de convocatorias',
            'description_english' => 'You can see the CRUD view of Convocations',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Guardar Convocatorias(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.save.convocations'], [ // Registro o actualización de permiso
            'name' => 'Guardar Convocatorias',
            'description' => 'Puede guardar las convocatorias',
            'description_english' => 'You can save the benefits',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Guardar Convocatorias(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.save.convocations'], [ // Registro o actualización de permiso
            'name' => 'Guardar Convocatorias',
            'description' => 'Puede guardar los convocatorias',
            'description_english' => 'You can save the convocations',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Guardar Convocatorias(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.save.convocations'], [ // Registro o actualización de permiso
            'name' => 'Guardar Convocatorias',
            'description' => 'Puede guardar las convocatorias',
            'description_english' => 'You can save the convocations',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Editar Convocatorias(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.edit.convocations'], [ // Registro o actualización de permiso
            'name' => 'Editar Convocatorias',
            'description' => 'Puede guardar los convocatorias',
            'description_english' => 'You can edit the convocations',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Editar Convocatorias(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.edit.convocations'], [ // Registro o actualización de permiso
            'name' => 'Editar Convocatorias',
            'description' => 'Puede editar los convocatorias',
            'description_english' => 'You can edit the convocations',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Editar Convocatorias(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.edit.convocations'], [ // Registro o actualización de permiso
            'name' => 'Editar Convocatorias',
            'description' => 'Puede editar los convocatorias',
            'description_english' => 'You can edit the convocations',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Convocatorias(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.delete.convocations'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Convocatorias',
            'description' => 'Puede eliminar los convocatorias',
            'description_english' => 'You can eliminate the convocations',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Convocatorias(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.delete.convocations'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Convocatorias',
            'description' => 'Puede eliminar los convocatorias',
            'description_english' => 'You can eliminate the convocations',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Convocatorias(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.delete.convocations'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Convocatorias',
            'description' => 'Puede eliminar los convocatorias',
            'description_english' => 'You can eliminate the convocations',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rols

        // Botones de la vista CRUD Convocatorias (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.buttons.convocations'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD Convocatorias',
            'description' => 'Restricion a los botones de las convocatorias',
            'description_english' => 'Restriction to the buttons of the convocations',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Botones de la vista CRUD Convocatorias (LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.buttons.convocations'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD Convocatorias',
            'description' => 'Restricion a los botones de las convocatorias',
            'description_english' => 'Restriction to the buttons of the convocations',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Botones de la vista CRUD Convocatorias (LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.buttons.convocations'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD Convocatorias',
            'description' => 'Restricion a los botones de las convocatorias',
            'description_english' => 'Restriction to the buttons of the convocations',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        //*-----Permisos Formularios-----*//

        // Vista Crud Formularios (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.crud.editform'], [ // Registro o actualización de permiso
            'name' => 'CRUD Formularios',
            'description' => 'Puede ver la vista del CRUD de formularios',
            'description_english' => 'You can see the CRUD view of form',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Crud Formularios (LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.crud.editform'], [ // Registro o actualización de permiso
            'name' => 'CRUD Formularios',
            'description' => 'Puede ver la vista del CRUD de formularios',
            'description_english' => 'You can see the CRUD view of form',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Vista Crud Formularios (LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.crud.editform'], [ // Registro o actualización de permiso
            'name' => 'CRUD Formularios',
            'description' => 'Puede ver la vista del CRUD de formularios',
            'description_english' => 'You can see the CRUD view of form',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Vista Agregar Preguntas y Respuestas a los Formularios (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.add_question.editform'], [ // Registro o actualización de permiso
            'name' => 'Vista Agregar Preguntas y Respuestas',
            'description' => 'Puede ver la vista agregar preguntas y respuestas a los formularios',
            'description_english' => 'You can view the view add questions and answers to forms',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Agregar Preguntas y Respuestas a los Formularios (LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.add_question.editform'], [ // Registro o actualización de permiso
            'name' => 'Vista Agregar Preguntas y Respuestas',
            'description' => 'Puede ver la vista agregar preguntas y respuestas a los formularios',
            'description_english' => 'You can view the view add questions and answers to forms',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Vista Agregar Preguntas y Respuestas a los Formularios (LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.add_question.editform'], [ // Registro o actualización de permiso
            'name' => 'Vista Agregar Preguntas y Respuestas',
            'description' => 'Puede ver la vista agregar preguntas y respuestas a los formularios',
            'description_english' => 'You can view the view add questions and answers to forms',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Guardar Preguntas y Respuestas de los Formularios(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.save.editform'], [ // Registro o actualización de permiso
            'name' => 'Guardar Preguntas y Respuestas',
            'description' => 'Puede guardar las preguntas y respuestas de los formularios',
            'description_english' => 'You can save the questions and answers of the forms',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Guardar Preguntas y Respuestas de los Formularios(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.save.editform'], [ // Registro o actualización de permiso
            'name' => 'Guardar Preguntas y Respuestas',
            'description' => 'Puede guardar las preguntas y respuestas de los formularios',
            'description_english' => 'You can save the questions and answers of the forms',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Guardar Preguntas y Respuestas de los Formularios(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.save.editform'], [ // Registro o actualización de permiso
            'name' => 'Guardar Preguntas y Respuestas',
            'description' => 'Puede guardar las preguntas y respuestas de los formularios',
            'description_english' => 'You can save the questions and answers of the forms',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Guardar Fromulario y Convocatoria(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.saveform.editform'], [ // Registro o actualización de permiso
            'name' => 'Guardar Preguntas y Respuestas',
            'description' => 'Puede guardar la convocatoria y el formularios',
            'description_english' => 'You can save the call and the forms',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Guardar Fromulario y Convocatoria(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.saveform.editform'], [ // Registro o actualización de permiso
            'name' => 'Guardar Preguntas y Respuestas',
            'description' => 'Puede guardar la convocatoria y el formularios',
            'description_english' => 'You can save the call and the forms',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Guardar Fromulario y Convocatoria(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.saveform.editform'], [ // Registro o actualización de permiso
            'name' => 'Guardar Preguntas y Respuestas',
            'description' => 'Puede guardar la convocatoria y el formularios',
            'description_english' => 'You can save the call and the forms',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Editar Preguntas y Respuestas de los Formularios(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.edit.editform'], [ // Registro o actualización de permiso
            'name' => 'Editar Preguntas y Respuestas',
            'description' => 'Puede editar las preguntas y respuestas de los formularios',
            'description_english' => 'You can edit the questions and answers of the forms',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Editar Preguntas y Respuestas de los Formularios(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.edit.editform'], [ // Registro o actualización de permiso
            'name' => 'Editar Preguntas y Respuestas',
            'description' => 'Puede editar las preguntas y respuestas de los formularios',
            'description_english' => 'You can edit the questions and answers of the forms',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Editar Preguntas y Respuestas de los Formularios(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.edit.editform'], [ // Registro o actualización de permiso
            'name' => 'Editar Preguntas y Respuestas',
            'description' => 'Puede editar las preguntas y respuestas de los formularios',
            'description_english' => 'You can edit the questions and answers of the forms',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Preguntas y Respuestas de los Formularios(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.delete.editform'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Preguntas y Respuestas',
            'description' => 'Puede eliminar las preguntas y respuestas de los formularios',
            'description_english' => 'You can remove questions and answers from the forms',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Preguntas y Respuestas de los Formularios(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.delete.editform'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Preguntas y Respuestas',
            'description' => 'Puede eliminar las preguntas y respuestas de los formularios',
            'description_english' => 'You can remove questions and answers from the forms',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Preguntas y Respuestas de los Formularios(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.delete.editform'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Preguntas y Respuestas',
            'description' => 'Puede eliminar las preguntas y respuestas de los formularios',
            'description_english' => 'You can remove questions and answers from the forms',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rols

        // Botones de la vista CRUD Formularios (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.buttons.editform'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD de los Formularios',
            'description' => 'Restricion a los botones del formularios',
            'description_english' => 'Restriction on form buttons',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Botones de la vista CRUD Formularios (LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.buttons.editform'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD de los Formularios',
            'description' => 'Restricion a los botones del formularios',
            'description_english' => 'Restriction on form buttons',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Botones de la vista CRUD Formularios (LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.buttons.editform'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD de los Formularios',
            'description' => 'Restricion a los botones del formularios',
            'description_english' => 'Restriction on form buttons',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        //*-----Permisos Consulta-----*//



        //*-----Permisos Postulaciones-----*//



        //*-----Permisos listados apoyo alimentacion-----*//

        // Vista Listados Beneficiarios Alimentacion(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.crud.beneficiaries_food'], [ // Registro o actualización de permiso
            'name' => 'Vista de Beneficiarios Alimentacion',
            'description' => 'Puede ver la vista con el listado de los beneficiarios del apoyo de alimentacion',
            'description_english' => 'You can see the view with the list of the beneficiaries of the food support.',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Listados Beneficiarios Alimentacion(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.crud.beneficiaries_food'], [ // Registro o actualización de permiso
            'name' => 'CRUD Formularios',
            'description' => 'Puede ver la vista con el listado de los beneficiarios del apoyo de alimentacion',
            'description_english' => 'You can see the view with the list of the beneficiaries of the food support.',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

         // Botones de la vista Listados Beneficiarios Alimentacion(ADMINISTRADOR)//
         $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.buttons.beneficiaries_food'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD de los Formularios',
            'description' => 'Restricion a los botones para descargar el listado de los beneficiarios del apoyo de alimentacion',
            'description_english' => 'Restriction to the buttons to download the list of the beneficiaries of the food support.',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Botones de la vista Listados Beneficiarios Alimentacion(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.buttons.beneficiaries_food'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD de los Formularios',
            'description' => 'Restricion a los botones para descargar el listado de los beneficiarios del apoyo de alimentacion',
            'description_english' => 'Restriction to the buttons to download the list of the beneficiaries of the food support.',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'bienestar.admin')->first(); // Rol Administrador
        $rol_transportation_benefits_leader = Role::where('slug', 'bienestar.transportation.benefits.beneficiaries_food')->first(); // Rol Coordinado Académico
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