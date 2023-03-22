<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('functions', function (Blueprint $table) {
            $table->id();
            $table->enum('professional denomination',['profecional', 'asesor', 'directivo', 'tecnico', 'instructor', 'asistencial']);
            $table->enum('grade', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20']);
            $table->softDeletes();
            $table->timestamps();
        });
    }
// normograma salarial nivel denominacionde de empleo
//             grado tipo enum   denominacion profecional aseceso directovi tecnico instructor asistencial /grado  1 -20

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('functions');
    }
}
