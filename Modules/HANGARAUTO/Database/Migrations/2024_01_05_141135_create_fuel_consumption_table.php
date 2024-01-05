<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuelConsumptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel_consumption', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_name_id')->constrained('Vehicles');
            $table->enum('Gasolina','Diesel');
            $table->date('date');
            $table->enum('Litros','Galones');
            $table->integer('price');
            $table->string('km/h');
            $table->foreignId('person_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuel_consumption');
    }
}
