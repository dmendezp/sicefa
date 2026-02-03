<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInseminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inseminations', function (Blueprint $table) {
            $table->id();
            $table->string('animal_id', 50);
            $table->date('insemination_date');
            $table->string('straw_code', 100)->nullable();
            $table->string('bull_id', 50)->nullable();
            $table->string('bull_name', 100)->nullable();
            $table->string('technician', 100)->nullable();
            $table->enum('method', ['AI', 'ET', 'NM'])->default('AI');
            $table->text('observations')->nullable();
            $table->enum('palpation_result', ['POSITIVE', 'NEGATIVE', 'PENDING'])->default('PENDING');
            $table->date('palpation_date')->nullable();
            $table->integer('gestation_days')->nullable();
            $table->date('expected_birth_date')->nullable();
            $table->timestamps();

            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
            $table->foreign('bull_id')->references('id')->on('animals')->nullOnDelete();
            $table->index('insemination_date');
            $table->index('animal_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inseminations');
    }
}