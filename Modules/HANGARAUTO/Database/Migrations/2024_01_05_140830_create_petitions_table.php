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
        Schema::create('petitions', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_date', 0);
            $table->dateTime('end_date', 0);
            $table->foreignId('municipality_id')->constrained()->onDelete('cascade');
            $table->string('reason');
            $table->string('numstudents');
            $table->foreignId('vehicle_type_id')->constrained()->onDelete('cascade');
            $table->enum('status',['Solicitud','Asignado','Aprobado','Denegado']);
            $table->foreignId('person_id')->constrained()->onDelete('cascade');
            $table->string('observation')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('petitions');
    }
}
