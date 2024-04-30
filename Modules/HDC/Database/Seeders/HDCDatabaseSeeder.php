<?php

namespace Modules\HDC\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class HDCDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::beginTransaction(); // Iniciar Transaccion
       $this->call(AppTableSeeder::class); // Ejecutar Seeder de aplicacion
       /* $this->call(PeopleTableSeeder::class); // Ejecutar Seeder de personas */
      /*  $this->call(UsersTableSeeder::class); // Ejecutar Seeder de usuarios */
       $this->call(RolesTableSeeder::class); // Ejecutar Seeder de roles de usuario
       $this->call(PermissionsTableSeeder::class); // Ejecutar Seeder de permisos para roles 

       DB::commit(); // Finalizar Trasnsaccion
    }
}
