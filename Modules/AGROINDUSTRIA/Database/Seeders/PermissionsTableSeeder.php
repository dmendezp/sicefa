<?php

namespace Modules\AGROINDUSTRIA\Database\Seeders;

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
        $permission_admin = []; // Permisos para Administrador
        $permission_storer = []; // Permisos para Almacenista
        $permission_instructor = []; // Permisos para Instrucor

        $app = App::where('name','AGROINDUSTRIA')->first();
        
        // Registro de todos los permisos para la aplicacion de AGROINDUSTRIA //
        // Unidades productivas (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units'], [
            'name' => 'Ver unidades productivas',
            'description' => 'Puede ver las unidades productivas (Administrador)',
            'description_english' => 'You can see the productive units',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

         // Dar baja a un producto (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.remove'], [
            'name' => 'Dar baja a un insumo',
            'description' => 'Puede dar de baja a insumos de la bodega de AGROINDUSTRIA',
            'description_english' => 'You can cancel inputs from the AGROINDUSTRIA warehouse',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

         //Ver actividades (Administrador)
         $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.activity'], [
            'name' => 'Ver actividades',
            'description' => 'Puede ver las actividades de cada unidad productiva de agroindustria (Administrador)',
            'description_english' => 'You can see the activities of each productive unit of agroindustrys',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id;

        //Registro de ejecutores, equipos, herramientas, recursos involucrados en la labor
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.labor'], [
           'name' => 'Registrar todo lo relacionado con la labor',
           'description' => 'Puede registrar todos los elementos y personal involucrado en la labor (Administrador)',
           'description_english' => 'You can record all the elements and personnel involved in the work',
           'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        //Formulario para registrar la labor (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.labor.form'], [
            'name' => 'Formulario para registrar la labor',
            'description' => 'Puede abrir el formulario para registrar todos los elementos y personal involucrado en la labor (Administrador)',
            'description_english' => 'You can open the form to register all the elements and personnel involved in the work',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        //Vista de Movimientos (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.movements'], [
            'name' => 'Abrir vista de movimientos',
            'description' => 'Puede ver la vista de movimientos (Administrador)',
            'description_english' => 'You can see the movement view',
            'app_id' => $app->id
        ]);

        $permission_admin[] = $permission->id;  

        //Ver de produccion (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.admin.units.production'], [
            'name' => 'Visualizar produccion',
            'description' => 'Puede ver la produccion de la labor realizada (Administrador)',
            'description_english' => 'You can see the production of the work done',
            'app_id' => $app->id
        ]);
        
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        /* Crear,editar y listar insumos en las bodegas (Administrador/Almacenista) 
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.storer.crud'], [
            'name' => 'Crear, editar y listar insumos',
            'description' => 'Puede crear, editar y listar insumos de la bodega de AGROINDUSTRIA',
            'description_english' => 'You can create, edit and list supplies from the AGROINDUSTRIA warehouse',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol
        $permission_storer[] = $permission->id; // Almacenar permiso para rol*/

        // Unidades productivas (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units'], [
            'name' => 'Ver unidades productivas',
            'description' => 'Puede ver las unidades productivas (Instructor)',
            'description_english' => 'You can see the productive units',
            'app_id' => $app->id
        ]);
        $permission_instructor[] = $permission->id; // Almacenar permiso para rol

        //Solicitud de insumos al almacenistas
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.request'], [
            'name' => 'Solicitar insumos al almacenista',
            'description' => 'Puede solicitar insumos al almacenista',
            'description_english' => 'You can request supplies from the storekeeper',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Registro de ejecutores, equipos, herramientas, recursos involucrados en la labor
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.labor'], [
            'name' => 'Registrar todo lo relacionado con la labor',
            'description' => 'Puede registrar todos los elementos y personal involucrado en la labor (Instructor)',
            'description_english' => 'You can record all the elements and personnel involved in the work',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Formulario para registrar la labor (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.labor.units.form'], [
            'name' => 'Formulario para registrar la labor',
            'description' => 'Puede abrir el formulario para registrar todos los elementos y personal involucrado en la labor (Instructor)',
            'description_english' => 'You can open the form to register all the elements and personnel involved in the work',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id; // Almacenar permiso para rol

        //Ver de produccion (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.production'], [
            'name' => 'Visualizar produccion',
            'description' => 'Puede ver la produccion de la labor realizada (Instructor)',
            'description_english' => 'You can see the production of the work done',
            'app_id' => $app->id
        ]);
        
        $permission_instructor[] = $permission->id; // Almacenar permiso para rol

        //Cambiar estado de solicitud
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.storer.state.request'], [
            'name' => 'Cambiar estado de la solicitud',
            'description' => 'Puede cambiar el estado de la solicitud',
            'description_english' => 'You can change the status of the application',
            'app_id' => $app->id
        ]);

        $permission_storer[] = $permission->id;  

        //Vista de Movimientos (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.movements'], [
            'name' => 'Abrir vista de movimientos',
            'description' => 'Puede ver la vista de movimientos (Instructor)',
            'description_english' => 'You can see the movement view',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;  

        //Crear formulacion
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.formulation'], [
            'name' => 'Crear formula o receta',
            'description' => 'Puede crear formulas o recetas de los productos',
            'description_english' => 'You can create formulas or recipes for the products',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;  

        //Visualizar actividades.
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.activity'], [
            'name' => 'Ver actividades',
            'description' => 'Puede ver las actividades de cada unidad productiva de agroindustria (Instructor)',
            'description_english' => 'You can see the activities of each productive unit of agroindustrys',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Visualizar Movimientos de produccion y/o movimientos de bodegas.
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.deliveries'], [
            'name' => 'Visualizar la vista de Entregas.',
            'description' => 'Puede visualizar y/o registrar movimientos de produccion y/o de bodega.',
            'description_english' => 'You can visualize and/or register production and/or warehouse movements.',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;

        //Visualizar formulario de registro de formulaciones
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.instructor.units.formulations'], [
            'name' => 'Visualizar la vista de formulacion.',
            'description' => 'Puede visualizar el formulario de formulacion y hacer uso de el para crear una formulacion.',
            'description_english' => 'You can display the formulation form and use it to create a formulation.',
            'app_id' => $app->id
        ]);

        $permission_instructor[] = $permission->id;
        
        //Visualizar solicitudes
        $permission = Permission::updateOrCreate(['slug' => 'agroindustria.storer.view.request'], [
            'name' => 'Visualizar solicitudes',
            'description' => 'Puede ver las solicitudes hechas por los instructores',
            'description_english' => 'You can see the requests made by the instructors',
            'app_id' => $app->id
        ]);

        $permission_storer[] = $permission->id;

        $rol_admin = Role::where('slug', 'agroindustria.admin')->first(); // Rol Administrador
        $rol_instructor_vilmer = Role::where('slug', 'agroindustria.instructor.vilmer')->first(); // Rol Coordinado Académico
        $rol_instructor_chocolate = Role::where('slug', 'agroindustria.instructor.chocolate')->first(); // Rol Coordinado Académico
        $rol_storer = Role::where('slug', 'agroindustria.almacenista')->first(); // Rol Registro Asistencia
        $rol_visitor = Role::where('slug', 'agroindustria.visitante')->first(); // Rol Registro Asistencia

        // Asignación de PERMISOS para los ROLES de la aplicación AGROINDUSTRIA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()-> syncWithoutDetaching($permission_admin);
        $rol_instructor_vilmer->permissions()->syncWithoutDetaching($permission_instructor);
        $rol_instructor_chocolate->permissions()->syncWithoutDetaching($permission_instructor);
        $rol_storer->permissions()->syncWithoutDetaching($permission_storer);
    }
}
