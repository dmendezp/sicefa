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
            $table->date('date');
            $table->decimal('initial_balance', 8, 2);
            $table->decimal('final_balance', 8, 2);
            $table->decimal('difference', 8, 2)->nullable();
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
