<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvironmentProductiveUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('environment_productive_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('environment_id')->constrained()->onDelete('cascade');
            $table->foreignId('productive_unit_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['environment_id','productive_unit_id'], 'unique_environment_productive_unit'); // Generar llave única entre las columnas environment_id y productive_unit_id
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
        Schema::dropIfExists('environment_productive_units');
    }
}
