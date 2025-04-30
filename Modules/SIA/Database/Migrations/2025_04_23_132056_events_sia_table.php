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
    public function up(): void
    {
        Schema::create('events_sia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_user_id')->nullable()->constrained('role_user')->onDelete('set null');
            $table->string('name');
            $table->string('imagen_evento');
            $table->string('location')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('organizer')->nullable();
            $table->string('contact_email');
            $table->string('contact_phone')->nullable();
            $table->enum('status', ['scheduled', 'ongoing', 'completed', 'cancelled'])->default('scheduled');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('events_sia');
    }
};