<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;


class CreatePostulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postulations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('apprentice_id');
            $table->unsignedBigInteger('convocation_id');
            $table->unsignedBigInteger('type_of_benefit_id');
            $table->string('total_score');
            $table->timestamps();
            $table->foreign('apprentice_id')->references('id')->on('apprentices');
            $table->foreign('type_of_benefit_id')->references('id')->on('types_of_benefits');
            $table->foreign('convocation_id')->references('id')->on('convocations');
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
        Schema::dropIfExists('postulations');
    }
}
