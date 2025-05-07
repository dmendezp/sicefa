<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeding', function (Blueprint $table) {
            $table->id('id_feeding');
            $table->foreignId('pig_id')->nullable()->constrained('pigs', 'id_pig')->onDelete('set null');
            $table->foreignId('lot_id')->nullable()->constrained('lots', 'id_lot')->onDelete('set null');
            $table->foreignId('diet_id')->constrained('diets', 'id_diet')->onDelete('cascade');
            $table->date('feeding_date')->nullable(false);
            $table->decimal('food_amount', 6, 2)->nullable(false);
            $table->decimal('fcr', 5, 2)->nullable();
            $table->foreignId('cost_id')->constrained('operational_costs', 'id_cost')->onDelete('cascade');
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
        Schema::dropIfExists('feeding');
    }
}
