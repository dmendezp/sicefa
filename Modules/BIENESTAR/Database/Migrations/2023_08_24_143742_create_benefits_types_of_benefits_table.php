<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBenefitsTypesOfBenefitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benefits_types_of_benefits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('benefit_id');
            $table->unsignedBigInteger('type_of_benefit_id');
            $table->timestamps();
            $table->foreign('benefit_id')->references('id')->on('benefits');
            $table->foreign('type_of_benefit_id')->references('id')->on('types_of_benefits');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('benefits_types_of_benefits');
    }
}
