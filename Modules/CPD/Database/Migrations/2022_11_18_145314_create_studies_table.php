<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('studies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producer_id')->constrained()->onDelete('cascade');
            $table->year('monitoring');
            $table->foreignId('village_id')->constrained()->onDelete('cascade');
            $table->enum('typology', ['Hibrido','Clon','Hibrido - Clon']);
            $table->integer('altitud');
            $table->double('pH', 7, 3)->nullable();
            $table->double('Ar', 7, 3)->nullable();
            $table->double('Arc', 7, 3)->nullable();
            $table->double('Lim', 7, 3)->nullable();
            $table->double('CE', 7, 3)->nullable();
            $table->double('COT', 7, 3)->nullable();
            $table->double('MO', 7, 3)->nullable();
            $table->double('N', 7, 3)->nullable();
            $table->double('P', 7, 3)->nullable();
            $table->double('Na', 7, 3)->nullable();
            $table->double('K', 7, 3)->nullable();
            $table->double('Ca', 7, 3)->nullable();
            $table->double('Mg', 7, 3)->nullable();
            $table->double('Mn', 7, 3)->nullable();
            $table->double('Fe', 7, 3)->nullable();
            $table->double('Zn', 7, 3)->nullable();
            $table->double('Cu', 7, 3)->nullable();
            $table->double('CIC', 7, 3)->nullable();
            $table->double('B', 7, 3)->nullable();
            $table->double('S', 7, 3)->nullable();
            $table->double('Cd', 7, 3)->nullable();
            $table->double('Het', 7, 3)->nullable();
            $table->double('Hon', 7, 3)->nullable();
            $table->double('Bac', 7, 3)->nullable();
            $table->double('For', 7, 3)->nullable();
            $table->double('Lum', 7, 3)->nullable();
            $table->double('Isop', 7, 3)->nullable();
            $table->double('Cole', 7, 3)->nullable();
            $table->double('Car', 7, 3)->nullable();
            $table->double('IPyE', 7, 3)->nullable();
            $table->double('IE', 7, 3)->nullable();
            $table->double('IP', 7, 3)->nullable();
            $table->double('PPC', 7, 3)->nullable();
            $table->double('PC', 7, 3)->nullable();
            $table->double('Pre', 7, 3)->nullable();
            $table->double('Tem', 7, 3)->nullable();
            $table->double('Rad', 7, 3)->nullable();
            $table->double('DPV', 7, 3)->nullable();
            $table->double('ET0', 7, 3)->nullable();
            $table->double('ETc', 7, 3)->nullable();
            $table->double('EPE', 7, 3)->nullable();
            $table->double('SHP', 7, 3)->nullable();
            $table->double('UC', 7, 3)->nullable();
            $table->double('CFT', 7, 3)->nullable();
            $table->double('EPL', 7, 3)->nullable();
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
        Schema::dropIfExists('studies');
    }
}
