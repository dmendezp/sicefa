<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffSenaempresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_senaempresas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('position_company_id')->constrained()->onDelete('cascade');
            $table->foreignId('apprentice_id')->constrained()->onDelete('cascade');
            $table->foreignId('senaempresa_id')->constrained()->onDelete('cascade');
            $table->string('image');
            $table->time('duration_total')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff_senaempresas');
    }
}
