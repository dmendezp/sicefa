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
            $table->id(); 
            $table->string('name'); 
            $table->text('description')->nullable(); 
            $table->date('start_date'); 
            $table->date('end_date')->nullable(); 
            $table->foreignId('leader_id')->constrained('users')->onDelete('cascade'); // Relación con el líder del proyecto (usuario)
            $table->timestamps(); // created_at y updated_at
            $table->softDeletes(); // deleted_at para eliminación lógica
            $table->index('updated_at', 'projects_updated_at_index'); 
        });

        Schema::create('project_role', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade'); 
            $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('set null');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
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
        Schema::dropIfExists('project_role');
        Schema::dropIfExists('projects');
    }
};


