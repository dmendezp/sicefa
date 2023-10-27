<?php

namespace Modules\RADIOCEFA\Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Database\Eloquent\Model;
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
        $permission_Locutor=[];//permosos de locutor
        $permission_oyente=[];//permisos de oyente

        // Consultar aplicación RADICEFA para registrar los roles
        $app = App::where('name','RADICEFA')->first();

        // ===================== Registro de todos los permisos de la aplicación RADICEFA ==================
        // Dashboard de administrador
        $permission = Permission::updateOrCreate(['slug' => 'loc.index'], [ // permisos de locutores 
            'name' => 'pag locutores',
            'description' => 'Pagina de ingreso locutores',
            'description_english' => 'Voice talent login page',
            'app_id' => $app->id
        ]);
        $permission_Locutor[] = $permission->id; // Almacenar permiso para rol
        

        $permission = Permission::updateOrCreate(['slug' => 'oyente'], [ // permisos de oyentes 
            'name' => 'oyente',
            'description' => 'permisos de mensajes para oyentes',
            'description_english' => 'message permissions for listeners',
            'app_id' => $app->id
        ]);

    }
}
