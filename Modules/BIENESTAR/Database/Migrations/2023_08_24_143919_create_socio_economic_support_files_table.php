<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;


class CreateSocioEconomicSupportFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socio_economic_support_files', function (Blueprint $table) {
            $table->id();
            $table->string('file_path'); 
            $table->unsignedBigInteger('postulation_id');
            $table->timestamps();
            $table->foreign('postulation_id')->references('id')->on('postulations');
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('socio_economic_support_files');
    }
}
