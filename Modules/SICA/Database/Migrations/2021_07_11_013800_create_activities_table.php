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
            $table->string('name');
            $table->foreignId('productive_unit_id')->constrained()->onDelete('cascade');
            $table->foreignId('activity_type_id')->constrained()->onDelete('cascade');
            $table->text('description');
            $table->string('period');
            $table->enum('status', ['Activo','Inactivo'])->default('Activo');
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
