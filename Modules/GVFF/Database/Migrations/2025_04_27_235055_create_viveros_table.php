<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViverosTable extends Migration
{
    public function up()
    {
        Schema::create('viveros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 255)->nullable(false);
            $table->string('ubicacion', 255)->nullable(false);
            $table->integer('capacidad_maxima')->nullable(false);
            $table->enum('clasificacion', ['publico', 'privado'])->nullable(false);
            $table->text('descripcion')->nullable();
            $table->string('imagen', 255)->nullable();
            $table->timestamp('creado_en')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('actualizado_en')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'))->onUpdate(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('viveros');
    }
}