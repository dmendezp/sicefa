<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnvironmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('environments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('picture')->nullable();
            $table->string('description')->nullable();
            $table->string('length')->nullable();
            $table->string('latitude')->nullable();
            $table->foreignId('farms_id')->constrained()->ondelete('cascade');
            $table->foreignId('productive_units_id')->constrained()->ondelete('cascade');
            $table->string('status')->nullable();
            $table->string('type_environment')->nullable();
            $table->string('environment_classroom')->nullable();
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
        Schema::dropIfExists('environments');
    }
}
