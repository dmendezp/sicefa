<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('Contract_number');
            $table->date('Contract_date');
            $table->string('Professional_card');
            $table->date('professional_card_issuance_date');
            $table->string('pension fund');
            $table->foreignId('employee_type_id')->constrained()->ondelete('cascade');
            $table->foreignId('Function_id')->constrained()->ondelete('cascade');
            $table->enum('state',['Activo','Inactivo']);
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
        Schema::dropIfExists('employees');
    }
}
