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
            $table->foreignId('user_id')->constrained('users')->onDelete('set null'); 
            $table->string('name'); 
            $table->string('imagen_evento')->nullable(); // Ruta de la imagen del evento
            $table->string('location')->nullable(); 
            $table->date('start_date'); 
            $table->date('end_date'); 
            $table->string('organizer')->nullable(); 
            $table->string('contact_email'); 
            $table->string('contact_phone')->nullable(); 
            $table->enum('status', ['scheduled', 'ongoing', 'completed', 'cancelled'])->default('scheduled'); 
            $table->timestamps(); 
            $table->softDeletes(); 
            $table->index(['user_id', 'start_date']);
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
