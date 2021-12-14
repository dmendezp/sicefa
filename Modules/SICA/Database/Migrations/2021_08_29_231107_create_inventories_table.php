<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('people_id')->constrained()->onDelete('cascade');
            $table->foreignId('warehouse_id')->constrained()->onDelete('cascade');
            $table->foreignId('element_id')->constrained()->onDelete('cascade');
            $table->text('description');
            $table->integer('value');
            $table->integer('amount');
            $table->integer('stock');
            $table->date('produton_date');
            $table->integer('lot_number');
            $table->date('expiration_date');
            $table->enum('state',['available','disabled']);
            $table->string('mark');
            $table->unsignedInteger('inventoryCode');
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
        Schema::dropIfExists('inventories');
    }
}
