<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityEnvironmentalAspectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_environmental_aspects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained()->onDelete('cascade');
            $table->foreignId('environmental_aspect_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['environmental_aspect_id','activity_id'], 'unique_environmental_aspect_activity'); // Generar llave única entre las columnas environment_id y productive_unit_id
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
        Schema::dropIfExists('activity_environmental_aspects');
    }
}
