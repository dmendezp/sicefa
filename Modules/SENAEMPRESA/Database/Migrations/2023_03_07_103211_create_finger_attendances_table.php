<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFingerAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finger_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->nullable()->constrained();
            $table->string('area');
            $table->date('date_turn');
            $table->time('time_in');
            $table->time('time_exit');
            $table->integer('hours_work');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finger_attendances');
    }
}
