<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUniqueConstraintFromMilkProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('milk_productions', function (Blueprint $table) {
            $table->dropUnique(['animal_id', 'production_date', 'shift']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('milk_productions', function (Blueprint $table) {
            $table->unique(['animal_id', 'production_date', 'shift']);
        });
    }
}
