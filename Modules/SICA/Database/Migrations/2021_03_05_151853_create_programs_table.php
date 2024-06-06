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
            $table->unsignedInteger('sofia_code');
            $table->integer('version');
            $table->enum('training_type',['Complementaria','Titulada','Sin especificar'])->default('Sin especificar');
            $table->string('name');
            $table->integer('quarter_number');
            $table->foreignId('knowledge_network_id')->constrained()->onDelete('cascade');
            $table->enum('program_type', ['Auxiliar','Complementaria virtual','Curso especial','Especialización tecnologica','Operario','Profundización técnica','Técnico','Tecnólogo','Sin especificar'])->default('Sin especificar');
            $table->integer('maximum_duration');
            $table->enum('modality',['A Distancia','A Distancia/Presencial','Presencial','Virtual','Virtual/Presencial','Sin especificar'])->default('Sin especificar');
            $table->enum('priority_bets',['Apuesta del sector','CampeSENA','Economia popular','Fortalecimiento en programas TIC','Transición energetica','Sin especificar'])->default('Sin especificar');
            $table->enum('fic',['Si','No'])->default('No');
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