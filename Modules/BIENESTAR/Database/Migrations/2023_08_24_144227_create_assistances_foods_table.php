<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateAssistancesFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistances_foods', function (Blueprint $table) {
            $table->id();   
            $table->unsignedBigInteger('apprentice_id');
            $table->unsignedBigInteger('postulation_benefit_id');
            $table->string('porcentage');
            $table->datetime('date_time');
            $table->timestamps();
            $table->foreign('apprentice_id')->references('id')->on('apprentices');
            $table->foreign('postulation_benefit_id')->references('id')->on('postulations_benefits');
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
        Schema::dropIfExists('assistances_foods');
    }
}
