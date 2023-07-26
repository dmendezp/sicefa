<?php

namespace Modules\GANADERIA\Database\Seeders;

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
    App::updateOrCreate(['name' => 'GANADERIA'], [
      'url' => '/ganaderia/index',
      'color' => '#fdd835',
      "icon" => "fas fa-horse-head",
      "description" => "El sistema de caracterización ganadera Oviboprino maneja la información de esta área, registrando toda actividad que se realiza a diario para así obtener resultados y análisis de producción, inventario, gastos, entre otros.",
      "description_english" => "The Oviboprino livestock characterization system manages the information from this area, recording all the activity that is carried out in a journal in order to obtain results and analysis of production, inventory, expenses, among others.
      The Oviboprino livestock characterization system manages the information from this area, recording all the activity that is carried out in a journal in order to obtain results and analysis of production, inventory, expenses, among others."
    ]);
  }
}