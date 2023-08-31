<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportationAssistancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportation_assistances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('route_transportation_id');
            $table->unsignedBigInteger('apprentice_id');
            $table->unsignedBigInteger('postulation_benefit_id');
            $table->unsignedBigInteger('bus_id');
            $table->unsignedBigInteger('bus_driver_id');
            $table->string('porcentenge');
            $table->datetime('date_time');
            $table->timestamps();
            $table->foreign('route_transportation_id')->references('id')->on('routes_transportations');
            $table->foreign('apprentice_id')->references('id')->on('apprentices');
            $table->foreign('postulation_benefit_id')->references('id')->on('postulations_benefits');
            $table->foreign('bus_id')->references('id')->on('buses');
            $table->foreign('bus_driver_id')->references('id')->on('bus_drivers');
           
           

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transportation_assistances');
    }
}
