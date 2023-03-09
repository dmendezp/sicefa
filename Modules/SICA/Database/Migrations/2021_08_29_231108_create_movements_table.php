<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            $table->date('registration_date');
            $table->date('return_date');
            $table->unsignedInteger('voucher_number')->nullable();
            $table->integer('total');
            $table->text('observation');
            $table->enum('state',['Solicitud','Aprovacion','Anulada','Devuelto']);
            $table->enum('type_movement',['MovInterno','Ventas','Bajas','PresInterno','PresExtreno']);
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
        Schema::dropIfExists('movements');
    }
}
