<?php   

namespace Modules\LOMBRISOFT\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Modules\SICA\Entities\Role;
use Modules\SICA\Entities\App;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $app = App::where('name', 'LOMBRISOFT')->firstOrFail();
        
        $roleadmin = Role::updateOrCreate(['slug' => 'lombrisoft.admin'], [
            'name' => 'Administrador',
            'description' => 'Administrador del sistema de Lombricultivo',
            'description_english' => 'Lombricultivo system administrator',
            'full_access' => 'No',
            'app_id' => $app->id,
        ]);
        $useradministrador = User::where('nickname', 'Nardila')->firstOrFail();
        $useradministrador ->roles()->syncWithoutDetaching([$roleadmin->id]);
    }
}