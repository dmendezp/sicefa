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
            $table->double('pH', 7, 3);
            $table->double('Ar', 7, 3);
            $table->double('Arc', 7, 3);
            $table->double('Lim', 7, 3);
            $table->double('CE', 7, 3);
            $table->double('COT', 7, 3);
            $table->double('MO', 7, 3);
            $table->double('N', 7, 3);
            $table->double('P', 7, 3);
            $table->double('Na', 7, 3);
            $table->double('K', 7, 3);
            $table->double('Ca', 7, 3);
            $table->double('Mg', 7, 3);
            $table->double('Mn', 7, 3);
            $table->double('Fe', 7, 3);
            $table->double('Zn', 7, 3);
            $table->double('Cu', 7, 3);
            $table->double('CIC', 7, 3);
            $table->double('B', 7, 3);
            $table->double('S', 7, 3);
            $table->double('Cd', 7, 3);
            $table->double('Het', 7, 3);
            $table->double('Hon', 7, 3);
            $table->double('Bac', 7, 3);
            $table->double('For', 7, 3);
            $table->double('Lum', 7, 3);
            $table->double('Isop', 7, 3);
            $table->double('Cole', 7, 3);
            $table->double('Car', 7, 3);
            $table->double('IPyE', 7, 3);
            $table->double('IE', 7, 3);
            $table->double('IP', 7, 3);
            $table->double('PPC', 7, 3);
            $table->double('PC', 7, 3);
            $table->double('Pre', 7, 3);
            $table->double('Tem', 7, 3);
            $table->double('Rad', 7, 3);
            $table->double('DPV', 7, 3);
            $table->double('ET0', 7, 3);
            $table->double('ETc', 7, 3);
            $table->double('EPE', 7, 3);
            $table->double('SHP', 7, 3);
            $table->double('UC', 7, 3);
            $table->double('CFT', 7, 3);
            $table->double('EPL', 7, 3);
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
