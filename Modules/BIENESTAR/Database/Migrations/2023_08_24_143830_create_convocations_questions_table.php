<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;

class CreateConvocationsQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convocations_questions', function (Blueprint $table) {
            $table->id();  
            $table->unsignedBigInteger('convocation_id');
            $table->unsignedBigInteger('questions_id');
            $table->timestamps();
            $table->foreign('convocation_id')->references('id')->on('convocations');
            $table->foreign('questions_id')->references('id')->on('questions');
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('convocations_questions');
    }
}
