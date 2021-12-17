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
            $person = Person::where('document','7713344')->first();
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
                "description" => "En esta aplicación se administra la confgur-......",
                "description_english" => "English -> En esta aplicación se administra la confgur-......"
            ]);
        }
        //crear usuario administrador
        $useradmin = User::where('nickname','zet612')->first();
        if(!$useradmin){
            $person = Person::where('document','1004225163')->first();
            $useradmin = User::create([
                "nickname" => "zet612",
                "person_id" => $person->id,
                "email" => "jsperdomo361@misena.edu.co",
                "password" => Hash::make("12345678")
            ]);
        }
        //crear usuario coordinador
        $usercoordinador = User::where('nickname','gmsanchez')->first();
        if(!$usercoordinador){
            $person = Person::where('document','87654321')->first();
            $usercoordinador = User::create([
                "nickname" => "gmsanchez",
                "person_id" => $person->id,
                "email" => "gmsanchez@sena.edu.co",
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
        //crear rol administrador
        $rolcoordinador = Role::where('slug','sica.coordinador')->first();
        if(!$rolcoordinador){
            $rolcoordinador = Role::create([
                "name" => "Coordinador Academico",
                "slug" => "sica.coordinador",
                "description" => "Rol administrador de la aplicacion SICA",
                "description_english" => "English - Rol administrador de la aplicacion SICA",
                "full-access" => "yes",
                "app_id" => $app->id
            ]);
        }
        // asigno el rol de admin al usuario superadmin y admin
        $usersuperadmin->roles()->sync([$roladmin->id]);
        $useradmin->roles()->sync([$roladmin->id]);
        $usercoordinador->roles()->sync([$rolcoordinador->id]);
        // lista de permisos para asignar al rol superadmin y admin
        $permission_admin = [];
        $permission_coordinador = [];
// repita para cada permiso -- estos permisos son de su aplicacion, agregue los necesarios
        $permission = Permission::where('slug','sica.app.list')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Listar Aplicaciones",
                "slug" => "sica.app.list",
                "description" => "Puede acceder a lista de aplicaciones",
                "description_english" => "English - Puede acceder a lista de aplicaciones",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;
// -- repita para cada permiso
        $permission = Permission::where('slug','sica.quarter.list')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Listar Trimestres",
                "slug" => "sica.quarter.list",
                "description" => "Puede acceder a lista de trimestres",
                "description_english" => "English - Puede acceder a lista de trimestres",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;
        $permission_coordinador[] = $permission->id;

        // se asignan los permisos a los roles
        $roladmin->permissions()->sync($permission_admin);
        $rolcoordinador->permissions()->sync($permission_coordinador);

    }
}
