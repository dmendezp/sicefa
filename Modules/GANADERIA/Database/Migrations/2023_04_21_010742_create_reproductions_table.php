<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReproductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reproductions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('productive_proces_id')->constrained()->onDelete('cascade');
            $table->foreignId('inventories_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->date('date_reproduction')->nullable();
            $table->string('observation');
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
        Schema::dropIfExists('reproductions');
    }
}
