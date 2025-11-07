<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceApprenticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_apprentices', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->enum('state',['P','MF','FJ','FI']);
            $table->foreignId('person_id')->constrained()->onDelete('cascade');
            $table->foreignId('instructor_program_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('attendance_apprendices');
    }
}
