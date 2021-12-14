<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsibilitiesMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsibilities__movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('people_id')->constrained()->onDelete('cascade');
            $table->foreignId('movement_id')->constrained()->onDelete('cascade');
            $table->enum('rol',['vendedor', 'comprador', 'saliente', 'entrega', 'recibe', 'autoriza', 'cuentadante', 'vigilanciaSalida', 'vigilanciaEntrada']);
            $table->datetime('date');
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
        Schema::dropIfExists('responsibilities__movements');
    }
}
