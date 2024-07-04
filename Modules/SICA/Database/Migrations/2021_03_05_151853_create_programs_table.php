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
            $table->enum('training_type',['Sin especificar','Complementaria','Titulada'])->default('Sin especificar');
            $table->string('name');
            $table->integer('quarter_number');
            $table->foreignId('knowledge_network_id')->constrained()->onDelete('cascade');
            $table->enum('program_type', ['Sin especificar','Auxiliar','Complementaria virtual','Curso especial','Especialización tecnologica','Operario','Profundización técnica','Técnico','Tecnólogo'])->default('Sin especificar');
            $table->integer('maximum_duration');
            $table->enum('modality',['Sin especificar','A Distancia','A Distancia/Presencial','Presencial','Virtual','Virtual/Presencial'])->default('Sin especificar');
            $table->enum('priority_bets',['Sin especificar','Apuesta del sector','CampeSENA','Economia popular','Fortalecimiento en programas TIC','Transición energetica'])->default('Sin especificar');
            $table->enum('fic',['No','Si'])->default('No');
            $table->integer('months_lectiva')->default(0);
            $table->integer('months_productiva')->default(0);
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['sofia_code']); // Generar llave única entre la columnas name y sofia_code
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