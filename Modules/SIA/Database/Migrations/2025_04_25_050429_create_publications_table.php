<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('reviewer_id')->nullable();
            $table->string('title');
            $table->longText('content');
            $table->string('location');
            $table->date('publication_date');
            $table->enum('status', ['pending', 'published', 'rejected'])->default('pending');
            $table->date('review_date')->nullable();
            $table->text('reviewer_comments')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reviewer_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publications');
    }
};
