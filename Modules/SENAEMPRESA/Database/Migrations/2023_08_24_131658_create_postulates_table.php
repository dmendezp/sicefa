<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostulatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postulates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apprentice_id')->constrained()->onDelete('cascade');
            $table->foreignId('vacancy_id')->constrained()->onDelete('cascade');
            $table->enum('state', [
                'Seleccionado',
                'No Seleccionado',
                'Inscrito'
            ])->nullable();
            $table->binary('cv');
            $table->binary('personalities');
            $table->binary('proposal');
            $table->binary('employment_certificate');
            $table->unsignedInteger('score_total')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postulates');
    }
}
