<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchProjectApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_project_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('research_project_id')->constrained()->onDelete('cascade');
            $table->foreignId('apprentice_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['Pendiente', 'Aprobado', 'Rechazado'])->default('Pendiente'); // Pendiente, Aprobado, Rechazado
            $table->text('observation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('research_project_applications');
    }
}
