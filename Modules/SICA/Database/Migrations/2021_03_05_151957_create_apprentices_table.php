<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprenticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apprentices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->enum('apprentice_status', ['NO REGISTRA','CERTIFICADO','EN FORMACIÓN','RETIRO VOLUNTARIO','CANCELADO','TRASLADADO','APLAZADO','INDUCCIÓN','CONDICIONADO']);
            $table->string('guardian')->nullable();
            $table->unsignedInteger('guardian_telephone')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['person_id', 'course_id']); // Generar llave única entre la columnas person_id y course_id
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
        Schema::dropIfExists('apprentices');
    }
}
