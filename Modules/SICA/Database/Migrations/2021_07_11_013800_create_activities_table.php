<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Cocoasoft\Entities\Activities;
use Modules\Cocoasoft\Entities\Environment;
class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('identification');
            $table->foreignId('productive_units_id')->constrained()->onDelete('cascade');
            $table->foreignId('type_activities_id')->constrained()->onDelete('cascade');
            $table->foreignId('period_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->string('value');
            $table->string('observation');
            $table->enum('prioridad', ['1','0'])->default(0);
            $table->integer("status")->default(0);
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
        Schema::dropIfExists('activities');
    }
}
