<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSanitaryOutbreaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanitary_outbreaks', function (Blueprint $table) {
            $table->id('id_outbreak');
            $table->date('start_date')->nullable(false);
            $table->date('end_date')->nullable();
            $table->string('disease', 50)->nullable(false);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('sanitary_outbreaks');
    }
}
