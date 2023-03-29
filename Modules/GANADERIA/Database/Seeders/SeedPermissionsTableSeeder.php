<?php

namespace Modules\SICA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Modules\GANADERIA\Entities\Person;
use Modules\GANADERIA\Entities\App;
use Modules\GANADERIA\Entities\Role;
use Modules\GANADERIA\Entities\Permission;
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
        $app = App::where('name','GANADERIA')->first();
        if(!$app){
            $app = App::create([
                "name" => "GANADERIA",
                "url" => "/ganaderia/index",
                "color" => "#ff5e1f",
                "icon" => "fas fa-puzzle-piece",
                "description" => "En esta aplicación se administra la confgur-......",
                "description_english" => "English -> En esta aplicación se administra la confgur-......"
            ]);
        }
        //crear usuario veterinario
        $useradmin = User::where('nickname','veterinario')->first();
        if(!$useradmin){
            $person = Person::where('document','1004225163')->first();
            $useradmin = User::create([
                "nickname" => "veterinario",
                "person_id" => $person->id,
                "email" => "veterinario@misena.edu.co",
                "password" => Hash::make("12345678")
            ]);
        }

        //crear usuario veterinario
        $useradmin = User::where('nickname','aprendiz_lider')->first();
        if(!$useradmin){
            $person = Person::where('document','76543332')->first();
            $useradmin = User::create([
                "nickname" => "aprendiz_lider",
                "person_id" => $person->id,
                "email" => "aprendiz_lider@misena.edu.co",
                "password" => Hash::make("12345678")
            ]);
        }
        
        //crear rol Veterinario
        $rolveterinario = Role::where('slug','ganaderia.veterinario')->first();
        if(!$rolveterinario){
            $rolveterinario = Role::create([
                "name" => "Veterinario",
                "slug" => "ganaderia.veterinario",
                "description" => "Rol administrador de la aplicacion GANADERIA",
                "description_english" => "English - Rol administrador de la aplicacion GANADERIA",
                "full-access" => "yes",
                "app_id" => $app->id
            ]);
        }

         //crear rol aprendiz lider
         $rolaprendiz_lider = Role::where('slug','ganaderia.aprendiz_lider')->first();
         if(!$rolaprendiz_lider){
             $rolaprendiz_lider = Role::create([
                 "name" => "aprendiz_lider",
                 "slug" => "ganaderia.aprendiz_lider",
                 "description" => "Rol administrador de la aplicacion GANADERIA",
                 "description_english" => "English - Rol administrador de la aplicacion GANADERIA",
                 "full-access" => "yes",
                 "app_id" => $app->id
             ]);
         }
        
        // asigno el rol de admin al usuario superadmin y admin
        $usersuperadmin->roles()->syncWithoutDetaching([$roladmin->id]);
        $useradmin->roles()->syncWithoutDetaching([$roladmin->id]);
        $rolveterinario->roles()->syncWithoutDetaching([$rolveterinario->id]);
       
        // lista de permisos para asignar al rol superadmin y admin
        $permission_admin = [];
        
// repita para cada permiso -- estos permisos son de su aplicacion, agregue los necesarios

        $permission = Permission::where('slug','ganaderia.admin.veterinary.home')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Inicio de Veterinario",
                "slug" => "ganaderia.admin.veterinary.home",
                "description" => "Puede gestionar la informacion del personal del animal",
                "description_english" => "English - Puede gestionar la informacion de las personas",
                "app_id" => $app->id
            ]);
        }

        $permission_admin[] = $permission->id;
        $permission_veterinary[] = $permission->id;
        $permission_apprentice_leader[] = $permission->id;



        $permission = Permission::where('slug','ganaderia.admin.apprentice_leader.home2')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Inicio de Apendiz_lider",
                "slug" => "ganaderia.admin.apprentice_leader.home2",
                "description" => "Puede gestionar la informacion del personal del animal",
                "description_english" => "English - Puede gestionar la informacion de las personas",
                "app_id" => $app->id
            ]);
        }

        $permission_admin[] = $permission->id;
        $permission_apprentice_leader[] = $permission->id;

        $permission = Permission::where('slug','ganaderia.admin.dashboard')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Inicio de Administrador",
                "slug" => "ganaderia.admin.dashboard",
                "description" => "Puede gestionar la informacion del personal del animal",
                "description_english" => "English - Puede gestionar la informacion de las personas",
                "app_id" => $app->id
            ]);
        }
      


        // se asignan los permisos a los roles
        $roladmin->permissions()-> syncWithoutDetaching($permission_admin);
        $rolapprentice_leader->permissions()-> syncWithoutDetaching($permission_apprentice_leader);
        $rolveterinary->permissions()-> syncWithoutDetaching($permission_veterinary);
        

    }
}
