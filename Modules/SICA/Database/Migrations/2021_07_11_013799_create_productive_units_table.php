<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductiveUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productive_units',  function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('person_id')->constrained()->ondelete('cascade');
            $table->text('description');
            $table->foreignId('sector_id')->constrained()->ondelete('cascade');
            $table->string('icon')->nullable();
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
        Schema::dropIfExists('productive_units');
    }
}
