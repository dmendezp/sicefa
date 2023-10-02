<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesSenaempresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files_senaempresa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('postulate_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('cv_score');
            $table->unsignedInteger('personalities_score');
            $table->unsignedInteger('proposal_score');
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
        Schema::dropIfExists('files_senaempresa');
    }
}
