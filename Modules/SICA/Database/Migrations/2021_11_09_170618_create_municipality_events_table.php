<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipalityEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipality_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained()->ondelete('cascade');
            $table->foreignId('municipality_id')->constrained()->ondelete('cascade');
            $table->enum('event_type', ['municipality_of_issue', 'municipality_of_birth', 'municipality']);
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
        Schema::dropIfExists('municipality_events');
    }
}
