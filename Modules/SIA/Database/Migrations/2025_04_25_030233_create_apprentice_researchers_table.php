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
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade'); // Relación uno a uno con users
            $table->foreignId('person_id')->unique()->constrained('people')->onDelete('cascade');
            $table->foreignId('eps_id')->constrained('e_p_s')->onDelete('cascade');
            $table->foreignId('program_id')->constrained('programs')->onDelete('cascade'); 
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->foreignId('group_id')->constrained('groups')->onDelete('cascade'); 
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('set null'); 
            $table->string('institution', 100)->nullable(); 
            $table->date('start_date'); 
            $table->timestamps(); // created_at y updated_at
            $table->softDeletes(); // deleted_at para eliminación lógica
            $table->index('user_id', 'apprentice_researchers_user_id_index'); 
            $table->index('person_id', 'apprentice_researchers_person_id_index');
            $table->index('project_id', 'apprentice_researchers_project_id_index'); // Índice para consultas por project_id
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