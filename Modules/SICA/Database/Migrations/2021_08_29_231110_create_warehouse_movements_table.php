<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('productive_unit_warehouse_id')->constrained()->onDelete('cascade');
            $table->foreignId('movement_id')->constrained()->onDelete('cascade');
            $table->enum('role',['Entrega','Recibe']);
            $table->softDeletes();
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('warehouse_movements');
    }
}
