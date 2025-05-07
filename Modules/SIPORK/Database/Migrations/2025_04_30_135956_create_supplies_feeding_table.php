<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliesFeedingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplies_feeding', function (Blueprint $table) {
            $table->id('id_supply_feeding');
            $table->foreignId('feeding_id')->constrained('feeding', 'id_feeding')->onDelete('cascade');
            $table->foreignId('supply_id')->constrained('supplies_sipork', 'id_supply')->onDelete('cascade');
            $table->decimal('quantity_used', 10, 2)->nullable(false);
            $table->date('usage_date')->nullable(false);
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
        Schema::dropIfExists('supplies_feeding');
    }
}
