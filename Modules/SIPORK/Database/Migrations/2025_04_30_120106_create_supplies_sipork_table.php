<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliesSiporkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplies_sipork', function (Blueprint $table) {
            $table->id('id_supply');
            $table->string('supply_name', 50)->nullable(false);
            $table->string('supply_type', 20)->nullable(false);
            $table->decimal('quantity', 10, 2)->nullable(false);
            $table->decimal('unit_cost', 10, 2)->nullable(false);
            $table->date('entry_date')->nullable(false);
            $table->foreignId('warehouse_id')->constrained('warehouses_sipork', 'id_warehouse')->onDelete('cascade');
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
        Schema::dropIfExists('supplies_sipork');
    }
}
