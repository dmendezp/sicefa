<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreatmentsCattleRaisingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatments_cattle_raising', function (Blueprint $table) {
            $table->id();
            $table->foreignId('health_record_id')
                  ->constrained('health_records_cattle_raising')
                  ->cascadeOnDelete();  // Si se elimina la historia clínica, se eliminan los tratamientos asociados

            $table->date('treatment_date');  // Fecha en que se aplicó el tratamiento

            $table->foreignId('medicine_id')
                  ->nullable()
                  ->constrained('medicines')
                  ->nullOnDelete();  // Si se elimina el medicamento, el tratamiento queda sin referencia

            $table->string('dose', 50)->nullable();               // Dosis (ej: 10ml, 5g)
            $table->string('administration_route', 50)->nullable(); // Vía de administración (ej: Intramuscular, Oral)
            $table->string('frequency', 100)->nullable();         // Frecuencia (ej: Cada 24h, 3 días seguidos)
            $table->text('observations')->nullable();             // Notas adicionales

            $table->timestamps();

            // Índices para rendimiento
            $table->index('health_record_id');
            $table->index('treatment_date');
            $table->index('medicine_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treatments_cattle_raising');
    }
}