<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductiveUnitResoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productive_unit_resourses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resource_id')->constrained()->onDelete('cascade');
            $table->foreignId('productive_unit_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['resource_id','productive_unit_id'], 'unique_resource_productive_unit'); // Generar llave única entre las columnas environment_id y productive_unit_id
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
        Schema::dropIfExists('productive_unit_resourses');
    }
}
