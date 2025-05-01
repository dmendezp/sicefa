<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvironments1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('environments1', function (Blueprint $table) {
            $table->id(); // id (primary key, auto increment)
            $table->string('name', 100); // name
            $table->integer('capacity'); // capacity
            $table->string('location', 100); // location
            $table->string('description', 255)->nullable(); // description
            $table->enum('status', ['Disponible', 'No Disponible'])->default('Disponible'); // status
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('environments1');
    }
    
}