<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiosecurityMeasuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biosecurity_measures', function (Blueprint $table) {
            $table->id('id_biosecurity');
            $table->string('measure_type', 50)->nullable(false);
            $table->date('implementation_date')->nullable(false);
            $table->text('description')->nullable();
            $table->foreignId('cost_id')->constrained('operational_costs', 'id_cost')->onDelete('cascade');
            $table->foreignId('lot_id')->constrained('lots', 'id_lot')->onDelete('cascade');
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
        Schema::dropIfExists('biosecurity_measures');
    }
}
