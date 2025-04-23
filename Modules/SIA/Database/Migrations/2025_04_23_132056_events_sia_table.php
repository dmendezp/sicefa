<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsSiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_sia', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del evento
            $table->text('description')->nullable(); // Descripción del evento
            $table->string('location'); // Ubicación del evento
            $table->date('start_date'); // Fecha de inicio del evento
            $table->date('end_date')->nullable(); // Fecha de finalización del evento
            $table->string('organizer')->nullable(); // Organizador del evento
            $table->string('contact_email')->nullable(); // Correo de contacto
            $table->string('contact_phone')->nullable(); // Teléfono de contacto
            $table->enum('status', ['scheduled', 'ongoing', 'completed', 'cancelled'])->default('scheduled'); // Estado del evento
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events_sia');
    }
}
