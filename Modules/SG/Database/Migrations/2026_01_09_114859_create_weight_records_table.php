<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeightRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weight_records', function (Blueprint $table) {
            $table->id();
            $table->string('animal_id', 50);
            $table->date('weigh_date');
            $table->decimal('weight_kg', 8, 2);
            $table->string('body_condition_score', 50)->nullable();
            $table->text('observations')->nullable();
            $table->timestamps();

            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
            $table->index('weigh_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weight_records');
    }
}