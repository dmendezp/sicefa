<?php

namespace Modules\DICSENA\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $app = App::where('name', 'DICSENA')->first();

        // Registrar o actualizar rol de instructor
        $rol_instructor = Role::updateOrCreate(['slug' => 'dicsena.menu'], [
            'name' => '',
            'description' => 'Rol administrador de DICSENA',
            'description_english' => 'Role inst of DICSENA',
            'app_id' => $app->id
        ]);

        $user_instructor = User::where('nickname', 'Instructor')->first();
        // $this->call("OthersTableSeeder");
    }
}
