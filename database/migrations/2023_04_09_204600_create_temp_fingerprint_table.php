<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempFingerprintTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('temp_fingerprint', function (Blueprint $table) {
            $table->string("id", 40);
            $table->primary("id");
            $table->binary("image")->nullable();
            $table->binary("fingerprint")->nullable();         
            $table->string("user_id_number", 30)->nullable();
            $table->string("finger_name", 30)->nullable();
            $table->string("token_pc", 100)->nullable();
            $table->string("option", 30)->nullable();
            $table->string("name", 200)->nullable();
            $table->string("text", 100)->nullable();
            $table->unsignedBigInteger("person_id")->nullable();
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
        Schema::dropIfExists('temp_fingerprint');
    }

}
