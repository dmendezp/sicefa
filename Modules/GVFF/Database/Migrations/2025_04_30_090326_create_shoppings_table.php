<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoppings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('admin_id')->nullable(false);
            $table->unsignedBigInteger('plant_id')->nullable(false);
            $table->integer('quantity')->nullable(false);
            $table->timestamp('purchase_date')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->decimal('total', 10, 2)->nullable(false);
            $table->enum('status', ['pending', 'completed'])->nullable(false)->default('pending');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('admin_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->name('shoppings_admin_id_foreign');

            $table->foreign('plant_id')
                  ->references('id')
                  ->on('plants')
                  ->onDelete('cascade')
                  ->name('shoppings_plant_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shoppings');
    }
}