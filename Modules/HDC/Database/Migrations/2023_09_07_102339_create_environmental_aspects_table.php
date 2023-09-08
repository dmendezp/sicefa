<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvironmentalAspectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('environmental_aspects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('resource_id')->constrained()->onDelete('cascade');
            $table->enum('aspect_type', ['consumption', 'residue']);
            $table->float('conversion_factor');
            $table->boolean('personal');
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['environmental_aspect_id','resource_id'], 'unique_environmental_aspect_resource');
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
        Schema::dropIfExists('environmental_aspects');
    }
}
