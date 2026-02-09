<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->string('id', 50)->primary(); // ej: 9028-H, B123, V456-M
            $table->string('plate', 50)->nullable();
            $table->string('name', 100)->nullable();
            $table->foreignId('breed_id')->nullable()->constrained('breeds')->nullOnDelete();
            $table->enum('sex', ['MALE', 'FEMALE']);
            $table->integer('age_in_months')->nullable();
            $table->decimal('weight_kg', 8, 2)->nullable();
            $table->enum('production_stage', ['CALF', 'GROWING', 'DRY', 'MILKING', 'CULL']);
            $table->string('age_group', 50)->nullable();
            $table->decimal('inventory_value', 12, 2)->nullable();
            $table->string('lot', 50)->nullable();
            $table->text('note')->nullable();
            $table->date('entry_date')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('body_condition', 50)->nullable();
            $table->text('observations')->nullable();

            // CAMPO PARA FOTO DEL ANIMAL (NUEVO)
            $table->string('photo_path', 255)->nullable();
            // Ejemplo: storage/app/public/animals/9028-H.jpg

            $table->timestamps();

            // Índices para rendimiento
            $table->index('name');
            $table->index('production_stage');
            $table->index('lot');
            $table->index('breed_id');  
            $table->index('sex');
            $table->index('photo_path');
        });
    }

    public function down()
    {
        Schema::dropIfExists('animals');
    }
};