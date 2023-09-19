<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvironmentalAspectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('environmental_aspects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('resource_id')->constrained()->onDelete('cascade');
            $table->foreignId('measurement_unit_id')->constrained()->onDelete('cascade');
            $table->enum('aspect_type', ['Consumo', 'Residuo']);
            $table->float('conversion_factor', 8, 3 );
            $table->boolean('personal');
            $table->enum('state', ['Activo', 'Inactivo']);
            $table->softDeletes();
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('environmental_aspects');
    }
}
