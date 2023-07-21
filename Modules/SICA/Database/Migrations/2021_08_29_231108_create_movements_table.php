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
            $table->dateTime('registration_date');
            $table->dateTime('return_date')->nullable();
            $table->foreignId('movement_type_id')->constrained()->onDelete('cascade');
            $table->integer('voucher_number');
            $table->integer('price');
            $table->text('observation')->nullable();
            $table->enum('state',['Anulado','Aprobado','Devuelto','Solicitado']);
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
        Schema::dropIfExists('movements');
    }
}
