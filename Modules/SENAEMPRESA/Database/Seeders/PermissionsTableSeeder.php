<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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
        $permission_intern = []; // Permisos para Pasante
        $permission_user = []; // Permisos para usuario


        // Consultar aplicación SENAEMPRESA para registrar los roles
        $app = App::where('name', 'SENAEMPRESA')->first();

        // Vista pasante senaempresa
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.pasante.index'], [ // Registro o actualización de permiso
            'name' => 'Vista Usuario Senaempresa',
            'description' => 'Puede ver vista pasante senaempresa',
            'description_english' => 'You can see senaempresa trainee view',
            'app_id' => $app->id
        ]);
        $permission_intern[] = $permission->id; // Almacenar permiso para rol

        // Vista usuario senaempresa
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.usuario.index'], [ // Registro o actualización de permiso
            'name' => 'Vista Pasante Senaempresa',
            'description' => 'Puede ver vista usuario senaempresa',
            'description_english' => 'You can see user view senaempresa',
            'app_id' => $app->id
        ]);
        $permission_intern[] = $permission->id; // Almacenar permiso para rol

        // Vista senaempresa estrategias
        $permission = Permission::updateOrCreate(['slug' => 'company.senaempresa'], [ // Registro o actualización de permiso
            'name' => 'Vista SenaEmpresa Estrategias',
            'description' => 'Puede ver vista de SenaEmpresa Estrategias',
            'description_english' => 'You can see a view of SenaEmpresa Estrategias',
            'app_id' => $app->id
        ]);
        $permission_intern[] = $permission->id; // Almacenar permiso para rol
        $permission_user[] = $permission->id; // Almacenar permiso para rol

        // Vista senaempresa personal
        $permission = Permission::updateOrCreate(['slug' => 'company.senaempresa.personal'], [ // Registro o actualización de permiso
            'name' => 'Vista SenaEmpresa Personal',
            'description' => 'Puede ver vista de SenaEmpresa Personal',
            'description_english' => 'You can see a view of the Sena Personal Company',
            'app_id' => $app->id
        ]);
        $permission_intern[] = $permission->id; // Almacenar permiso para rol
        $permission_user[] = $permission->id; // Almacenar permiso para rol

        // Vista senaempresa prestamos
        $permission = Permission::updateOrCreate(['slug' => 'company.loan.prestamos'], [ // Registro o actualización de permiso
            'name' => 'Vista SenaEmpresa Prestamos',
            'description' => 'Puede ver vista de SenaEmpresa Prestamos',
            'description_english' => 'You can see a view of SenaEmpresa Loans',
            'app_id' => $app->id
        ]);
        $permission_intern[] = $permission->id; // Almacenar permiso para rol
        $permission_user[] = $permission->id; // Almacenar permiso para rol

        // Vista senaempresa Vacantes
        $permission = Permission::updateOrCreate(['slug' => 'company.vacant.vacantes'], [ // Registro o actualización de permiso
            'name' => 'Vista SenaEmpresa Vacantes',
            'description' => 'Puede ver vista de SenaEmpresa Vacantes',
            'description_english' => 'You can view SenaEmpresa Vacancies view',
            'app_id' => $app->id
        ]);
        $permission_intern[] = $permission->id; // Almacenar permiso para rol
        $permission_user[] = $permission->id; // Almacenar permiso para rol



        $permission = Permission::updateOrCreate(['slug' => 'company.position.cargos'], [ // Registro o actualización de permiso
            'name' => 'Vista SenaEmpresa Cargos',
            'description' => 'uede ver vista de SenaEmpresa Cargos',
            'description_english' => 'You can view SenaEmpresa Positions view',
            'app_id' => $app->id
        ]);
        $permission_intern[] = $permission->id; // Almacenar permiso para rol
        $permission_user[] = $permission->id; // Almacenar permiso para rol

        // Consulta de ROLES
        $rol_pasante = Role::where('slug', 'senaempresa.pasante')->first(); // Rol Pasante Senaempresa
        $rol_usuario = Role::where('slug', 'senaempresa.usuario')->first(); // Rol Usuario Senaempresa

        // Asignación de PERMISOS para los ROLES de la aplicación SENAEMPRESA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_pasante->permissions()->syncWithoutDetaching($permission_intern);
        $rol_usuario->permissions()->syncWithoutDetaching($permission_user);
    }
}
