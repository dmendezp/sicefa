<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthRecordsCattleRaisingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_records_cattle_raising', function (Blueprint $table) {
            $table->id();
            $table->string('animal_id', 50);
            $table->date('record_date');
            $table->text('symptoms')->nullable();
            $table->decimal('temperature', 4, 2)->nullable(); // e.g., 38.5
            $table->integer('heart_rate')->nullable();       // BPM
            $table->integer('respiratory_rate')->nullable(); // RPM
            $table->string('ruminal_movements', 100)->nullable(); // e.g., "Normal", "Lento"
            $table->string('fecal_consistency', 100)->nullable(); // e.g., "Normal", "Diarrea"
            $table->string('urine_description', 100)->nullable(); // e.g., "Clara", "Oscura"
            $table->text('diagnosis')->nullable();
            $table->string('veterinarian', 100)->nullable();
            $table->string('responsible', 100)->nullable();
            $table->text('observations')->nullable();
            $table->timestamps();

            // Clave foránea hacia animals.id
            $table->foreign('animal_id')
                  ->references('id')
                  ->on('animals')
                  ->onDelete('cascade');

            // Índices para rendimiento
            $table->index('record_date');
            $table->index('animal_id');
            $table->index(['animal_id', 'record_date']); // Útil para consultas por animal + fecha
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('health_records_cattle_raising');
    }
}