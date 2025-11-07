<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardingSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boarding_schools', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('person_id');
             $table->foreign('person_id')->references('id')->on('people');
             $table->date('start_date');
             $table->date('end_date');
             $table->string('type');
             $table->string('area');
             $table->unsignedBigInteger('assigned_supervisor_id');
             $table->foreign('assigned_supervisor_id')->references('id')->on('people');
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
        Schema::dropIfExists('boarding_schools');
    }
}
