<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolsSiporkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tools_sipork', function (Blueprint $table) {
            $table->id('id_tool');
            $table->string('tool_name', 50)->nullable(false);
            $table->integer('quantity')->nullable(false);
            $table->date('purchase_date')->nullable(false);
            $table->decimal('unit_cost', 10, 2)->nullable(false);
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
        Schema::dropIfExists('tools_sipork');
    }
}
