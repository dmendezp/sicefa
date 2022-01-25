<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClimaticdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('climaticdata', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained()->onDelete('cascade');
            $table->datetime('date_time', 0);
            $table->decimal('temperature', 8, 2);
            $table->decimal('precipitation', 8, 2);
            $table->decimal('relative_humidity', 8, 2);
            $table->decimal('solar_radiation', 8, 2);
            $table->decimal('winds_peed', 8, 2); 
            $table->decimal('winds_direction', 8, 2); 
            $table->string('unit');
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
        Schema::dropIfExists('climaticdata');
    }
}
