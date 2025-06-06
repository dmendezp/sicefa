<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprenticeNoveltiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apprentice_novelties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apprentice_id')->constrained()->onDelete('cascade');
            $table->foreignId('person_id')->constrained()->onDelete('cascade');
            $table->foreignId('missing_committee_id')->constrained()->onDelete('cascade');
            $table->enum('type',['Academica','Disciplinaria']);
            $table->text('observation');
            $table->enum('state',['Pendiente','Plan Mejoramiento','Resuelta']);
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
        Schema::dropIfExists('apprentice_novelties');
    }
}
