<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Petitions', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_date', 0);
            $table->dateTime('end_date', 0);
            $table->foreignId('munincipality_id')->constrained('municipalities')->nullable()->change();
            $table->string('reason');
            $table->number('numstudents');
            $table->foreignId('asigned_vehicle_id')->constrained('vehicles')->nullable()->change();
            $table->timestamps();
            $table->softDeletes;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Petitions');
    }
}
