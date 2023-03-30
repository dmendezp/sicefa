<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotingTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voting-topics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parrilla_id')->constrained()->onDelete('cascade');
            $table->string('nombre');
            $table->dateTime('inicio');
            $table->dateTime('fin');
            $table->enum('status', ['activo','inactivo']);
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
        Schema::dropIfExists('voting-topics');
    }
}
