<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMortalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mortalities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('productive_proces_id')->constrained()->onDelete('cascade');
            $table->foreignId('inventories_id')->constrained()->onDelete('cascade');
            $table->date('date_mortalite')->nullable();
            $table->string('responsible');
            $table->string('observations');
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
        Schema::dropIfExists('mortalities');
    }
}
