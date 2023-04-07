<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFingerAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finger_asistencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained()->nullable();
            $table->string('area');
            $table->dateTime('Date_In_Exit');
            $table->string('name_equipment');
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
        Schema::dropIfExists('finger_asistencias');
    }
}
