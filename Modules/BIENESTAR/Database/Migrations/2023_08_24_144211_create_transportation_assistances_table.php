<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;

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
            $table->unsignedBigInteger('assing_transport_route_id');
            $table->unsignedBigInteger('apprentice_id');
            $table->unsignedBigInteger('postulation_benefit_id');
            $table->unsignedBigInteger('bus_id');
            $table->unsignedBigInteger('bus_driver_id');
            $table->string('porcentenge');
            $table->datetime('date_time');
            $table->string('assistance_status');
            $table->timestamps();
            $table->foreign('assing_transport_route_id')->references('id')->on('assing_transport_routes');
            $table->foreign('apprentice_id')->references('id')->on('apprentices');
            $table->foreign('postulation_benefit_id')->references('id')->on('postulations_benefits');
            $table->foreign('bus_id')->references('id')->on('buses');
            $table->foreign('bus_driver_id')->references('id')->on('bus_drivers');
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
        Schema::dropIfExists('transportation_assistances');
    }
}
