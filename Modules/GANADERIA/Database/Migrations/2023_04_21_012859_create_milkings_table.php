<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMilkingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milkings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('productive_proces_id')->constrained()->onDelete('cascade');
            $table->string('responsible');
            $table->string('amount');
            $table->string('price');
            $table->softDeletes();
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
        Schema::dropIfExists('milkings');
    }
}
