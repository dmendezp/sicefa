<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateAssingTransportRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assing_transport_routes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('apprentice_id');
            $table->unsignedBigInteger('route_transportation_id');
            $table->unsignedBigInteger('postulation_benefit_id');
            $table->timestamps();
            $table->foreign('apprentice_id')->references('id')->on('apprentices');
            $table->foreign('route_transportation_id')->references('id')->on('routes_transportations');
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
        Schema::dropIfExists('assing_transport_routes');
    }
}
