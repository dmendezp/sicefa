<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoveltyChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novelty_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_id')->constrained()->onDelete('cascade');
            $table->foreignId('environment_check_id')->constrained()->onDelete('cascade');
            $table->text('observation');
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
        Schema::dropIfExists('novelty_checks');
    }
}
