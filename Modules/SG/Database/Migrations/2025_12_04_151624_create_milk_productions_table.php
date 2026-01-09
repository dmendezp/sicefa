<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMilkProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milk_productions', function (Blueprint $table) {
            $table->id();
            $table->string('animal_id', 50);
            $table->date('production_date');
            $table->enum('shift', ['MORNING', 'AFTERNOON', 'NIGHT'])->default('MORNING');
            $table->decimal('liters', 6, 2);
            $table->enum('quality', ['HIGH', 'MEDIUM', 'LOW'])->default('MEDIUM');
            $table->decimal('milk_temperature', 4, 2)->nullable();
            $table->text('observations')->nullable();
            $table->string('responsible', 100)->nullable();
            $table->timestamps();

            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
            $table->unique(['animal_id', 'production_date', 'shift']);
            $table->index('production_date');
            $table->index('animal_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('milk_productions');
    }
}
