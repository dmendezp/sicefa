<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBirthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('births', function (Blueprint $table) {
            $table->id();
            $table->string('animal_id', 50);
            $table->date('insemination_date')->nullable();
            $table->string('bull_id', 50)->nullable();
            $table->date('palpation_date')->nullable();
            $table->integer('gestation_days')->nullable();
            $table->string('diagnosis_note', 100)->nullable();
            $table->date('expected_birth_date')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('calf_sex', ['MALE', 'FEMALE'])->nullable();
            $table->string('calf_id', 50)->nullable();
            $table->text('observations')->nullable();
            $table->timestamps();

            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
            $table->foreign('bull_id')->references('id')->on('animals')->nullOnDelete();
            $table->foreign('calf_id')->references('id')->on('animals')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('births');
    }
}