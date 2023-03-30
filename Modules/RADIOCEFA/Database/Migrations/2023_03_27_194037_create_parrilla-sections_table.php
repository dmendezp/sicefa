<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParrillaSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parrilla-sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parrilla_id')->constrained()->onDelete('cascade');
            $table->foreignId('sections_id')->constrained()->onDelete('cascade');
            $table->dateTime('fecha');
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
        Schema::dropIfExists('parrilla-sections');
    }
}
