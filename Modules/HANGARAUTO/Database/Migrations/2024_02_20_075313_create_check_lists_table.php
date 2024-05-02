<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_lists', function (Blueprint $table) {
            $table->id();
            $table->enum('inspection', ['Licencia Conduccion','SOAT','Seguro Daños','Revision TM','Luces','Limpiabrisas','Frenos','Llantas','Espejos','Nivel Aceite','Nivel Liquido Frenos','Nivel Refrigerante','Cinturones','Extintor','Equipo Carretera','Herramientas']);
            $table->enum('complete', ['Si','No']);
            $table->string('observation')->nullable();
            $table->foreignId('check_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('check_lists');
    }
}
