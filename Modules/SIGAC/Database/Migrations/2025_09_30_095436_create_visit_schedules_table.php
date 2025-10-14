<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visit_schedules', function (Blueprint $table) {
            $table->id();

            // Relación con la solicitud de visita
            $table->foreignId('visit_request_id')
                ->constrained('visit_requests')
                ->cascadeOnDelete();

            // Persona a cargo (responsable)
            $table->foreignId('person_in_charge_id')
                ->nullable()
                ->constrained('people')
                ->nullOnDelete();

            // 👇 SIN ->after(): el orden lo da esta posición
            $table->string('notification_email')->nullable();

            // Actividad / fecha / horas
            $table->string('activity');
            $table->date('date')->nullable();
            $table->time('start_time');
            $table->time('end_time');

            // Ambiente asignado
            $table->foreignId('environment_id')
                ->nullable()
                ->constrained('environments')
                ->nullOnDelete();

            // Observaciones
            $table->text('observations')->nullable();

            $table->timestamps();

            // Índices prácticos
            $table->index(['date', 'person_in_charge_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visit_schedules');
    }
};
