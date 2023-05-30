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
            $table->foreignId('person_id')->constrained()->onDelete('cascade');
            $table->dateTime('date');
            $table->decimal('initial_balance', 10, 2);
            $table->decimal('final_balance', 10, 2);
            $table->decimal('difference', 10, 2)->nullable();
            $table->enum('state', ['Abierta', 'Cerrada'])->default('Abierta'); // Por defecto estara la caja en estado abierta.
            $table->timestamps();
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
