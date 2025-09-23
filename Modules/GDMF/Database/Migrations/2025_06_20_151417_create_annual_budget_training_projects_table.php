<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnualBudgetTrainingProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annual_budget_training_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('annual_budget_id')->constrained()->onDelete('cascade');
            $table->foreignId('training_project_id')->constrained()->onDelete('cascade');
            $table->decimal('budget_total', 15);
            $table->decimal('budget_current', 15);
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
        Schema::dropIfExists('annual_budget_training_projects');
    }
}
