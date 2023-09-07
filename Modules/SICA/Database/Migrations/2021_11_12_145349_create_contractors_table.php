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
            $table->foreignId('person_id')->constrained()->onDelete('cascade');
            $table->foreignId('supervisor_id')->constrained('people')->onDelete('cascade');
            $table->integer('contract_number');
            $table->year('contract_year');
            $table->date('contract_start_date');
            $table->date('contract_end_date');
            $table->integer('total_contract_value');
            $table->foreignId('contractor_type_id')->constrained()->onDelete('cascade');
            $table->longText('contract_object');
            $table->longText('contract_obligations');
            $table->integer('amount_hours');
            $table->integer('assigment_value');
            $table->string('sesion')->nullable();
            $table->date('sesion_date')->nullable();
            $table->foreignId('employee_type_id')->constrained()->onDelete('cascade');
            $table->string('SIIF_code');
            $table->foreignId('insurer_entity_id')->constrained()->onDelete('cascade');
            $table->string('policy_number');
            $table->date('policy_issue_date');
            $table->date('policy_approval_date');
            $table->date('policy_effective_date');
            $table->date('policy_expiration_date');
            $table->enum('risk_type', ['I','II','III','IV','V']);
            $table->enum('state', ['Activo','Inactivo']);
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
