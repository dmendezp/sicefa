<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprenticeResearchersTable extends Migration
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
            $table->enum('program_type', [
                'Auxiliar', 'Complementaria virtual', 'Curso especial', 'Especialización tecnologica',
                'Operario', 'Profundización técnica', 'Técnico', 'Tecnólogo', 'Sin especificar'
            ]); // Tipo de programa, alineado con programs.program_type
            $table->foreignId('program_id')->nullable()->constrained('programs')->onDelete('set null'); // Relación con programs
            $table->string('ficha', 20); // Número de ficha del programa
            $table->enum('stage', ['LECTIVA', 'PRESENCIAL']); // Etapa del aprendiz
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('set null'); // Relación con projects
            $table->timestamps(); // created_at y updated_at para auditoría (fecha_registro)
            $table->softDeletes(); // deleted_at para eliminación lógica
            $table->index('user_id'); // Índice para consultas por user_id
            $table->index('person_id'); // Índice para consultas por person_id
            $table->index('program_id'); // Índice para consultas por program_id
            $table->index('project_id'); // Índice para consultas por project_id
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