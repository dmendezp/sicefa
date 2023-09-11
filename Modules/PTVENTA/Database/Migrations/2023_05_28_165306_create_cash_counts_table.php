<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_counts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained()->onDelete('cascade'); //Trae el usuario administrador que abre la caja.
            $table->foreignId('productive_unit_warehouse_id')->constrained()->onDelete('cascade'); // Trae la unidad y bodega a la que esta asociada la caja.
            $table->dateTime('opening_date'); // Genera la fecha de apertura.
            $table->decimal('initial_balance', 10, 2); // Genera el saldo inicial.
            $table->decimal('final_balance', 10, 2)->nullable(); // Genera el saldo final.
            $table->dateTime('closing_date')->nullable(); // Genera la fecha de cierre de caja.
            $table->decimal('total_sales', 10, 2)->nullable(); // Acumulador del total de ventas.
            $table->enum('state', ['Abierta', 'Cerrada'])->default('Abierta'); // Por defecto estara la caja en estado abierta.
            $table->timestamps(); //Genera los campos de creacion y modificacion.
            $table->softDeletes(); // Add soft delete column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_counts');
    }
}
