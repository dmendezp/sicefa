<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCropsTable extends Migration
{
    public function up()
    {
        Schema::create('crops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('sown_area');
            $table->date('seed_time');
            $table->float('density_value'); // Agregar el campo density_value
            $table->string('density_unit');  // Agregar el campo density_unit
            $table->foreignId('variety_id')->constrained()->onDelete('cascade');
            $table->date('finish_date');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('crops');
    }
}
