<?php

namespace Modules\DICSENA\Database\Seeders;

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
        $permission_instructor = []; // Permisos para Instrucor

        $app = App::where('name', 'DICSENA')->first();
        // $this->call("OthersTableSeeder");
    }
}
