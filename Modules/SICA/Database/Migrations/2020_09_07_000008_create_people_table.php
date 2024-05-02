<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->enum('document_type', [
                'Cédula de ciudadanía',
                'Tarjeta de identidad',
                'Cédula de extranjería',
                'Pasaporte',
                'Documento nacional de identidad',
                'Registro civil',
                'Número de Identificación Tributaria'
            ]);
            $table->unsignedBigInteger('document_number')->unique();
            $table->date('date_of_issue')->nullable();
            $table->string('first_name');
            $table->string('first_last_name');
            $table->string('second_last_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('blood_type',[
                'No registra',
                'O+',
                'O-',
                'A+',
                'A-',
                'B+',
                'B-',
                'AB+',
                'AB-'
            ])->nullable();
            $table->enum('gender', [
                'No registra',
                'Masculino',
                'Femenino'
            ])->nullable();
            $table->foreignId('eps_id')->constrained('e_p_s')->onDelete('cascade');
            $table->enum('marital_status', [
                'No registra',
                'Soltero(a)',
                'Casado(a)',
                'Separado(a)',
                'Unión libre'
            ])->nullable();
            $table->unsignedInteger('military_card')->nullable();
            $table->enum('socioeconomical_status', [
                'No registra',
                '1',
                '2',
                '3',
                '4',
                '5',
                '6'
            ])->nullable();
            $table->enum('sisben_level', ['A','B','C','D'])->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('telephone1')->nullable();
            $table->unsignedBigInteger('telephone2')->nullable();
            $table->unsignedBigInteger('telephone3')->nullable();
            $table->string('personal_email')->nullable();
            $table->string('misena_email')->nullable();
            $table->string('sena_email')->nullable();
            $table->string('avatar')->nullable();
            $table->text('biometric_code')->nullable();
            $table->foreignId('population_group_id')->constrained()->onDelete('cascade');
            $table->foreignId('pension_entity_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('people');
    }
}
