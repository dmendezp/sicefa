<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonPqrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_pqrs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time');
            $table->enum('type', ['Funcionario', 'Apoyo']);
            $table->foreignId('person_id')->constrained()->onDelete('cascade');
            $table->foreignId('pqrs_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('person_pqrs');
    }
}
