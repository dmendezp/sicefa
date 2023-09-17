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
                "description" => "Zonificacion de las Areas, Unidades y Ambientes del CEFA",
                "description_english" => "Zoning of CEFA Areas, Units and Environments"
            ]);
        }
        //crear usuario administrador -- no modificar
        $useradmin = User::where('nickname','LolaFernada')->first();
        if(!$useradmin){
            $person = Person::where('document_number','1079172063')->first();
            $useradmin = User::create([
                "nickname" => "LolaFernada",
                "person_id" => $person->id,
                "email" => "lolafernanda@misena.edu.co",
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
                "description_english" => "CEFAMAPS application administrator role",
                "full_access" => "Si",
                "app_id" => $app->id
            ]);
        }
        // asigno el rol de admin al usuario superadmin y admin
        $useradmin->roles()->syncWithoutDetaching([$roladmin->id]);
        // lista de permisos para asignar al rol superadmin y admin
        $permission_admin = [];
// repita para cada permiso -- estos permisos son de su aplicacion, agregue los necesarios

        // Estos son los permisos de ambientes (environment)
        $permission = Permission::where('slug','cefamaps.admin.dashboard')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Admin Dashboard",
                "slug" => "cefamaps.admin.dashboard",
                "description" => "Puede ver el dashboard de administrador",
                "description_english" => "You can see the admin dashboard",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;

        $permission = Permission::where('slug','cefamaps.admin.config.environment.index')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Inicio de la configuracion de Ambientes",
                "slug" => "cefamaps.admin.config.environment.index",
                "description" => "Puedes hacer todo lo de un crud para los ambientes",
                "description_english" => "You can do all of a crud for environments",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;

        $permission = Permission::where('slug','cefamaps.admin.config.environment.add')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Agregar un Ambientes",
                "slug" => "cefamaps.admin.config.environment.add",
                "description" => "Puedes agregar un ambiente",
                "description_english" => "You can add an environment",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;

        $permission = Permission::where('slug','cefamaps.admin.config.environment.edit')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Editar un Ambientes",
                "slug" => "cefamaps.admin.config.environment.edit",
                "description" => "Puedes editar un ambiente",
                "description_english" => "You can edit an environment",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;

        $permission = Permission::where('slug','cefamaps.admin.environment.delete')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Eliminar un Ambientes",
                "slug" => "cefamaps.admin.environment.delete",
                "description" => "Puedes eliminar un ambiente",
                "description_english" => "You can delete an environment",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;

        // Estos son los permisos de las unidades (Unit)

        $permission = Permission::where('slug','cefamaps.admin.config.unit.index')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Inicio de la configuracion de las unidades",
                "slug" => "cefamaps.admin.config.unit.index",
                "description" => "Puedes hacer todo lo de un crud para la unidad",
                "description_english" => "You can do all of a crud for unit",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;

        $permission = Permission::where('slug','cefamaps.admin.config.unit.add')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Agregar una Unidad",
                "slug" => "cefamaps.admin.config.unit.add",
                "description" => "Puedes agregar una unidad",
                "description_english" => "You can add a unit",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;

        $permission = Permission::where('slug','cefamaps.admin.config.unit.edit')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Editar una Unidad",
                "slug" => "cefamaps.admin.config.unit.edit",
                "description" => "Puedes editar una unidad",
                "description_english" => "You can edit a unit",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;

        $permission = Permission::where('slug','cefamaps.admin.unit.delete')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Eliminar una Unidad",
                "slug" => "cefamaps.admin.unit.delete",
                "description" => "Puedes eliminar una unidad",
                "description_english" => "You can delete a unit",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;

        // Estos son los permisos de las granjas (Farm)

        $permission = Permission::where('slug','cefamaps.admin.config.farm.index')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Inicio de la configuracion de las granjas",
                "slug" => "cefamaps.admin.config.farm.index",
                "description" => "Puedes hacer todo lo de un crud para la granja",
                "description_english" => "You can do all of a crud for farm",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;

        $permission = Permission::where('slug','cefamaps.admin.config.farm.add')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Agregar una Granja",
                "slug" => "cefamaps.admin.config.farm.add",
                "description" => "Puedes agregar una granja",
                "description_english" => "You can add a farm",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;

        $permission = Permission::where('slug','cefamaps.admin.config.farm.edit')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Editar una Granja",
                "slug" => "cefamaps.admin.config.farm.edit",
                "description" => "Puedes editar una granja",
                "description_english" => "You can edit a farm",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;

        $permission = Permission::where('slug','cefamaps.admin.farm.delete')->first();
        if(!$permission){
            $permission = Permission::create([
                "name" => "Eliminar una Granja",
                "slug" => "cefamaps.admin.farm.delete",
                "description" => "Puedes eliminar una granja",
                "description_english" => "You can delete a farm",
                "app_id" => $app->id
            ]);
        }
        $permission_admin[] = $permission->id;

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
        $roladmin->permissions()->syncWithoutDetaching($permission_admin);

    }
}
