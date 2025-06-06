<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissingCommitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missing_committees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type',['Leve','Grave','Gravisima']);
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
        Schema::dropIfExists('missing_committees');
    }
}
