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
            $table->foreignId('farm_id')->constrained()->ondelete('cascade');
            $table->foreignId('productive_unit_id')->constrained()->ondelete('cascade');
            $table->enum('status',['Disponible','No Disponible'])->nullable();
            $table->string('type_environment')->nullable();
            $table->foreignId('class_environment_id')->constrained()->ondelete('cascade');
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
