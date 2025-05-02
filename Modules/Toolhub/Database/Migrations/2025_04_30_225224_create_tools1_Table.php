<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTools1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tools1', function (Blueprint $table) {
            $table->id();
            $table->string('code'); // Código de la herramienta
            $table->string('name'); // Nombre de la herramienta
            $table->text('description'); // Descripción de la herramienta
            $table->enum('condition', ['new', 'used']); // Condición de la herramienta
            $table->tinyInteger('is_available')->default(1); // Disponibilidad de la herramienta
    
            $table->enum('category', ['Manual', 'Electrica', 'Mecanica']); // Categorías directamente aquí

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
        Schema::dropIfExists('tools1');
    }
}