<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempAppreticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_appretices', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->unsignedInteger('documento')->nullable();
            $table->string('nombre');
            $table->string('apellidos');
            $table->unsignedInteger('celular')->nullable();
            $table->string('correo')->nullable();
            $table->string('estado')->nullable();
            $table->Integer('programa');
            $table->Integer('ficha');
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
        Schema::dropIfExists('temp_appretices');
    }
}
