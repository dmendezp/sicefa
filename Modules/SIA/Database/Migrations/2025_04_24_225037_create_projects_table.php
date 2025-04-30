<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('leader_id')->nullable()->constrained('role_user')->onDelete('set null'); // Líder del proyecto, nullable
            $table->string('title', 100); 
            $table->text('description'); 
            $table->dateTime('start_date'); 
            $table->dateTime('end_date')->nullable(); 
            $table->string('document_path', 255)->nullable(); 
            $table->enum('status', ['IN_PROGRESS', 'COMPLETED', 'CANCELLED'])->default('IN_PROGRESS'); 
            $table->text('progress')->nullable(); 
            $table->text('notes')->nullable(); 
            $table->text('expected_outcomes'); // Resultados esperados
            $table->timestamps(); // created_at y updated_at 
            $table->softDeletes(); // deleted_at 
            $table->index('leader_id'); // Índice para consultas por líder
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

 
