<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Points', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->integer('quantity');
            $table->string('theme');
            $table->enum('state', ['Positivo', 'Negativo']);
            $table->foreignId('apprentice_id')->references('id')->on('apprentices');

            $table->foreignId('program_id')->references('id')->on('programs');
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
        Schema::dropIfExists('Points');
    }
}
