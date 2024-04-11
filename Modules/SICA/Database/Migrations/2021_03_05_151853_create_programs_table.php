<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('quarter_number');
            $table->foreignId('network_id')->constrained()->onDelete('cascade');
            $table->enum('program_type', ['Tecnólogo','Técnico','Operario','Sin especificar']);
            $table->unsignedInteger('sofia_code');
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['name', 'sofia_code']); // Generar llave única entre la columnas name y sofia_code
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
        Schema::dropIfExists('programs');
    }
}