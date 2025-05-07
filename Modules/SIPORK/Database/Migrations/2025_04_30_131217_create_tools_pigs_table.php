<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolsPigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tools_pigs', function (Blueprint $table) {
            $table->id('id_tool_pig');
            $table->foreignId('tool_id')->constrained('tools')->onDelete('cascade');
            $table->foreignId('pig_id')->constrained('pigs', 'id_pig')->onDelete('cascade');
            $table->date('usage_date')->nullable(false);
            $table->text('task_description')->nullable();
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
        Schema::dropIfExists('tools_pigs');
    }
}
