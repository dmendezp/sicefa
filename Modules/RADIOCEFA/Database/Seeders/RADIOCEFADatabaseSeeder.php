<?php

namespace Modules\RADIOCEFA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RADIOCEFADatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    $usuario = new User();
    $usuario->name = 'Maria Rosell';
    $usuario->email = 'MariaRosell@example.com';
    $usuario->password = bcrypt('contraseña');
    $usuario->save();
}

}
