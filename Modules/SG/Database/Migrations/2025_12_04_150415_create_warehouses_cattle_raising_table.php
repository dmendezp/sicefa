<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('warehouses_cattle_raising', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();           // Ej: BOD-01, BOD-FARMACIA
            $table->string('name', 100);                    // Bodega Principal, Farmacia, Herramientas
            $table->string('location', 150)->nullable();     // Descripción de ubicación física
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Índices para búsquedas rápidas
            $table->index('code');
            $table->index('is_active');
        });
    }

    public function down()
    {
        Schema::dropIfExists('warehouses_cattle_raising');
    }
};