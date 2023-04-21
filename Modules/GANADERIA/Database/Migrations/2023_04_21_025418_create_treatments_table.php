<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('productive_proces_id')->constrained()->onDelete('cascade');
            $table->foreignId('inventories_id')->constrained()->onDelete('cascade');
            /* $table->foreignId('code_id')->constrained()->onDelete('cascade'); */
            $table->date('date_treatment')->nullable();
            $table->string('dose');
            $table->string('name_medicine');
            $table->string('via_administration');
            $table->string('observations');
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
        Schema::dropIfExists('treatments');
    }
}
