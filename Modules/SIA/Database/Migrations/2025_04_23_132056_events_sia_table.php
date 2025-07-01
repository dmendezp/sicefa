<?php

namespace Modules\SIA\Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('events_sia', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('event_image');
            $table->string('location');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('organizer');
            $table->string('contact_email');
            $table->string('contact_phone')->nullable();
            $table->enum('status', ['scheduled', 'ongoing', 'completed', 'cancelled'])->default('scheduled');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['start_date', 'end_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events_sia');
    }
};