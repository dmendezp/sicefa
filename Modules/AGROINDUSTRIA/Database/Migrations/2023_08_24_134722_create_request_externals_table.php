<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestExternalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_externals', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('area');
            $table->foreignId('coordinator')->constrained('people')->onDelete('cascade');
            $table->foreignId('receiver')->constrained('people')->onDelete('cascade');
            $table->integer('region_code');
            $table->string('region_name');
            $table->integer('cost_code');
            $table->string('cost_center_name');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('request_externals');
    }
}
