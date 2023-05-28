<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArqueosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arqueos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->decimal('saldo_inicial', 8, 2);
            $table->decimal('saldo_final', 8, 2);
            $table->decimal('diferencia', 8, 2)->nullable();
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
        Schema::dropIfExists('arqueos');
    }
}

