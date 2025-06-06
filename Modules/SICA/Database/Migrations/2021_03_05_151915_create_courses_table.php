<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('code')->unique();
            $table->date('star_date');
            $table->date('end_date');
            $table->date('star_production_date')->nullable();
            $table->date('school_end_date')->nullable();
            $table->enum('status',['Activo','Inactivo'])->default('Activo');
            $table->foreignId('program_id')->constrained()->onDelete('cascade');
            $table->foreignId('municipality_id')->constrained()->onDelete('cascade');
            $table->enum('deschooling', ['Lunes','Martes','Miércoles','Jueves','Viernes'])->nullable();
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
        Schema::dropIfExists('courses');
    }
}
