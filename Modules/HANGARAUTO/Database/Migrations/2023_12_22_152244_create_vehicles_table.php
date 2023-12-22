<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('reference',['Motocicleta','Ciclomotor','Motocarro','Tractor Agrícola','Autobus','Furgoneta']);
            $table->enum('status', ['Disponible','No Disponible']);
            $table->string('license');
            $table->enum('fuel_level', ['Bajo','Medio','Alto']);
            $table->string('file_path');
            $table->string('image');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
