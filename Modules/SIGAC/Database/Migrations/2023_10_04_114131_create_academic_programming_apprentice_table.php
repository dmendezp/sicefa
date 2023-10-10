<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademicProgrammingApprenticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_programming_apprentice', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_programming_id')->constrained()->onDelete('cascade');
            $table->foreignId('apprentice_id')->constrained()->onDelete('cascade');
            $table->enum('attendance_type',['Falta injustificada','Falta justificada','Media falta','Presente']);
            $table->unique(['academic_programming_id','apprentice_id'], 'unique_academic_programming_apprentice'); // Generar llave única entre las columnas academic_programming_id y apprentice_id
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('academic_programming_apprentice');
    }
}
