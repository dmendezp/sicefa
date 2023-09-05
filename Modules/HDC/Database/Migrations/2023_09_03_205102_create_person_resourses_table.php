<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonResoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_resourses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resource_id')->constrained()->onDelete('cascade');
            $table->foreignId('family_person_footprint_id')->constrained()->onDelete('cascade');
            $table->string('consumption_value');
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['resource_id','family_person_footprint_id'], 'unique_resource_family_person_footprints'); // Generar llave única entre las columnas resourse_id y family_person_footprints_id
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
        Schema::dropIfExists('person_resourses');
    }
}
