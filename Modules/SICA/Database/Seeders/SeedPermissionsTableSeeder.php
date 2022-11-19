<?php

namespace Modules\SICA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SeedPermissionsTableSeeder extends Seeder
{
    public function run()
    {
        //limpiar tablas
        /*
        DB::statement("SET foreign_key_checks=0");
            DB::table('role_user')->truncate();
            DB::table('permission_role')->truncate();
            App::truncate();
            User::truncate();
            Role::truncate();
            Permission::truncate();
        DB::statement("SET foreign_key_checks=1");
        */
        //crear usuario Superadministrador -- no modificar
        $usersuperadmin = User::where('nickname','damendez')->first();
        if(!$usersuperadmin){
            $person = Person::where('document_number','7713344')->first();
            $usersuperadmin = User::create([
                "nickname" => "damendez",
                "person_id" => $person->id,
                "email" => "ing.diego.mendez@gmail.com",
                "password" => Hash::make("12345678")
            ]);            
        }
        //crear aplicacion
        $app = App::where('name','SICA')->first();
        if(!$app){
            $app = App::create([
                "name" => "SICA",
                "url" => "/sica/index",
                "color" => "#ff5e1f",
                "icon" => "fas fa-puzzle-piece",
                "description" => "En esta aplicación se administra la configur-......",
                "description_english" => "English -> En esta aplicación se administra la configur-......"
            ]);
        }
        //crear usuario administrador
        $useradmin = User::where('nickname','zet612')->first();
        if(!$useradmin){
            $person = Person::where('document_number','1004225163')->first();
            $useradmin = User::create([
                "nickname" => "zet612",
                "person_id" => $person->id,
                "email" => "jsperdomo361@misena.edu.co",
                "password" => Hash::make("12345678")
            ]);
        }
        //crear usuario coordinador
        $usercoordinator = User::where('nickname','gmsanchez')->first();
        if(!$usercoordinator){
            $person = Person::where('document_number','51784954')->first();
            $usercoordinator = User::create([
                "nickname" => "gmsanchez",
                "person_id" => $person->id,
                "email" => "gmsanchez@sena.edu.co",
                "password" => Hash::make("12345678")
            ]);
        }
        //crear usuario coordinador
        $userattendance = User::where('nickname','Diego Tovar')->first();
        if(!$userattendance){
            $person = Person::where('document_number','1004224747')->first();
            $userattendance = User::create([
                "nickname" => "Diego Tovar",
                "person_id" => $person->id,
                "email" => "datovar74@misena.edu.co",
                "password" => Hash::make("12345678")
            ]);
        }        
        //crear rol administrador
        $roladmin = Role::where('slug','sica.admin')->first();
        if(!$roladmin){
            $roladmin = Role::create([
                "name" => "Administrador",
                "slug" => "sica.admin",
                "description" => "Rol administrador de la aplicacion SICA",
                "description_english" => "English - Rol administrador de la aplicacion SICA",
                "full-access" => "yes",
                "app_id" => $app->id
            ]);
        }
        //crear rol coordinador
        $rolcoordinator = Role::where('slug','sica.coordinator')->first();
        if(!$rolcoordinator){
            $rolcoordinator = Role::create([
                "name" => "Coordinador Academico",
                "slug" => "sica.coordinator",
                "description" => "Rol Coordinador Academico",
                "description_english" => "English - Rol administrador de la aplicacion SICA",
                "full-access" => "no",
                "app_id" => $app->id
            ]);
        }
        //crear rol asistencia attendance
        $rolattendance = Role::where('slug','sica.attendance')->first();
        if(!$rolattendance){
            $rolattendance = Role::create([
                "name" => "Registro Asistencia",
                "slug" => "sica.attendance",
                "description" => "Rol para el registro de asistencia",
                "description_english" => "English - Rol para el registro de asistencia",
                "full-access" => "no",
                "app_id" => $app->id
            ]);
        }
        // asigno el rol de admin al usuario superadmin y admin
        $usersuperadmin->roles()->syncWithoutDetaching([$roladmin->id]);
        $useradmin->roles()->syncWithoutDetaching([$roladmin->id]);
        $usercoordinator->roles()->syncWithoutDetaching([$rolcoordinator->id]);
        $userattendance->roles()->syncWithoutDetaching([$rolattendance->id]);
        // lista de permisos para asignar al rol superadmin y admin
        $permission_admin = [];
        $permission_coordinator = [];
        $permission_attendance = [];
// repita para cada permiso -- estos permisos son de su aplicacion, agregue los necesarios
        $permission = Permission::where('slug','sica.admin.dashboard')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Admin Dashboard",
                "slug" => "sica.admin.dashboard",
                "description" => "Puede ver el dashboard de administrador",
                "description_english" => "English - Puede ver el dashboard de administrador",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;
        $permission_coordinator[] = $permission->id;

        $permission = Permission::where('slug','sica.attendance.dashboard')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Attendance Dashboard",
                "slug" => "sica.attendance.dashboard",
                "description" => "Puede ver el dashboard de asistencia",
                "description_english" => "English - Puede ver el dashboard de asistencia",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;
        $permission_attendance[] = $permission->id;

        $permission = Permission::where('slug','sica.admin.people.personal_data')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Administrar datos personales",
                "slug" => "sica.admin.people.personal_data",
                "description" => "Puede gestionar la informacion de las personas",
                "description_english" => "English - Puede gestionar la informacion de las personas",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;


        $permission = Permission::where('slug','sica.admin.people.events_attendance')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Asistencia a eventos (admin)",
                "slug" => "sica.admin.people.events_attendance",
                "description" => "Registro de asistencia a eventos",
                "description_english" => "English - Registro de asistencia a eventos",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;

        $permission = Permission::where('slug','sica.attendance.people.events_attendance')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Asistencia a eventos",
                "slug" => "sica.attendance.people.events_attendance",
                "description" => "Registro de asistencia a eventos",
                "description_english" => "English - Registro de asistencia a eventos",
                "app_id" => $app->id
            ]);
        }
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
        $permission_coordinator[] = $permission->id;

        $permission = Permission::where('slug','sica.admin.people.instructors')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Listar Instructores",
                "slug" => "sica.admin.people.instructors",
                "description" => "Puede acceder a lista de instructores",
                "description_english" => "English - Puede acceder a lista de instructores",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;
        $permission_coordinator[] = $permission->id;

        $permission = Permission::where('slug','sica.admin.people.officers')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Listar Funcionarios",
                "slug" => "sica.admin.people.officers",
                "description" => "Puede acceder a lista de funcionarios",
                "description_english" => "English - Puede acceder a lista de funcionarios",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;
        $permission_coordinator[] = $permission->id;

        $permission = Permission::where('slug','sica.admin.people.contractors')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Listar Contratistas",
                "slug" => "sica.admin.people.contractors",
                "description" => "Puede acceder a lista de funcionarios",
                "description_english" => "English - Puede acceder a lista de contratistas",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;
        $permission_coordinator[] = $permission->id;


        $permission = Permission::where('slug','sica.admin.academy.quarters')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Listar Trimestres",
                "slug" => "sica.admin.academy.quarters",
                "description" => "Puede acceder a lista de trimestres academicos",
                "description_english" => "English - Puede acceder a lista de trimestres academicos",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;
        $permission_coordinator[] = $permission->id;

        $permission = Permission::where('slug','sica.admin.academy.curriculums')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Listar Programas",
                "slug" => "sica.admin.academy.curriculums",
                "description" => "Puede acceder a lista de Programas de formacion",
                "description_english" => "English - Puede acceder a lista de Programas de formacion",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;
        $permission_coordinator[] = $permission->id;

        $permission = Permission::where('slug','sica.admin.academy.courses')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Listar Cursos",
                "slug" => "sica.admin.academy.courses",
                "description" => "Puede acceder a lista de Titulaciones",
                "description_english" => "English - Puede acceder a lista de Titulaciones",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;
        $permission_coordinator[] = $permission->id;


        // se asignan los permisos a los roles
        $roladmin->permissions()-> syncWithoutDetaching($permission_admin);
        $rolcoordinator->permissions()->syncWithoutDetaching($permission_coordinator);
        $rolattendance->permissions()->syncWithoutDetaching($permission_attendance);

    }
}
