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
            $table->unsignedInteger('cv_score')->default(0);
            $table->unsignedInteger('personalities_score')->default(0);
            $table->unsignedInteger('proposal_score')->default(0);
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
