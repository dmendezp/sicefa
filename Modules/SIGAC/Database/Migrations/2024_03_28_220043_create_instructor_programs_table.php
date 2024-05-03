<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructorProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_programs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->foreignId('person_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('environment_id')->constrained()->onDelete('cascade');
            $table->foreignId('learning_outcome_id')->constrained()->onDelete('cascade');
            $table->enum('state', ['Pendiente', 'Evaluado']);
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
        Schema::dropIfExists('instructor_programs');
    }
}
