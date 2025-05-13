<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesEnvironmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedulesenvironments', function (Blueprint $table) {
            $table->id(); // id primary key auto increment
            $table->unsignedBigInteger('environment1_id'); // Foreign Key to environments1
            $table->unsignedBigInteger('courses_id'); // Foreign Key to courses
            $table->enum('day_of_week', ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado']);
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('environment1_id')->references('id')->on('environments1')->onDelete('cascade');
            $table->foreign('courses_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedulesenvironments');
    }
}
