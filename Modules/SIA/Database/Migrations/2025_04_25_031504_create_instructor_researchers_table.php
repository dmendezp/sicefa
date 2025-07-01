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
        Schema::create('instructor_researchers', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('person_id')->nullable()->unique()->constrained('people')->onDelete('set null'); // Relación uno a uno con people
            $table->foreignId('profession_id')->nullable()->constrained('professions')->onDelete('set null'); // Relación con professions
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade'); // Relación uno a uno con users
            $table->text('research_skills'); // Habilidades de investigación
            $table->timestamps(); // created_at y updated_at 
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
        Schema::dropIfExists('instructor_researchers');
    }
};
