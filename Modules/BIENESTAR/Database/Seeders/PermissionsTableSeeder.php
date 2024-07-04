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

        // Dashboard de Lider Beneficio de Alimentacion//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Lider Beneficio de Alimentacion Dashboard',
            'description' => 'Puede ver el dashboard de administrador',
            'description_english' => 'You can see the admin dashboard',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Dashboard de Lider Beneficio de Transporte//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Lider Beneficio de Transporte Dashboard',
            'description' => 'Puede ver el dashboard de administrador',
            'description_english' => 'You can see the admin dashboard',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Dashboard de Lider de Ruta//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.route_leader.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Lider de Ruta Dashboard',
            'description' => 'Puede ver el dashboard de administrador',
            'description_english' => 'You can see the admin dashboard',
            'app_id' => $app->id
        ]);
        $permission_route_leader[] = $permission->id; // Almacenar permiso para rol


        // Dashboard de Asistente de Alimentacion//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.feeding_assistant.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Asistente de Alimentacion Dashboard',
            'description' => 'Puede ver el dashboard de administrador',
            'description_english' => 'You can see the admin dashboard',
            'app_id' => $app->id
        ]);
        $permission_feeding_assistant[] = $permission->id; // Almacenar permiso para rol


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
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.crud.typeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'CRUD Tipo de Beneficiarios',
            'description' => 'Puede ver la vista del CRUD de tipos de beneficiario',
            'description_english' => 'You can see the CRUD view of types of beneficiaries',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Crud Tipo de Beneficiarios (LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.crud.typeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'CRUD Tipo de Beneficiarios',
            'description' => 'Puede ver la vista del CRUD de tipos de beneficiario',
            'description_english' => 'You can see the CRUD view of types of beneficiaries',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Vista Crud Tipo de Beneficiarios (LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.crud.typeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'CRUD Tipo de Beneficiarios',
            'description' => 'Puede ver la vista del CRUD de tipos de beneficiario',
            'description_english' => 'You can see the CRUD view of types of beneficiaries',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Guardar Tipo de Beneficiarios(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.save.typeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'Guardar Beneficios',
            'description' => 'Puede guardar los Tipos de beneficiariosos',
            'description_english' => 'You can save the benefits',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Guardar Tipo de Beneficiarios(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.save.typeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'Guardar Beneficios',
            'description' => 'Puede guardar los Tipos de beneficiariosos',
            'description_english' => 'You can save the benefits',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Guardar Tipo de Beneficiarios(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.save.typeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'Guardar Beneficios',
            'description' => 'Puede guardar los Tipos de beneficiariosos',
            'description_english' => 'You can save the benefits',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Editar Tipo de Beneficiarios(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.edit.typeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'Guardar Tipos de Beneficiarios',
            'description' => 'Puede editar los Tipos de beneficiariosos',
            'description_english' => 'You can edit the Beneficiary Types',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Editar Tipo de Beneficiarios(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.edit.typeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'Editar Tipos de beneficiarios',
            'description' => 'Puede Editar los Tipos de beneficiarios',
            'description_english' => 'You can edit the Beneficiary Types',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Editar Tipo de Beneficiarios(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.edit.typeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'Editar Tipos de Beneficiarios',
            'description' => 'Puede Editar los Tipos de beneficiarios',
            'description_english' => 'You can edit the Beneficiary Types',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Tipo de Beneficiarios(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.delete.typeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Beneficios',
            'description' => 'Puede eliminar los benefios',
            'description_english' => 'You can eliminate the benefits',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Tipo de Beneficiarios(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.delete.typeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Beneficios',
            'description' => 'Puede eliminar los benefios',
            'description_english' => 'You can eliminate the benefits',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Tipo de Beneficiarios(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.delete.typeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Beneficios',
            'description' => 'Puede eliminar los benefios',
            'description_english' => 'You can eliminate the benefits',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rols

        // Botones de la vista CRUD Tipo de Beneficiarios (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.buttons.typeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD Beneficios',
            'description' => 'Restricción a los botones de los tipos de beneficiarios',
            'description_english' => 'Restriction to the buttons of the types of beneficiaries',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Botones de la vista CRUD Tipo de Beneficiarios (LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.buttons.typeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD Beneficios',
            'description' => 'Restricción a los botones de los tipos de beneficiarios',
            'description_english' => 'Restriction to the buttons of the types of beneficiaries',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Botones de la vista CRUD Tipo de Beneficiarios (LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.buttons.typeofbenefits'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD Beneficios',
            'description' => 'Restricción a los botones de los tipos de beneficiarios',
            'description_english' => 'Restriction to the buttons of the types of beneficiaries',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        //*-----Permisos Buses-----*//
        // Vista Crud Buses (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.transportation.crud.buses'], [ // Registro o actualización de permiso
            'name' => 'CRUD de Buses',
            'description' => 'Puede ver la vista del CRUD de buses',
            'description_english' => 'You can see the CRUD view of buses',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Crud Buses (LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.transportation.crud.buses'], [ // Registro o actualización de permiso
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

        // Ruta Obtener Estado Check(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.update-benefits.postulation-management'], [ // Registro o actualización de permiso
            'name' => 'Visusalizacion de la tabla de gestion de Postulaciones',
            'description' => 'Puede ver la tabla de gestion de postulaciones',
            'description_english' => 'You can view the application management table',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Obtener Estado Check(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.update-benefits.postulation-management'], [ // Registro o actualización de permiso
            'name' => 'Visusalizacion de la tabla de gestion de Postulaciones',
            'description' => 'Puede ver la tabla de gestion de postulaciones',
            'description_english' => 'You can view the application management table',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Obtener Estado Check(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.update-benefits.postulation-management'], [ // Registro o actualización de permiso
            'name' => 'Visusalizacion de la tabla de gestion de Postulaciones',
            'description' => 'Puede ver la tabla de gestion de postulaciones',
            'description_english' => 'You can view the application management table',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rols



        //*-----Permisos Postulations Management-----*//

        // Vista  Postulations Management(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.update-state-benefit.postulation-management'], [ // Registro o actualización de permiso
            'name' => 'Formualrio para actualizar beneficios a postulaciones',
            'description' => 'Puede ver la vista de gestion de postulaciones',
            'description_english' => 'You can edit the benefits to the beneficiary applications.',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol


        // Vista  Postulations Management(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.update-state-benefit.postulation-management'], [ // Registro o actualización de permiso
            'name' => 'Formualrio para actualizar beneficios a postulaciones',
            'description' => 'Puede editar los beneficios a las postulaciones beneficiarias',
            'description_english' => 'You can edit the benefits to the beneficiary applications.',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol


        // Vista  Postulations Management(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.update-state-benefit.postulation-management'], [ // Registro o actualización de permiso
            'name' => 'Formualrio para actualizar beneficios a postulaciones',
            'description' => 'Puede ver la vista de gestion de postulaciones',
            'description_english' => 'You can edit the benefits to the beneficiary applications.',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista  Postulations Management(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.remove-benefit.postulation-management'], [ // Registro o actualización de permiso
            'name' => 'Desasignar o quitar beneficio a una postulacion',
            'description' => 'Puede Quitar beneficio a la postulacion que este viendo detalles',
            'description_english' => 'You can remove benefit from the application you are viewing details',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista  Postulations Management(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.remove-benefit.postulation-management'], [ // Registro o actualización de permiso
            'name' => 'Desasignar o quitar beneficio a una postulacion',
            'description' => 'Puede Quitar beneficio a la postulacion que este viendo detalles',
            'description_english' => 'You can remove benefit from the application you are viewing details',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista  Postulations Management(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.remove-benefit.postulation-management'], [ // Registro o actualización de permiso
            'name' => 'Desasignar o quitar beneficio a una postulacion',
            'description' => 'Puede Quitar beneficio a la postulacion que este viendo detalles',
            'description_english' => 'You can remove benefit from the application you are viewing details',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol



        // Vista  Postulations Management(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.view.postulation-management'], [ // Registro o actualización de permiso
            'name' => 'CRUD vista gestion de postulaciones',
            'description' => 'Puede ver la vista de gestion de postulaciones',
            'description_english' => 'You can edit the benefits to the beneficiary applications.',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista  Postulations Management(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.edit-benefit-detail.postulation-management'], [ // Registro o actualización de permiso
            'name' => 'Permite la gestion de mensajes a No Beneficiarios',
            'description' => 'Puede ver establecer mensaje a los No Beneficiarios',
            'description_english' => 'You can edit the benefits to the beneficiary applications.',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista  Postulations Management(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.view.postulation-management'], [ // Registro o actualización de permiso
            'name' => 'CRUD vista gestion de postulaciones',
            'description' => 'Puede ver la vista de gestion de postulaciones',
            'description_english' => 'You can view the postulations management view',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Vista  Postulations Management(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.view.postulation-management'], [ // Registro o actualización de permiso
            'name' => 'CRUD vista gestion de postulaciones',
            'description' => 'Puede ver la vista de gestion de postulaciones',
            'description_english' => 'You can view the postulations management view',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Vista Modal Postulacion (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.show.postulation-management'], [ // Registro o actualización de permiso
            'name' => 'Modal de detalles de Postulacion',
            'description' => 'Puede ver el modal de detalles de Postulacion',
            'description_english' => 'You can view the postulations Details Modal',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Crud Rutas de Trasporte (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.update-score.postulation-management'], [ // Registro o actualización de permiso
            'name' => 'Actualizacion de puntaje total de Postulacion',
            'description' => 'Puede Actualizar el puntaje total de una Postulacion',
            'description_english' => 'You can update the total score of an postulation.',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol


        //*-----Permisos Transport Routes-----*//

        // Vista Crud Rutas de Trasporte (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.transportation.crud.transportroutes'], [ // Registro o actualización de permiso
            'name' => 'CRUD Rutas de Trasporte',
            'description' => 'Puede ver la vista del CRUD de rutas de transporte',
            'description_english' => 'You can see the CRUD view of transportation routes',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Crud Rutas de Trasporte(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.transportation.crud.transportroutes'], [ // Registro o actualización de permiso
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
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.buttons.transportroutes'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD Rutas de Trasporte',
            'description' => 'Restricion a los botones de las rutas de trasporte',
            'description_english' => 'RRestrictions on transportation route buttons',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol


        //*-----Permisos Drivers-----*//

        // Vista Crud Conductores (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.transportation.crud.drivers'], [ // Registro o actualización de permiso
            'name' => 'CRUD Conductores',
            'description' => 'Puede ver la vista del CRUD de Conductores',
            'description_english' => 'You can see the CRUD view of transportation routes',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Crud Conductores(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.transportation.crud.drivers'], [ // Registro o actualización de permiso
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
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.convocations.crud.convocations'], [ // Registro o actualización de permiso
            'name' => 'CRUD Convocations',
            'description' => 'Puede ver la vista del CRUD de convocatorias',
            'description_english' => 'You can see the CRUD view of benefits',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Crud Convocations (LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.convocations.crud.convocations'], [ // Registro o actualización de permiso
            'name' => 'CRUD Convocations',
            'description' => 'Puede ver la vista del CRUD de convocatorias',
            'description_english' => 'You can see the CRUD view of benefits',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Vista Crud Convocations (LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.convocations.crud.convocations'], [ // Registro o actualización de permiso
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
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.convocations.crud.editform'], [ // Registro o actualización de permiso
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

        
        // Ruta Eliminar Preunta de la convocatoria(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.delete_question_call.editform'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Preunta de la Convocatoria',
            'description' => 'Puede eliminar las preguntas que estan relacionadas con la convocatoria',
            'description_english' => 'You can save the questions and answers of the forms',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Eliminar Preunta de la convocatoria(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.delete_question_call.editform'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Preunta de la Convocatoria',
            'description' => 'Puede eliminar las preguntas que estan relacionadas con la convocatoria',
            'description_english' => 'You can save the questions and answers of the forms',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Eliminar Preunta de la convocatoria(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.delete_question_call.editform'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Preunta de la Convocatoria',
            'description' => 'Puede eliminar las preguntas que estan relacionadas con la convocatoria',
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

        // Ruta Fromulario Agregar Respuestas a una pregunta de los Formularios(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.add.answer.editform'], [ // Registro o actualización de permiso
            'name' => 'Agregar Respuestas a la pregunta',
            'description' => 'Puede agregar respuestas a las preguntas de los formularios',
            'description_english' => 'You can add answers to form questions',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Agregar Respuestas a una pregunta de los Formularios(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.add.answer.editform'], [ // Registro o actualización de permiso
            'name' => 'Agregar Respuestas a la pregunta',
            'description' => 'Puede agregar respuestas a las preguntas de los formularios',
            'description_english' => 'You can add answers to form questions',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Agregar Respuestas a una pregunta de los Formularios(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.add.answer.editform'], [ // Registro o actualización de permiso
            'name' => 'Agregar Respuestas a la pregunta',
            'description' => 'Puede agregar respuestas a las preguntas de los formularios',
            'description_english' => 'You can add answers to form questions',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Preguntas y Respuestas de los Formularios(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.delete.question.editform'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Preguntas y Respuestas',
            'description' => 'Puede eliminar las preguntas y respuestas de los formularios',
            'description_english' => 'You can remove questions and answers from the forms',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Preguntas y Respuestas de los Formularios(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.delete.question.editform'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Preguntas y Respuestas',
            'description' => 'Puede eliminar las preguntas y respuestas de los formularios',
            'description_english' => 'You can remove questions and answers from the forms',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Preguntas y Respuestas de los Formularios(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.delete.question.editform'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Preguntas y Respuestas',
            'description' => 'Puede eliminar las preguntas y respuestas de los formularios',
            'description_english' => 'You can remove questions and answers from the forms',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rols

        // Ruta Fromulario Eliminar Respuestas de la pregunta(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.delete.answer.editform'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Preguntas y Respuestas',
            'description' => 'Puede eliminar las preguntas y respuestas de los formularios',
            'description_english' => 'You can delete the answers to the questions',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Respuestas de la pregunta(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.delete.answer.editform'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Preguntas y Respuestas',
            'description' => 'Puede eliminar las preguntas y respuestas de los formularios',
            'description_english' => 'You can delete the answers to the questions',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Eliminar Respuestas de la pregunta(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.delete.answer.editform'], [ // Registro o actualización de permiso
            'name' => 'Eliminar Preguntas y Respuestas',
            'description' => 'Puede eliminar las respuestas de las preguntas',
            'description_english' => 'You can delete the answers to the questions',
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
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.buttons.editform'], [ // Registro o actualización de permiso
            'name' => 'Botones Del CRUD de los Formularios',
            'description' => 'Restricion a los botones del formularios',
            'description_english' => 'Restriction on form buttons',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Consulta para consultar la pregunta y la convocatoria (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.convocations.marked_questions.editform'], [ // Registro o actualización de permiso
            'name' => 'Marcar Preguntas en el Formulario',
            'description' => 'Consultar las preguntas relacionadas con la convocatoria y marcarlas en la vista',
            'description_english' => 'Consult the questions related to the call and mark them in the view',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Consulta para consultar la pregunta y la convocatoria (LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.convocations.marked_questions.editform'], [ // Registro o actualización de permiso
            'name' => 'Marcar Preguntas en el Formulario',
            'description' => 'Consultar las preguntas relacionadas con la convocatoria y marcarlas en la vista',
            'description_english' => 'Consult the questions related to the call and mark them in the view',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Consulta para consultar la pregunta y la convocatoria (LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.convocations.marked_questions.editform'], [ // Registro o actualización de permiso
            'name' => 'Marcar Preguntas en el Formulario',
            'description' => 'Consultar las preguntas relacionadas con la convocatoria y marcarlas en la vista',
            'description_english' => 'Consult the questions related to the call and mark them in the view',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        //*-----Permisos listados apoyo alimentacion-----*//
        // Vista Listados Beneficiarios Alimentacion(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.food.crud.beneficiaries_food'], [ // Registro o actualización de permiso
            'name' => 'Vista de Beneficiarios Alimentacion',
            'description' => 'Puede ver la vista con el listado de los beneficiarios del apoyo de alimentacion',
            'description_english' => 'You can see the view with the list of the beneficiaries of the food support.',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Listados Beneficiarios Alimentacion(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.food.crud.beneficiaries_food'], [ // Registro o actualización de permiso
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

        //*-----Permisos Tomar Asistencia Transporte-----*//
        // Vista Tomar Asistencia Transporte(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.transportation.view.asistance_transport'], [ // Registro o actualización de permiso
            'name' => 'Vista de Asistencia Transporte',
            'description' => 'Puede ver la vista de tomar asistencia de transporte',
            'description_english' => 'You can see the view of taking transportation assistance',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Tomar Asistencia Transporte(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.transportation.view.asistance_transport'], [ // Registro o actualización de permiso
            'name' => 'Vista de Asistencia Transporte',
            'description' => 'Puede ver la vista de tomar asistencia de transporte',
            'description_english' => 'You can see the view of taking transportation assistance',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Vista Tomar Asistencia Transporte(LIDER RUTA TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.route_leader.view.asistance_transport'], [ // Registro o actualización de permiso
            'name' => 'Vista de Asistencia Transporte',
            'description' => 'Puede ver la vista de tomar asistencia de transporte',
            'description_english' => 'You can see the view of taking transportation assistance',
            'app_id' => $app->id
        ]);
        $permission_route_leader[] = $permission->id; // Almacenar permiso para rol

        // Formulario Tomar Asistencia Transporte(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.form.asistance_transport'], [ // Registro o actualización de permiso
            'name' => 'Vista de Asistencia Transporte',
            'description' => 'Restricion a el formularios de tomar asistencia',
            'description_english' => 'Restriction on taking attendance forms',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario Tomar Asistencia Transporte(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.form.asistance_transport'], [ // Registro o actualización de permiso
            'name' => 'Vista de Asistencia Transporte',
            'description' => 'Restricion a el formularios de tomar asistencia',
            'description_english' => 'Restriction on taking attendance forms',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Formulario Tomar Asistencia Transporte(LIDER RUTA TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.route_leader.form.asistance_transport'], [ // Registro o actualización de permiso
            'name' => 'Vista de Asistencia Transporte',
            'description' => 'Restricion a el formularios de tomar asistencia',
            'description_english' => 'Restriction on taking attendance forms',
            'app_id' => $app->id
        ]);
        $permission_route_leader[] = $permission->id; // Almacenar permiso para rol

        //*-----Permisos Tomar Asistencia Alimentacion-----*//
        // Vista Tomar Asistencia Alimentacion(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.food.view.food_assistance'], [ // Registro o actualización de permiso
            'name' => 'Vista de Asistencia Alimentacion',
            'description' => 'Puede ver la vista de tomar asistencia de alimentacion',
            'description_english' => 'You can see the view of taking feeding assistance',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Tomar Asistencia Alimentacion(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.food.view.food_assistance'], [ // Registro o actualización de permiso
            'name' => 'Vista de Asistencia Alimentacion',
            'description' => 'Puede ver la vista de tomar asistencia de alimentacion',
            'description_english' => 'You can see the view of taking feeding assistance',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Vista Tomar Asistencia Alimentacion(LIDER ASISTENCIA ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.view.food_assistance'], [ // Registro o actualización de permiso
            'name' => 'Vista de Asistencia Alimentacion',
            'description' => 'Puede ver la vista de tomar asistencia de alimentacion',
            'description_english' => 'You can see the view of taking feeding assistance',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Formulario Tomar Asistencia Alimentacion(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.form.food_assistance'], [ // Registro o actualización de permiso
            'name' => 'Vista de Asistencia Alimentacion',
            'description' => 'Restricion a el formularios de tomar asistencia',
            'description_english' => 'Restriction on taking attendance forms',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario Tomar Asistencia Alimentacion(LIDER ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.form.food_assistance'], [ // Registro o actualización de permiso
            'name' => 'Vista de Asistencia Alimentacion',
            'description' => 'Restricion a el formularios de tomar asistencia',
            'description_english' => 'Restriction on taking attendance forms',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol



        //*-----Permisos Formulario Para Asignar Ruta Transporte-----*//
        // Vista Formualrio para Asignar Ruta Transporte(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.transportation.view.assing_form_transportation_routes'], [ // Registro o actualización de permiso
            'name' => 'Vista de Asignar formulario Ruta Transporte',
            'description' => 'Puede ver la vista para formulario de asignar ruta de transporte',
            'description_english' => 'You can see the form view of assigning a shipment routing',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Formualrio para Asignar Ruta Transporte(LIDER RUTA TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.transportation.view.assing_form_transportation_routes'], [ // Registro o actualización de permiso
            'name' => 'Vista de Asignar formulario Ruta Transporte',
            'description' => 'Puede ver la vista para formulario de asignar ruta de transporte',
            'description_english' => 'You can see the form view of assigning a shipment routing',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Vista Para Ver Registros Dinamicos(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.checkExistingRoute.assing_form_transportation_routes'], [ // Registro o actualización de permiso
            'name' => 'Vista de Asignar formulario Ruta Transporte',
            'description' => 'Puede ver la vista para formulario de asignar ruta de transporte',
            'description_english' => 'You can see the form view of assigning a shipment routing',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Para Ver Registros Dinamicos(LIDER RUTA TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.checkExistingRoute.assing_form_transportation_routes'], [ // Registro o actualización de permiso
            'name' => 'Vista de Asignar formulario Ruta Transporte',
            'description' => 'Puede ver la vista para formulario de asignar ruta de transporte',
            'description_english' => 'You can see the form view of assigning a shipment routing',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Formualrio para Asignar Ruta Transporte(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.updateInline.assing_form_transportation_routes'], [ // Registro o actualización de permiso
            'name' => 'Formulario Para Asignar Rutas de Transporte',
            'description' => 'Puede Realizar cambios en los registros usando el formulario',
            'description_english' => 'You can make changes to records using the form',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Formualrio para Asignar Ruta Transporte(LIDER RUTA TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.updateInline.assing_form_transportation_routes'], [ // Registro o actualización de permiso
            'name' => 'Formulario Para Asignar Rutas de Transporte',
            'description' => 'Puede Realizar cambios en los registros usando el formulario',
            'description_english' => 'You can make changes to records using the form',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol


        //*-----Permisos Asignar Ruta Transporte-----*//
        // Vista Asignar Ruta Transporte(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.transportation.view.assign_transport_route'], [ // Registro o actualización de permiso
            'name' => 'Vista de Asignar Ruta Transporte',
            'description' => 'Puede ver la vista para asignar ruta de transporte',
            'description_english' => 'You can see the view for assigning the route of transport',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol


        //*-----Permisos Listados Asistencia de Alimentacion-----*//
        // Vista Listados Asistencia de Alimentacion(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.food.view.food_assistance_lists'], [ // Registro o actualización de permiso
            'name' => 'Vista de Listados Asistencia de Alimentacion',
            'description' => 'Puede ver la vista del listados asistencia de alimentacion',
            'description_english' => 'You can see the list view of feeding assistance',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Listados Asistencia de Alimentacion(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.food.view.food_assistance_lists'], [ // Registro o actualización de permiso
            'name' => 'Vista de Listados Asistencia de Alimentacion',
            'description' => 'Puede ver la vista del listados asistencia de alimentacion',
            'description_english' => 'You can see the list view of feeding assistance',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        // Formulario Filtrar por Porcentajes(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.route.food_assistance_lists.filter'], [ // Registro o actualización de permiso
            'name' => 'Vista de Asistencia Alimentacion',
            'description' => 'Restricion a el formularios de tomar asistencia',
            'description_english' => 'Restriction on taking attendance forms',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario Filtrar por Porcentajes(LIDER BENEFICIO DE ALIMENTACION)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.food_benefits_leaders.route.food_assistance_lists.filter'], [ // Registro o actualización de permiso
            'name' => 'Ruta Filtrar por porcentajes',
            'description' => 'Restricion a el formularios de tomar asistencia',
            'description_english' => 'Restriction on taking attendance forms',
            'app_id' => $app->id
        ]);
        $permission_food_benefits_leaders[] = $permission->id; // Almacenar permiso para rol

        //*-----Permisos Listados Asistencia de Transporte-----*//
        // Vista Listados Asistencia de Transporte(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.transportation.view.transportation_assistance_lists'], [ // Registro o actualización de permiso
            'name' => 'Vista de Listados Asistencia de Transporte',
            'description' => 'Puede ver la vista del listados asistencia de transporte',
            'description_english' => 'You can see the list view of transportation assistance',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Listados Asistencia de Transporte(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.transportation.view.transportation_assistance_lists'], [ // Registro o actualización de permiso
            'name' => 'Vista de Listados Asistencia de Transporte',
            'description' => 'Puede ver la vista del listados asistencia de transporte',
            'description_english' => 'You can see the list view of transportation assistance',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Consultar Listados Asistencia de Transporte(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.view.transportation_assistance_lists.consult'], [ // Registro o actualización de permiso
            'name' => 'Colsultar Listados Asistencia de Transporte',
            'description' => 'Puede consultar los listados asistencia de transporte',
            'description_english' => 'You can consult the transport assistance lists',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Consultar Listados Asistencia de Transporte(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.view.transportation_assistance_lists.consult'], [ // Registro o actualización de permiso
            'name' => 'Colsultar Listados Asistencia de Transporte',
            'description' => 'Puede consultar los listados asistencia de transporte',
            'description_english' => 'You can consult the transport assistance lists',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Generar las Fallas de Asistencia de Transporte(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.attendance_report.transportation_assistance_lists.consult'], [ // Registro o actualización de permiso
            'name' => 'Generar Reporte de Falla Asistencia de Transporte',
            'description' => 'Puede generar las fallas de asistencia de transporte a los aprendices despues de la hora',
            'description_english' => 'May generate failures to provide transportation assistance to trainees after hours.',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Generar las Fallas de Asistencia de Transporte(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.attendance_report.transportation_assistance_lists.consult'], [ // Registro o actualización de permiso
            'name' => 'Generar Falla Asistencia de Transporte',
            'description' => 'Puede generar las fallas de asistencia de transporte a los aprendices despues de la hora',
            'description_english' => 'May generate failures to provide transportation assistance to trainees after hours.',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Generar Reporte de Fallas de Asistencia de Transporte(ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.admin.failure_reporting.transportation_assistance_lists.consult'], [ // Registro o actualización de permiso
            'name' => 'Generar Reporte de Falla Asistencia de Transporte',
            'description' => 'Puede enviar los listados de fallas de asistencia de transporte',
            'description_english' => 'You can send the lists of transport assistance failures to',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Generar Reporte de Fallas de Asistencia de Transporte(LIDER BENEFICIO DE TRANSPORTE)//
        $permission = Permission::updateOrCreate(['slug' => 'bienestar.transportation_benefits_leader.failure_reporting.transportation_assistance_lists.consult'], [ // Registro o actualización de permiso
            'name' => 'Generar Reporte de Falla Asistencia de Transporte',
            'description' => 'Puede enviar los listados de fallas de asistencia de transporte',
            'description_english' => 'You can send the lists of transport assistance failures to',
            'app_id' => $app->id
        ]);
        $permission_transportation_benefits_leader[] = $permission->id; // Almacenar permiso para rol

        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'bienestar.admin')->first(); // Rol Administrador
        $rol_transportation_benefits_leader = Role::where('slug', 'bienestar.transportation_benefits_leader')->first(); // Rol Lider Beneficio Transporte
        $rol_food_benefits_leader = Role::where('slug', 'bienestar.food_benefits_leader')->first(); // Rol Lider Beneficio Alimentacion
        $rol_feeding_assistant = Role::where('slug', 'bienestar.feeding_assistant')->first(); // Rol Registro Asistencia Alimentacion
        $rol_route_leader = Role::where('slug', 'bienestar.route_leader')->first(); // Rol Registro Asistencia Ruta

        // Asignación de PERMISOS para los ROLES de la aplicación BIENESTAR (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()->syncWithoutDetaching($permission_admin);
        $rol_transportation_benefits_leader->permissions()->syncWithoutDetaching($permission_transportation_benefits_leader);
        $rol_food_benefits_leader->permissions()->syncWithoutDetaching($permission_food_benefits_leaders);
        $rol_feeding_assistant->permissions()->syncWithoutDetaching($permission_feeding_assistant);
        $rol_route_leader->permissions()->syncWithoutDetaching($permission_route_leader);
    }
}
