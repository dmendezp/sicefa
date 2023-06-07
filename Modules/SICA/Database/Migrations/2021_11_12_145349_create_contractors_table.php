<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contractors', function (Blueprint $table) {
            $table->id();
            $table->integer('Contract_number');
            $table->date('Contract_start_date');
            $table->date('Contract_end_date');
            $table->integer('Total_contract_value');
            $table->foreignId('type_of_contractor')->constrained()->ondelete('cascade');
            $table->string('sesion');
            $table->date('sesion_date');
            $table->foreignId('employee_type_id')->constrained()->ondelete('cascade');
            $table->string('CIF');
            $table->string('Health_entity');
            $table->string('Pension_entity');
            $table->string('Insurer');
            $table->string('Policy_number');
            $table->date('Policy_issue_date');
            $table->date('Policy_approval_date');
            $table->date('Policy_effective_date');
            $table->date('Policy_expiration_date');
            $table->string('type_of_risk');
            $table->enum('state',['Activo','inactivo']);
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
        Schema::dropIfExists('contractors');
    }
}
