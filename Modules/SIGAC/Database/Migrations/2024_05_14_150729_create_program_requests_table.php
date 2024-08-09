<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained()->onDelete('cascade');
            $table->foreignId('program_id')->constrained()->onDelete('cascade');
            $table->foreignId('special_program_id')->constrained()->onDelete('cascade');
            $table->foreignId('municipality_id')->constrained()->onDelete('cascade');
            $table->integer('hours');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('quotas');
            $table->string('address')->nullable();
            $table->text('observation')->nullable();
            $table->string('empresa')->nullable();
            $table->string('applicant')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('telephone')->nullable();
            $table->date('date_characterization')->nullable();
            $table->integer('code_empresa')->nullable();
            $table->integer('code_course')->nullable();
            $table->date('date_inscription')->nullable();
            $table->enum('state',['Confirmado','Pendiente','Cancelado']);
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
        Schema::dropIfExists('program_requests');
    }
}
