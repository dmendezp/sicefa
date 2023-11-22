<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreatePostulationsBenefitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postulations_benefits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('benefit_id');
            $table->unsignedBigInteger('postulation_id');
            $table->string('state')->default(''); 
            $table->string('message')->default('');
            $table->timestamps();
            $table->foreign('benefit_id')->references('id')->on('benefits');
            $table->foreign('postulation_id')->references('id')->on('postulations');
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
        Schema::dropIfExists('postulations_benefits');
    }
}
