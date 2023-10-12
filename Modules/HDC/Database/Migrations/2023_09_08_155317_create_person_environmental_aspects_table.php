<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonEnvironmentalAspectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_environmental_aspects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('environmental_aspect_id')->constrained()->onDelete('cascade');
            $table->foreignId('family_person_footprint_id')->constrained()->onDelete('cascade');
            $table->integer('consumption_value');
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['environmental_aspect_id','family_person_footprint_id'], 'unique_personal_environmental_aspect_family_person_footprint'); // Generar llave única entre las columnas resourse_id y family_person_footprints_id
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
        Schema::dropIfExists('person_environmental_aspects');
    }
}
