<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('apprentice_researchers', function (Blueprint $table) {
            $table->id(); // Clave primaria (BIGINT UNSIGNED, autoincremental)
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade'); // Relación uno a uno con users
            $table->foreignId('person_id')->nullable()->unique()->constrained('people')->onDelete('set null'); // Relación uno a uno con people
            $table->string('training_program', 100); // Programa de formación (ej. Técnico en Sistemas)
            $table->string('institution', 100)->nullable(); // Centro de formación
            $table->date('start_date')->nullable(); // Fecha de ingreso como aprendiz
            $table->timestamps(); // created_at y updated_at para auditoría
            $table->softDeletes(); // deleted_at para eliminación lógica
            $table->index('user_id'); // Índice para consultas por user_id
            $table->index('person_id'); // Índice para consultas por person_id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('apprentice_researchers');
    }
};