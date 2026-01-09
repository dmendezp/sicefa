<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolsCattleRaisingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tools_cattle_raising', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->string('name', 150);
            $table->enum('type', ['SCALE', 'EAR_TAG', 'SYRINGE', 'THERMOMETER', 'OTHER']);
            $table->string('brand', 100)->nullable();
            $table->string('model', 100)->nullable();
            $table->string('serial_number', 100)->nullable();
            $table->enum('status', ['OPERATIONAL', 'MAINTENANCE', 'DAMAGED', 'OUT_OF_SERVICE'])->default('OPERATIONAL');
            $table->string('location', 100)->nullable();
            $table->date('acquisition_date')->nullable();
            $table->decimal('purchase_value', 12, 2)->nullable();
            $table->string('current_responsible', 100)->nullable();
            $table->text('observations')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('name');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tools_cattle_raising');
    }
}
