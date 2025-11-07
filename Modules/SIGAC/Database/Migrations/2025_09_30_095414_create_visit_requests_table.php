<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('visit_requests', function (Blueprint $table) {
            $table->id();

            // Relaciones
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('person_id')->constrained('people');
            $table->foreignId('user_id')->constrained('users');

            // Fechas
            $table->date('date_received')->nullable();
            $table->date('response_date')->nullable();

            // Medio de respuesta
            $table->string('response_method')->nullable();

            // Estado: Sin agendar / Agendada / Rechazada / etc.
            $table->string('state')->default('Sin agendar');

            // Información de la visita
            $table->integer('number_of_people')->nullable();
            $table->string('people_list_path')->nullable(); // Ruta de Excel (personas)

            // ✅ Nuevos campos de contacto directo
            $table->string('contact_name', 120)->nullable();
            $table->string('contact_phone', 30)->nullable();
            $table->string('contact_email', 160)->nullable();

            // ✅ Tipo de solicitud: visita o práctica
            $table->string('type', 15)->default('visita'); // 'visita' o 'practica'

            // ✅ Si es práctica: descripción de requerimientos
            $table->text('practice_requirements')->nullable();

            // Observaciones adicionales
            $table->text('observations')->nullable();

            $table->timestamps();

            // ❌ Eliminado: documento adjunto
            // $table->text('attachments_path')->nullable(); // Ya no se usa
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('visit_requests');
    }
};
