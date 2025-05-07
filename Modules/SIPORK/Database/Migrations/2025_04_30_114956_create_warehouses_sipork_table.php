<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehousesSiporkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouses_sipork', function (Blueprint $table) {
            $table->id('id_warehouse');
            $table->string('warehouse_name', 50)->nullable(false);
            $table->string('location', 100)->nullable(false);
            $table->decimal('capacity', 10, 2)->nullable(false);
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
        Schema::dropIfExists('warehouses_sipork');
    }
}
