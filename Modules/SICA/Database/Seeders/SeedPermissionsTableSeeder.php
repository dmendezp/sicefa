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
        DB::statement("SET foreign_key_checks=0");
            DB::table('role_user')->truncate();
            DB::table('permission_role')->truncate();
            User::truncate();
            Role::truncate();
            Permission::truncate();
        DB::statement("SET foreign_key_checks=1");
        //crear usuario Superadministrador
        $person = Person::where('document','7713344')->first();
        $usersuperadmin = User::create([
            "nickname" => "SuperUsuario",
            "person_id" => $person->id,
            "email" => "ing.diego.mendez@gmail.com",
            "password" => Hash::make("12345678")
        ]);
        //crear usuario administrador
        $person = Person::where('document','1004225163')->first();
        $useradmin = User::create([
            "nickname" => "zet612",
            "person_id" => $person->id,
            "email" => "jsperdomo361@misena.edu.co",
            "password" => Hash::make("12345678")
        ]);
        //crear aplicacion
        $app = App::create([
            "name" => "SICA",
            "url" => "/sica/index",
            "color" => "#ff5e1f",
            "icon" => "fas fa-puzzle-piece",
            "description" => "En esta aplicación se administra la confgur-......",
            "description_english" => "English -> En esta aplicación se administra la confgur-......"
        ]);
        //crear rol admin
        $roladmin = Role::create([
            "name" => "Administrador",
            "slug" => "sica.admin",
            "description" => "Rol administrador de la aplicacion SICA",
            "description_english" => "English - Rol administrador de la aplicacion SICA",
            "full-access" => "yes",
            "app_id" => $app->id
        ]);
        // asigno el rol de admin al usuario superadmin y admin
        $usersuperadmin->roles()->sync([$roladmin->id]);
        $useradmin->roles()->sync([$roladmin->id]);
        // lista de permisos para asignar al rol superadmin y admin
        $permission_all = [];

        $permission = Permission::create([
            "name" => "Listar Aplicaciones",
            "slug" => "sica.app.list",
            "description" => "Puede acceder a lista de aplicaciones",
            "description_english" => "English - Puede acceder a lista de aplicaciones",
            "app_id" => $app->id
        ]);
        $permission_all[] = $permission->id;
        $roladmin->permissions()->sync($permission_all);

    }
}
