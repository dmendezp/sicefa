<?php

namespace Modules\CEFAMAPS\Database\Seeders;

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
        $app = App::where('name','CEFAMAPS')->first();
        if(!$app){
            $app = App::create([
                "name" => "CEFAMAPS",
                "url" => "/cefamaps/index",
                "color" => "#4FB1D9",
                "icon" => "fas fa-map",
                "description" => "En esta aplicación se mostra el mapa del S-......",
                "description_english" => "English -> En esta aplicación se mostra el mapa del S-......"
            ]);
        }
        //crear usuario administrador
        $useradmin = User::where('nickname','Sabogal22')->first();
        if(!$useradmin){
            $person = Person::where('document_number','1079172063')->first();
            $useradmin = User::create([
                "nickname" => "Sabogal22",
                "person_id" => $person->id,
                "email" => "nsabogalgaitan@gmail.com",
                "password" => Hash::make("12345678")
            ]);
        }
        //crear rol administrador
        $roladmin = Role::where('slug','cefamaps.admin')->first();
        if(!$roladmin){
            $roladmin = Role::create([
                "name" => "Administrador CEFAMAPS",
                "slug" => "cefamaps.admin",
                "description" => "Rol administrador de la aplicacion CEFAMAPS",
                "description_english" => "English - Rol administrador de la aplicacion CEFAMAPS",
                "full-access" => "yes",
                "app_id" => $app->id
            ]);
        }
        // asigno el rol de admin al usuario superadmin y admin
        $usersuperadmin->roles()->sync([$roladmin->id]);
        $useradmin->roles()->sync([$roladmin->id]);
        // lista de permisos para asignar al rol superadmin y admin
        $permission_admin = [];
// repita para cada permiso -- estos permisos son de su aplicacion, agregue los necesarios

        /*$permission = Permission::where('slug','cefamaps.admin.dashboard')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Inicio de Administrador",
                "slug" => "cefamaps.admin.dashboard",
                "description" => "Puede gestionar la informacion de las personas",
                "description_english" => "English - Puede gestionar la informacion de las personas",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;*/

        // se asignan los permisos a los roles
        $roladmin->permissions()->sync($permission_admin);

    }
}
