<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreatmentCattleRaisingHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatment_cattle_raising_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('treatment_id');
            $table->unsignedBigInteger('health_record_id');
            $table->json('snapshot')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();

            $table->foreign('treatment_id')
                  ->references('id')
                  ->on('treatments_cattle_raising')
                  ->onDelete('cascade');

            $table->foreign('health_record_id')
                  ->references('id')
                  ->on('health_records_cattle_raising')
                  ->onDelete('cascade');

            $table->index('health_record_id');
            $table->index('treatment_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('treatment_cattle_raising_histories');
    }
}
