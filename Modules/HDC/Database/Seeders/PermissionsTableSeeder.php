<?php

namespace Modules\HDC\Database\Seeders;

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
        $permissions_admin = []; // Permisos para Administrador
        $permissions_charge = []; // Permisos para el Encargado
        $permissions_userHDC = []; // Permisos para Calcula tu huella


        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name', 'HDC')->firstOrFail();

        // ===================== Registro de todos los permisos de la aplicación SIGAC ==================
        // PANEL DE CONTROL DEL ADMINISTRADOR (Aministrador)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.index'], [ // Registro o actualización de permiso
            'name' => 'Panel de control del administrador(Administrador)',
            'description' => 'Panel de control del administrador de HDC',
            'description_english' => "HDC Administrator Control Panel",
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        //Vista donde se almacenan los datos del registro de consumo (ADMINISTRADOR)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.table'], [ // Registro o actualización de permiso
            'name' => 'Registro de Consumo(Administrador)',
            'description' => 'Registro de consumo de los aspectos ambientales generados en el centro de formación',
            'description_english' => "HDC Administrator Control Panel",
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta Formulario Agregar valor del aspecto ambiental (ADMINISTRADOR)//
        $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.formulario'], [ // Registro o actualización de permiso
            'name' => 'Formulario registro aspectos ambientales',
            'description' => 'Puede acceder a formulario registro de aspectos ambientales',
            'description_english' => 'You can access the environmental aspects register form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta del formulario agregar ajax que llama a las actividades relacionadas con la unidad productiva (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.activities'], [ // Registro o actualización de permiso
            'name' => 'Consultar actividades (Administrador)',
            'description' => 'Consultar actividades a las que pertenecen a una unidad productiva',
            'description_english' => 'Consult activities that belong to a productive unit',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta del formulario agregar ajax que llama a los aspectos ambientales relacionadas con la actividad (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.aspects'], [ // Registro o actualización de permiso
            'name' => 'Consultar los aspectos ambientales (Administrador)',
            'description' => 'Consultar los aspectos ambientales que generan una actividad',
            'description_english' => 'Consult the environmental aspects that generate an activity',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

       // Boton guardar del formulario agregar (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.guardar.valores'], [ // Registro o actualización de permiso
            'name' => 'Guardar los aspectos ambientales (Administrador)',
            'description' => 'Guardar registros de los aspectos ambientales',
            'description_english' => 'keeping records of environmental aspects',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta del CRUD eliminar registros de aspectos ambientales (ADMINISTRADOR)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.delete'], [ // Registro o actualización de permiso
            'name' => 'Eliminar los registros aspectos ambientales (Administrador)',
            'description' => 'Eliminar los registros de los aspectos ambientales',
            'description_english' => 'Delete records of environmental aspects',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta del CRUD editar registros de aspectos ambientales (ADMINISTRADOR)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.edit'], [ // Registro o actualización de permiso
            'name' => 'Editar los registros aspectos ambientales (Administrador)',
            'description' => 'Editar los registros de los aspectos ambientales',
            'description_english' => 'Edit records of environmental aspects',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol


        // Ruta del CRUD Actualizar registros de aspectos ambientales (ADMINISTRADOR)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar los registros aspectos ambientales (Administrador)',
            'description' => 'Actualizar los registros de los aspectos ambientales',
            'description_english' => 'Update records of environmental aspects',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol


        // PANEL DE CONTROL DEL ENCARGADO (Encargado)

        $permission = Permission::updateOrCreate(['slug' => 'hdc.charge.index'], [ // Registro o actualización de permiso
            'name' => 'Panel de control del Encargado (Encargado)',
            'description' => 'Panel de control del encargado',
            'description_english' => "Manager's control panel",
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        //Vista donde se almacenan los datos del registro de consumo (ENCARGADO)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.charge.table'], [ // Registro o actualización de permiso
            'name' => 'Registro de Consumo(Encargado)',
            'description' => 'Registro de consumo de los aspectos ambientales generados en el centro de formación',
            'description_english' => "HDC Consumption register of environmental aspects generated in the training center.",
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        // Ruta Fromulario Agregar valor del aspecto ambiental (ENCARGADO)//
        $permission = Permission::updateOrCreate(['slug' => 'hdc.charge.formulario'], [ // Registro o actualización de permiso
            'name' => 'Formulario registro aspectos ambientales',
            'description' => 'Puede acceder a formulario registro de aspectos ambientales',
            'description_english' => 'You can access the environmental aspects register form',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

         // Ruta del formulario agregar ajax que llama a las actividades relacionadas con la unidad productiva (ENCARGADO)
         $permission = Permission::updateOrCreate(['slug' => 'hdc.charge.activities'], [ // Registro o actualización de permiso
            'name' => 'Consultar actividades (Encargado)',
            'description' => 'Consultar actividades a las que pertenecen a una unidad productiva',
            'description_english' => 'Consult activities that belong to a productive unit',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        // Ruta del formulario agregar ajax que llama a los aspectos ambientales relacionadas con la actividad (ENCARGADO)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.charge.aspects'], [ // Registro o actualización de permiso
            'name' => 'Consultar los aspectos ambientales (Encargado)',
            'description' => 'Consultar los aspectos ambientales que generan una actividad',
            'description_english' => 'Consult the environmental aspects that generate an activity',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

       // Boton guardar del formulario agregar (ENCARGADO)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.charge.guardar.valores'], [ // Registro o actualización de permiso
            'name' => 'Guardar los aspectos ambientales (Encargado)',
            'description' => 'Guardar registros de los aspectos ambientales',
            'description_english' => 'keeping records of environmental aspects',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        // Ruta del CRUD eliminar registros de aspectos ambientales (ENCARGADO)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.charge.delete'], [ // Registro o actualización de permiso
            'name' => 'Eliminar los registros aspectos ambientales (Encargado)',
            'description' => 'Eliminar los registros de los aspectos ambientales',
            'description_english' => 'Delete records of environmental aspects',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        // Ruta del CRUD editar registros de aspectos ambientales (ENCARGADO)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.charge.edit'], [ // Registro o actualización de permiso
            'name' => 'Editar los registros aspectos ambientales (Encargado)',
            'description' => 'Editar los registros de los aspectos ambientales',
            'description_english' => 'Edit records of environmental aspects',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol


        // Ruta del CRUD Actualizar registros de aspectos ambientales (ENCARGADO)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.charge.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar los registros aspectos ambientales (Encargado)',
            'description' => 'Actualizar los registros de los aspectos ambientales',
            'description_english' => 'Update records of environmental aspects',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol


        //PERMISOS DE CALCULA TU HUELLA

        // Ruta de la vista calcula tu huella (ADMINISTRADOR)
         $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.carbonfootprint.persona'], [ // Registro o actualización de permiso
            'name' => 'Vista Calcula tu huella (administrador)',
            'description' => 'Abre la vista de calcula tu huella',
            'description_english' => 'Open the calculate your footprint view',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

         // Boton guardar del formulario agregar de calcula tu huella  (ADMINISTRADOR)
         $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.Carbonfootprint.save_consumption'], [ // Registro o actualización de permiso
            'name' => 'Guardar los aspectos ambientales de calcula tu huella (Administrador)',
            'description' => 'Guardar registros de los aspectos ambientales de calcula tu huella',
            'description_english' => 'keeping records of environmental aspects',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

          // Ruta Fromulario Agregar valor del aspecto ambiental Calcula tu huella (ADMINISTRADOR)//
          $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.Carbonfootprint.form.calculates'], [ // Registro o actualización de permiso
            'name' => 'Formulario registro aspectos ambientales',
            'description' => 'Puede acceder a formulario registro de aspectos ambientales',
            'description_english' => 'You can access the environmental aspects register form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

         // Ruta del CRUD editar registros de aspectos ambientales Calcula tu Huella (ADMINISTRADOR)
         $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.carbonfootprint.edit_consumption'], [ // Registro o actualización de permiso
            'name' => 'Editar los registros aspectos ambientales Calcula tu huella (Encargado)',
            'description' => 'Editar los registros de los aspectos ambientales',
            'description_english' => 'Edit records of environmental aspects',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

         // Ruta del CRUD Actualizar registros de aspectos ambientales Calcula tu huella (ADMINISTRADOR)
         $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.carbonfootprint.update_consumption'], [ // Registro o actualización de permiso
            'name' => 'Actualizar los registros aspectos ambientales Calcula tu huella (Administrador)',
            'description' => 'Actualizar los registros de los aspectos ambientales',
            'description_english' => 'Update records of environmental aspects',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

         // Ruta del CRUD eliminar registros de aspectos ambientales Calcula tu Huella (ADMINISTRADOR)
         $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.carbonfootprint.eliminar'], [ // Registro o actualización de permiso
            'name' => 'Eliminar los registros aspectos ambientales Calcula tu huella (Administrador)',
            'description' => 'Eliminar los registros de los aspectos ambientales',
            'description_english' => 'Delete records of environmental aspects',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol



         // Ruta de la vista calcula tu huella (ENCARGADO)
         $permission = Permission::updateOrCreate(['slug' => 'hdc.charge.carbonfootprint.persona'], [ // Registro o actualización de permiso
            'name' => 'Vista Calcula tu huella (Encargado)',
            'description' => 'Abre la vista de calcula tu huella',
            'description_english' => 'Open the calculate your footprint view',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol
         // Boton guardar del formulario agregar de calcula tu huella (ENCARGADO)
         $permission = Permission::updateOrCreate(['slug' => 'hdc.charge.Carbonfootprint.save_consumption'], [ // Registro o actualización de permiso
            'name' => 'Guardar los aspectos ambientales de calcula tu huella (Encargado)',
            'description' => 'Guardar registros de los aspectos ambientales de calcula tu huella',
            'description_english' => 'keeping records of environmental aspects',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

          // Ruta Fromulario Agregar valor del aspecto ambiental Calcula tu huella (ENCARGADO)//
          $permission = Permission::updateOrCreate(['slug' => 'hdc.charge.Carbonfootprint.form.calculates'], [ // Registro o actualización de permiso
            'name' => 'Formulario registro aspectos ambientales',
            'description' => 'Puede acceder a formulario registro de aspectos ambientales',
            'description_english' => 'You can access the environmental aspects register form',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        // Ruta del CRUD editar registros de aspectos ambientales Calcula tu Huella (ENCARGADO)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.charge.carbonfootprint.edit_consumption'], [ // Registro o actualización de permiso
            'name' => 'Editar los registros aspectos ambientales Calcula tu huella (Encargado)',
            'description' => 'Editar los registros de los aspectos ambientales',
            'description_english' => 'Edit records of environmental aspects',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        // Ruta del CRUD Actualizar registros de aspectos ambientales Calcula tu huella (ENCARGADO)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.charge.carbonfootprint.update_consumption'], [ // Registro o actualización de permiso
            'name' => 'Actualizar los registros aspectos ambientales Calcula tu huella (Encargado)',
            'description' => 'Actualizar los registros de los aspectos ambientales',
            'description_english' => 'Update records of environmental aspects',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

         // Ruta del CRUD eliminar registros de aspectos ambientales Calcula tu Huella (ADMINISTRADOR)
         $permission = Permission::updateOrCreate(['slug' => 'hdc.charge.carbonfootprint.eliminar'], [ // Registro o actualización de permiso
            'name' => 'Eliminar los registros aspectos ambientales Calcula tu huella (Administrador)',
            'description' => 'Eliminar los registros de los aspectos ambientales',
            'description_english' => 'Delete records of environmental aspects',
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol



        //PERMISOS VISTA DE REPORTE HUELLA DE CARBONO

        //Vista del reporte huella de carbono (ADMINISTRADOR)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.generate.report'], [ // Registro o actualización de permiso
            'name' => 'Reporte Huella de Carbono(Administrador)',
            'description' => 'Reporte de huella de carbono con impresion PDF',
            'description_english' => "Carbon footprint report with PDF printout",
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        //Vista del reporte huella de carbono (ENCARGADOR)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.charge.generate.report'], [ // Registro o actualización de permiso
            'name' => 'Reporte Huella de Carbono(Encargado)',
            'description' => 'Reporte de huella de carbono con impresion PDF',
            'description_english' => "Carbon footprint report with PDF printout",
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        //Boton de reporte PDF(ADMINISTRADOR)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.generate.pdf'], [ // Registro o actualización de permiso
            'name' => 'PDF Huella de Carbono(Administrador)',
            'description' => 'Reporte de huella de carbono con impresion PDF',
            'description_english' => "Carbon footprint report with PDF printout",
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

         //Vista tabla del reporte huella de carbono (ADMINISTRADOR)
         $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.report.tables'], [ // Registro o actualización de permiso
            'name' => 'Tabla reporte Huella de Carbono(Administrador)',
            'description' => 'Tabla reporte de huella de carbono con impresion PDF',
            'description_english' => "Carbon footprint report with PDF printout",
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        //Vista tabla del reporte huella de carbono (Encargado)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.charge.report.tables'], [ // Registro o actualización de permiso
            'name' => 'Tabla reporte Huella de Carbono(Encargado)',
            'description' => 'Tabla reporte de huella de carbono con impresion PDF',
            'description_english' => "Carbon footprint report with PDF printout",
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        //Boton de reporte PDF(ENCARGADO)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.charge.generate.pdf'], [ // Registro o actualización de permiso
            'name' => 'PDF Huella de Carbono(Encargado)',
            'description' => 'Reporte de huella de carbono con impresion PDF',
            'description_english' => "Carbon footprint report with PDF printout",
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        //MANUAL DEL INSTRUCTIVO

        //Boton del manual instructivo ENCARGADO
        $permission = Permission::updateOrCreate(['slug' => 'hdc.charge.instruction.manual'], [ // Registro o actualización de permiso
            'name' => 'Manual instructivo(Encargado)',
            'description' => 'Manual instructivo',
            'description_english' => "Instruction manual",
            'app_id' => $app->id
        ]);
        $permissions_charge[] = $permission->id; // Almacenar permiso para rol

        //Boton del manual instructivo ADMINISTRADOR
        $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.instruction.manual'], [ // Registro o actualización de permiso
            'name' => 'Manual instructivo(Encargado)',
            'description' => 'Manual instructivo',
            'description_english' => "Instruction manual",
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        //ASIGNACION ASPECTOS AMBIENTALES
         //Vista tabla del reporte huella de carbono (ADMINISTRADOR)
         $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.resultfromaspects'], [ // Registro o actualización de permiso
            'name' => 'Asignación aspectos ambientales(Administrador)',
            'description' => 'Asignación aspectos ambientales',
            'description_english' => "Assignment of environmental aspects",
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

         // Ruta del CRUD eliminar registros de la asignacion de  aspectos ambientales (ADMINISTRADOR)
         $permission = Permission::updateOrCreate(['slug' => 'hcd.admin.delete_environmental_aspects'], [ // Registro o actualización de permiso
            'name' => 'Eliminar los registros de la asignacion de los aspectos ambientales (Administrador)',
            'description' => 'Eliminar los registros de la asignacion de los aspectos ambientales',
            'description_english' => 'Delete records of the assignment of environmental aspects',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
         // Ruta del formulario agregar ajax que llama a las actividades relacionadas con la unidad productiva (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.getactivities'], [ // Registro o actualización de permiso
            'name' => 'Consultar actividades (Administrador)',
            'description' => 'Consultar actividades a las que pertenecen a una unidad productiva',
            'description_english' => 'Consult activities that belong to a productive unit',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Ruta del boton enviar del formulario asignar aspectos ambientales (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'hdc.admin.updateEnvironmentalAspects'], [ // Registro o actualización de permiso
            'name' => 'Enviar los aspectos ambientales(Administrador)',
            'description' => 'Enviar los aspectos ambientales',
            'description_english' => 'Send environmental aspects',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol






        $rol_admin = Role::where('slug', 'hdc.admin')->first();
        $rol_charge = Role::where('slug', 'hdc.charge')->first();

        $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);
        $rol_admin->permissions()->syncWithoutDetaching($permissions_userHDC);
        $rol_charge->permissions()->syncWithoutDetaching($permissions_charge);
        $rol_charge->permissions()->syncWithoutDetaching($permissions_userHDC);
    }
}
