<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventSiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_sias', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('event_image')->nullable();
            $table->string('location');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('organizer');
            $table->string('contact_email');
            $table->string('contact_phone')->nullable();
            $table->enum('status', ['Programado', 'Completado', 'Cancelado'])->default('Programado');
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
        Schema::dropIfExists('event_sias');
    }
}
