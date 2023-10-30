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
        $rol_instructor = Role::updateOrCreate(['slug' => 'dicsena.instructor'], [
            'name' => 'Instructor Bilinguismo',
            'description' => 'Rol instructor de DICSENA',
            'description_english' => 'Role instructor of DICSENA',
            'full_access' => 'no',
            'app_id' => $app->id
        ]);

        $user_instructor = User::where('nickname', 'Instructor')->first();

        $user_instructor->roles()->syncWithoutDetaching([$rol_instructor->id]);
        // $this->call("OthersTableSeeder");
    }
}
