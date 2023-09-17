<?php

namespace Modules\CEFAMAPS\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;

class AppTableSeeder extends seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    /* Registro o actualización de la nueva aplicación Sistema Integrado de Control Administrativo */
    App::updateOrCreate(['name' => 'CEFAMAPS'], [
      'url' => '/cefamaps/index',
      'color' => '#4FB1D9',
      'icon' => 'fas fa-map',
      'description' => 'Zonificacion de las Areas, Unidades y Ambientes del CEFA',
      'description_english' => 'Zoning of CEFA Areas, Units and Environments'
    ]);
  }
}