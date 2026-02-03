<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150)->unique();                    // Nombre comercial
            $table->string('active_principle', 150);                   // Principio activo
            $table->string('presentation', 100);                       // Ej: Inyectable 100ml
            $table->string('dose_unit', 50);                           // ml, mg, UI
            $table->string('manufacturer', 100)->nullable();          // Laboratorio
            $table->string('batch', 50)->nullable();                   // Lote
            $table->date('expiration_date');                           // Vencimiento
            $table->decimal('stock', 10, 2)->default(0);               // Stock actual
            $table->decimal('minimum_stock', 8, 2)->default(10);       // Alerta de stock bajo
            $table->text('observations')->nullable();                  // Notas
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medicines');
    }
}