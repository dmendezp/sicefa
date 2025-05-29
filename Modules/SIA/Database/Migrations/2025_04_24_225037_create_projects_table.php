<?php

namespace Modules\SIA\Database\Migrations;

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
        Schema::create('projects', function (Blueprint $table) {
            $table->id(); // Identificador único
            $table->string('name'); // Nombre del proyecto
            $table->text('description')->nullable(); // Descripción del proyecto
            $table->date('start_date'); // Fecha de inicio del proyecto
            $table->date('end_date')->nullable(); // Fecha de finalización del proyecto
            $table->foreignId('leader_id')->constrained('users')->onDelete('cascade'); // Relación con el líder del proyecto (usuario)
            $table->timestamps(); // created_at y updated_at
            $table->softDeletes(); // deleted_at para eliminación lógica
            $table->index('updated_at', 'proejcts_updated_at_index'); // Índice para consultas por updated_at
        });

        Schema::create('project_user', function (Blueprint $table) {
            $table->id(); // Clave primaria
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade'); 
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->string('role', 50)->nullable(); 
            $table->timestamps(); // created_at y updated_at
            $table->unique(['project_id', 'user_id']); // Evitar duplicados
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('project_user');
        Schema::dropIfExists('projects');
    }
};


