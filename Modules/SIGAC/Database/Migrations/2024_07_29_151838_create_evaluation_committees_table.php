<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationCommitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_committees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apprentice_novelty_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('state',['Programado','Concluido']);
            $table->text('answer')->nullable();
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
        Schema::dropIfExists('evaluation_committees');
    }
}
