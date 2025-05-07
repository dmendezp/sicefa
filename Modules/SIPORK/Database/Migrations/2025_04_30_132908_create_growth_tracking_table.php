<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrowthTrackingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('growth_tracking', function (Blueprint $table) {
            $table->id('id_tracking');
            $table->foreignId('pig_id')->constrained('pigs', 'id_pig')->onDelete('cascade');
            $table->date('measurement_date')->nullable(false);
            $table->decimal('weight', 6, 2)->nullable(false);
            $table->text('observations')->nullable();
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
        Schema::dropIfExists('growth_tracking');
    }
}
