<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;


class CreateRoutesTransportationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes_transportations', function (Blueprint $table) {
            $table->id();
            $table->string('route_number');
            $table->string('name_route');
            $table->string('stop_bus');
            $table->time('arrival_time');
            $table->time('departure_time');
            $table->string('quota');
            $table->unsignedBigInteger('bus_id');
            $table->timestamps();
            $table->foreign('bus_id')->references('id')->on('buses');
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
        Schema::dropIfExists('routes_transportations');
    }
}