<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Soats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_name_id')->constrained('Vehicles');
            $table->string('who');
            $table->string('arrived');
            $table->string('newdate');
            $table->timestamps();
            $table->softDeletes;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Soats');
    }
}
