<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExecutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('executors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('labor_id')->constrained()->onDelete('cascade');
            $table->foreignId('person_id')->constrained()->onDelete('cascade');
            $table->foreignId('employement_type_id')->constrained()->onDelete('cascade');
            $table->integer('amount');
            $table->integer('price');
            $table->sofDeletes();
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
        Schema::dropIfExists('executors');
    }
}
