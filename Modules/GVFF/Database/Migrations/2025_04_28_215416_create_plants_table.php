<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePlantsTable extends Migration
{
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('nurseries_id')->nullable(false);
            $table->string('scientific_name', 255)->nullable(false)->index();
            $table->string('common_name', 255)->nullable(false)->index();
            $table->enum('plant_type', ['ornamental', 'forestal', 'medicinal', 'venta'])->nullable(false);
            $table->enum('structure_type', ['tree', 'shrub', 'herb'])->nullable();
            $table->string('family', 255)->nullable();
            $table->text('characteristics')->nullable();
            $table->text('benefits')->nullable();
            $table->text('properties')->nullable();
            $table->text('traditional_uses')->nullable();
            $table->enum('status', ['healthy', 'endangered', 'critical'])->nullable();
            $table->integer('inventory')->nullable(false)->default(0);
            $table->decimal('price', 10, 2)->nullable();
            $table->string('location', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->boolean('available')->default(1);
            $table->text('observations')->nullable();
            $table->timestamp('created_at')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'))->onUpdate(DB::raw('CURRENT_TIMESTAMP'));

            // Foreign key constraint
            $table->foreign('nurseries_id')
                  ->references('id')
                  ->on('nurseries')
                  ->onDelete('cascade')
                  ->name('plants_nurseries_id_foreign');
        });
    }

    public function down()
    {
        Schema::dropIfExists('plants');
    }
}