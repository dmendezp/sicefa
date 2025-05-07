<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReproductiveCyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reproductive_cycles', function (Blueprint $table) {
            $table->id('id_cycle');
            $table->foreignId('sow_id')->constrained('pigs', 'id_pig')->onDelete('cascade');
            $table->date('service_date')->nullable();
            $table->date('birth_date')->nullable();
            $table->integer('live_piglets')->nullable();
            $table->integer('dead_piglets')->nullable();
            $table->date('lactation_end_date')->nullable();
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
        Schema::dropIfExists('reproductive_cycles');
    }
}
