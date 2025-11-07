<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\App;
use App\Models\User;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class SeedPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    /* public function run()
    {
        //crear aplicacion
        $app = App::where('name','SENAEMPRESA')->first();
        if(!$app){
            $app = App::create([
                "name" => "SENAEMPRESA",
                "url" => "/senaempresa/index",
                "color" => "#237286",
                "icon" => "fas fa-desktop",
                "description" => "Actividades de senaempresa y relacionado con asistencias",
                "description_english" => "English -> Actividades de senaempresa y relacionado con asistencias"
            ]);
        }

        $rolattendanceTurn = Role::where('slug','sica.attendanceTurn')->first();
        if(!$rolattendanceTurn){
            $rolattendanceTurn = Role::create([
                "name" => "Asistencia Turnos",
                "slug" => "sica.attendanceTurn",
                "description" => "Rol Encargado de las asistencias de turnos",
                "description_english" => "English - Rol Encargado de las asistencias de turnos",
                "full-access" => "no",
                "app_id" => $app->id
            ]);
        }
    }
 */

    public function run()
    {
        //limpiar tablas
        /*
        DB::statement("SET foreign_key_checks=0");
            DB::table('role_user')->truncate();
            DB::table('permission_role')->truncate();
            //App::truncate();
            User::truncate();
            //Role::truncate();
            Permission::truncate();
        DB::statement("SET foreign_key_checks=1");
        */
        //crear usuario Administrador -- no modificar
        $userattendanceadmin = User::where('nickname','DiegoT')->first();
        if(!$userattendanceadmin){

            $person = Person::where('document_number','1004224747')->first();

            $userattendanceadmin = User::create([
                "nickname" => "DiegoT",
                "person_id" => $person->id,
                "email" => "datovar74@misena.edu.co",
                "password" => Hash::make("12345678")
            ]);
        }

        $userattendanceturn = User::where('nickname','DiegoTAttendance')->first();
        if(!$userattendanceturn){

            $person = Person::where('document_number','1004224747')->first();

            $userattendanceturn = User::create([
                "nickname" => "DiegoTAttendance",
                "person_id" => $person->id,
                "email" => "datovar74@soy.sena.edu.co",
                "password" => Hash::make("12345678")
            ]);
        }
        //crear aplicacion
        $app = App::where('name','SENAEMPRESA')->first();
        if(!$app){
            $app = App::create([
                "name" => "SENAEMPRESA",
                "url" => "/senaempresa/index",
                "color" => "#237286",
                "icon" => "fas fa-desktop",
                "description" => "Actividades de senaempresa y relacionado con asistencias",
                "description_english" => "English -> Actividades de senaempresa y relacionado con asistencias"
            ]);
        }


        //crear rol administrador
        $roladmin = Role::where('slug','senaempresa.admin')->first();
        if(!$roladmin){
            $roladmin = Role::create([
                "name" => "Administrador Asistencias",
                "slug" => "senaempresa",
                "description" => "Rol administrador de la aplicacion SENAEMPRESA",
                "description_english" => "English - Rol administrador de la aplicacion SENAEMPRESA",
                "full-access" => "yes",
                "app_id" => $app->id
            ]);
        }
        //crear rol coordinador
        $rolattendance = Role::where('slug','senaempresa.attendance')->first();
        if(!$rolattendance){
            $rolattendance = Role::create([
                "name" => "Coordinador Asistencia",
                "slug" => "senaempresa",
                "description" => "Rol Coordinador Asistencias",
                "description_english" => "English - Rol Coordinador de las asistencias",
                "full-access" => "no",
                "app_id" => $app->id
            ]);
        }
        /**/

        // asigno el rol de admin al usuario superadmin y admin
        $userattendanceadmin->roles()->syncWithoutDetaching([$roladmin->id]);
        $userattendanceturn->roles()->syncWithoutDetaching([$rolattendance->id]);

        // lista de permisos para asignar al rol admin y coordinador
        $permission_admin = [];
        $permission_attendance = [];

// repita para cada permiso -- estos permisos son de su aplicacion, agregue los necesarios
        $permission = Permission::where('slug','senaempresa.index')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Admin main index",
                "slug" => "senaempresa.index",
                "description" => "Puede ver el dashboard de administrador",
                "description_english" => "English - Puede ver el dashboard de administrador",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;
        $permission_attendance[] = $permission->id;

        $permission = Permission::where('slug','senaempresa.turnosRutinarios')->first();
        if(!$permission){
            $permission = Permission::create([
                  "name" => "Lista de aprendices",
                "slug" => "senaempresa.turnosRutinarios",
                "description" => "Puede ver el dashboard de asistencia",
                "description_english" => "English - Puede ver el dashboard de asistencia",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;
        $permission_attendance[] = $permission->id;

        $permission = Permission::where('slug','senaempresa.buscarLista')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Filtrado por programa",
                "slug" => "senaempresa.buscarLista",
                "description" => "Puede gestionar la informacion de las personas",
                "description_english" => "English - Puede gestionar la informacion de las personas",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;
        $permission_attendance[] = $permission->id;

        $permission = Permission::where('slug','senaempresa.adicionarTurno')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Crear un nuevo turno",
                "slug" => "senaempresa.adicionarTurno",
                "description" => "Registro de asistencia a eventos",
                "description_english" => "English - Registro de asistencia a eventos",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;

        $permission = Permission::where('slug','senaempresa.guardarTurno')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Crea el turno",
                "slug" => "senaempresa.guardarTurno",
                "description" => "Permite buscar los datos de una persona por numero de documento para registrar su asistencia",
                "description_english" => "English - Permite buscar los datos de una persona por numero de documento para registrar su asistencia",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;

        $permission = Permission::where('slug','senaempresa.listaTurnos')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Lista todos los turnos",
                "slug" => "senaempresa.listaTurnos",
                "description" => "Permite registrar datos personales basicos y asistencias",
                "description_english" => "English - Permite registrar datos personales basicos y asistencias",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;

        $permission = Permission::where('slug','senaempresa.attendance.turnDelete')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Eliminar el turno rutinario",
                "slug" => "senaempresa.attendance.turnDelete",
                "description" => "Registro de asistencia a eventos",
                "description_english" => "English - Registro de asistencia a eventos",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;


        $permission = Permission::where('slug','senaempresa.updateAttendance')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Marcar la asistencia del aprendiz",
                "slug" => "senaempresa.updateAttendance",
                "description" => "Permite buscar los datos de una persona por numero de documento para registrar su asistencia",
                "description_english" => "English - Permite buscar los datos de una persona por numero de documento para registrar su asistencia",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;
        $permission_attendance[] = $permission->id;

        $permission = Permission::where('slug','senaempresa.workAsign')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Asignar actividad por unidad",
                "slug" => "senaempresa.workAsign",
                "description" => "Permite registrar datos personales basicos y asistencias",
                "description_english" => "English - Permite registrar datos personales basicos y asistencias",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;
        $permission_attendance[] = $permission->id;


        $permission = Permission::where('slug','sica.admin.people.apprentices')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Busqueda de aprendices",
                "slug" => "sica.admin.people.apprentices",
                "description" => "Puede acceder a lista de aprendices por titulación",
                "description_english" => "English - Puede acceder a lista de aprendices por titulación",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;
        $permission_attendance[] = $permission->id;

        $permission = Permission::where('slug','senaempresa.fingerPrint.home')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Home del finger print",
                "slug" => "senaempresa.fingerPrint.home",
                "description" => "Puede acceder a lista de instructores",
                "description_english" => "English - Puede acceder a lista de instructores",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;


        $permission = Permission::where('slug','senaempresa.fingerPrint.import')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Importar archivo excel de turnos fingerprint",
                "slug" => "senaempresa.fingerPrint.import",
                "description" => "Puede acceder a lista de funcionarios",
                "description_english" => "English - Puede acceder a lista de funcionarios",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;


        $permission = Permission::where('slug','senaempresa.work.index')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Lista de tareas",
                "slug" => "senaempresa.work.index",
                "description" => "Puede acceder a lista de funcionarios",
                "description_english" => "English - Puede acceder a lista de contratistas",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;



        $permission = Permission::where('slug','senaempresa.works.edit')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Editar works",
                "slug" => "senaempresa.works.edit",
                "description" => "Puede acceder a lista de trimestres academicos",
                "description_english" => "English - Puede acceder a lista de trimestres academicos",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;


        $permission = Permission::where('slug','senaempresa.works.destroy')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Eliminar tarea",
                "slug" => "senaempresa.works.destroy",
                "description" => "Puede acceder a lista de Programas de formacion",
                "description_english" => "English - Puede acceder a lista de Programas de formacion",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;


        $permission = Permission::where('slug','senaempresa.work.create')->first();
        if(!$permission){
            $permission = Permission::create([

                "name" => "Crear tareas",
                "slug" => "senaempresa.work.create",
                "description" => "Puede acceder a lista de Titulaciones",
                "description_english" => "English - Puede acceder a lista de Titulaciones",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;

        $permission = Permission::where('slug','senaempresa.work.store')->first();
        if(!$permission){
            $permission = Permission::create([

                "name" => "Guardar tareas",
                "slug" => "senaempresa.work.store",
                "description" => "Puede acceder a lista de Titulaciones",
                "description_english" => "English - Puede acceder a lista de Titulaciones",
                "app_id" => $app->id
            ]);
        }
        /**/

        // se asignan los permisos a los roles
        $roladmin->permissions()-> syncWithoutDetaching($permission_admin);
        $rolattendance->permissions()->syncWithoutDetaching($permission_attendance);

    }
}
