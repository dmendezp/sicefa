<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthRecordCattleRaisingHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_record_cattle_raising_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('health_record_id');
            $table->string('animal_id', 50);
            $table->json('snapshot')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();

            $table->foreign('health_record_id')
                  ->references('id')
                  ->on('health_records_cattle_raising')
                  ->onDelete('cascade');

            $table->index('animal_id');
            $table->index('health_record_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('health_record_cattle_raising_histories');
    }
}
