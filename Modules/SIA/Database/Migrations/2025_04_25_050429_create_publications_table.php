<?php

namespace Modules\SIA\Database\Migrations;

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
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('reviewer_id')->nullable()->constrained('users')->onDelete('set null'); 
            $table->string('title');
            $table->string('pdf_path');
            $table->date('publication_date');
            $table->enum('status', ['pending', 'published', 'rejected'])->default('pending');
            $table->date('review_date')->nullable(); 
            $table->text('reviewer_comments')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['status', 'publication_date']);
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