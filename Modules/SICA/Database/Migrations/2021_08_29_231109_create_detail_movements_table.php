<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movement_id')->constrained()->onDelete('cascade');
            $table->foreignId('inventorie_id')->constrained()->onDelete('cascade');
            $table->INTEGER('amount');
            $table->integer('worth');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_movements');
    }
}
