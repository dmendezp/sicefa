<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChangeInstructorProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_instructor_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instructor_program_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->enum('activity',['Formación','Atención medios tecnológicos','Investigación','Permiso','Compromiso Institucional']);
            $table->text('observation')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('change_instructor_programs');
    }
}
