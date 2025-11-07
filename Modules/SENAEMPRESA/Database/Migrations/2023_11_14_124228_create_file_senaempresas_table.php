<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileSenaempresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_senaempresas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('postulate_id')->constrained()->onDelete('cascade');
            $table->foreignId('vacancy_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('cv_score')->nullable();
            $table->unsignedInteger('personalities_score')->nullable();
            $table->unsignedInteger('interview_admin')->nullable();
            $table->unsignedInteger('interview_psychologo')->nullable();
            $table->unsignedInteger('proposal_score')->nullable();
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
        Schema::dropIfExists('file_senaempresas');
    }
}
