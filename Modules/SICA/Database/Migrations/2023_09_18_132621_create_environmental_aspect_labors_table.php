<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvironmentalAspectLaborsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('environmental_aspect_labors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('environmental_aspect_id')->constrained()->onDelete('cascade');
            $table->foreignId('labor_id')->constrained()->onDelete('cascade');
            $table->integer('amount');
            $table->integer('price');
            $table->softDeletes();
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('environmental_aspect_labors');
    }
}
