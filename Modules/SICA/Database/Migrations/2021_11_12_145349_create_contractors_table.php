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
            $table->date('contract_start_date');
            $table->date('contract_end_date');
            $table->integer('total_contract_value');
            $table->foreignId('contractor_type_id')->constrained()->onDelete('cascade');
            $table->string('sesion')->nullable();
            $table->date('sesion_date')->nullable();
            $table->foreignId('employee_type_id')->constrained()->onDelete('cascade');
            $table->string('SIIF_code');
            $table->string('health_entity');
            $table->string('pension_entity');
            $table->string('insurer_entity');
            $table->string('policy_number');
            $table->date('policy_issue_date');
            $table->date('policy_approval_date');
            $table->date('policy_effective_date');
            $table->date('policy_expiration_date');
            $table->string('risk_type',5);
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
