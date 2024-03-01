<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprenticeAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apprentice_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apprentice_id')->constrained();
            $table->foreignId('attendance_id')->constrained()->onDelete('cascade');
            $table->foreignId('work_id')->nullable()->constrained()->onDelete('cascade');
            $table->enum('asistencia',['si','no'])->nullable()->default('no');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apprentice_attendances');
    }
}
