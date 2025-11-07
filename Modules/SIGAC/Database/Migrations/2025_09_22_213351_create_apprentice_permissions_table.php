<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprenticePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::create('apprentice_permissions', function (Blueprint $table) {
        $table->id();

        // Relación con el usuario (aprendiz)
        $table->unsignedBigInteger('person_id');
        $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');

        // Relación con el instructor
        $table->unsignedBigInteger('instructor_id');
        $table->foreign('instructor_id')->references('id')->on('people')->onDelete('cascade');

        // Relación con la ficha (curso)
        $table->unsignedBigInteger('course_id');
        $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

        // Información de la solicitud
        $table->date('date');
        $table->time('time_start');
        $table->time('time_finish');
        $table->string('permission_reason');
        $table->text('permission_detail');

        // Evidencia opcional
        $table->string('evidence_url')->nullable();
        $table->enum('status', ['earring', 'approved', 'rejected','cancelled'])->default('earring');
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
        Schema::dropIfExists('apprentice_permissions');
    }
}
