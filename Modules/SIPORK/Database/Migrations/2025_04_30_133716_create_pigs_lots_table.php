<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePigsLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pigs_lots', function (Blueprint $table) {
            $table->foreignId('pig_id')->constrained('pigs', 'id_pig')->onDelete('cascade');
            $table->foreignId('lot_id')->constrained('lots', 'id_lot')->onDelete('cascade');
            $table->date('entry_date')->nullable(false);
            $table->date('exit_date')->nullable();
            $table->primary(['pig_id', 'lot_id']);
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
        Schema::dropIfExists('pigs_lots');
    }
}
