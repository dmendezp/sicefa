<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionValidateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_validations', function (Blueprint $table) {
            $table->id();

            // 🔗 Relación con el permiso del aprendiz
            $table->unsignedBigInteger('apprentice_permission_id');
            $table->foreign('apprentice_permission_id')
                ->references('id')
                ->on('apprentice_permissions')
                ->onDelete('cascade');

            // 👤 Persona que valida
            $table->unsignedBigInteger('validated_by')->nullable();
            $table->foreign('validated_by')
                ->references('id')
                ->on('people')
                ->onDelete('set null');

            // 🧩 Rol que valida (nombres reales del sistema)
            $table->enum('validator_role', [
                'Tutor',
                'Instructor',
                'Bienestar',
                'Coordinador Académico'
            ]);

            // 📋 Estado de la validación
            $table->enum('validation_status', ['approved', 'rejected', 'earring'])->default('earring');

            // 📝 Observación u observaciones
            $table->text('observation')->nullable();

            // 🕒 Fecha de validación
            $table->timestamp('validated_at')->nullable();

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
        // ❗ Aquí el nombre debe coincidir con el creado arriba
        Schema::dropIfExists('permission_validations');
    }
}
