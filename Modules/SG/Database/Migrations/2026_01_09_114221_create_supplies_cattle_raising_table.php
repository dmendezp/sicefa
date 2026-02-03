<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliesCattleRaisingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplies_cattle_raising', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('name', 150);
            $table->enum('type', ['MEDICINE', 'VACCINE', 'FEED', 'SUPPLEMENT', 'OTHER']);
            $table->enum('unit', ['ml', 'cm³', 'g', 'kg', 'units', 'liters'])->default('ml');
            $table->string('presentation', 100)->nullable();
            $table->decimal('current_stock', 10, 3)->default(0);
            $table->decimal('minimum_stock', 10, 3)->default(0);
            $table->decimal('unit_price', 12, 2)->nullable();
            $table->string('supplier', 150)->nullable();
            $table->date('expiration_date')->nullable();
            $table->string('batch_number', 100)->nullable();
            $table->text('observations')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('name');
            $table->index('type');
            $table->index('current_stock');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplies_cattle_raising');
    }
}