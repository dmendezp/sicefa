<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePqrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pqrs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_pqrs_id')->constrained()->onDelete('cascade');
            $table->integer('filing_number');
            $table->date('filing_date');
            $table->unsignedInteger('nis');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('issue');
            $table->enum('state', ['ARCHIVADO', 'EN PROCESO', 'PROXIMO A VENCER', 'RESPUESTA GENERADA', 'RESPUESTA PARCIAL'])->default('EN PROCESO');
            $table->text('answer')->nullable();
            $table->integer('filed_response')->nullable();
            $table->date('response_date')->nullable();
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
        Schema::dropIfExists('pqrs');
    }
}
