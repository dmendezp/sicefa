<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFingerprintsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('fingerprints', function (Blueprint $table) {
            $table->id();
            $table->string("finger_name", 30)->nullable();
            $table->string("image")->nullable();
            $table->binary("fingerprint")->nullable();
            $table->integer("notified")->nullable();
            $table->unsignedBigInteger("person_id");
            $table->foreign("person_id")->references("id")->on("people")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('fingerprints');
    }

}
