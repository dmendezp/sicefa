<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elements', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('measurement_unit_id')->constrained()->onDelete('cascade');
            $table->text('description')->nullable();
            $table->foreignId('kind_of_purchase_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->integer('price')->nullable();
            $table->unsignedInteger('UNSPSC_code')->unique()->nullable();
            $table->string('image')->nullable();
            $table->string('slug'); // Campo para almacenar url amigable
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
        Schema::dropIfExists('elements');
    }
}
