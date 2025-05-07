<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_records', function (Blueprint $table) {
            $table->id('id_health');
            $table->foreignId('pig_id')->constrained('pigs', 'id_pig')->onDelete('cascade');
            $table->string('record_type', 20)->nullable(false);
            $table->text('description')->nullable();
            $table->date('application_date')->nullable(false);
            $table->foreignId('cost_id')->constrained('operational_costs', 'id_cost')->onDelete('cascade');
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
        Schema::dropIfExists('health_records');
    }
}
