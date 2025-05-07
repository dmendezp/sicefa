<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('origin_id')->constrained('municipalities')->onDelete('cascade');
            $table->foreignId('municipality_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('village_id')->constrained()->onDelete('cascade')->nullable();
            $table->integer('one_way_price');
            $table->integer('round_trip_price');

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
        Schema::dropIfExists('rates');
    }
}
