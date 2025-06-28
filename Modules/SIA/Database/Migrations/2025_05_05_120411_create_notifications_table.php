<?php

namespace Modules\SIA\Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_user_id')->constrained('role_user')->onDelete('cascade');
            $table->enum('type', ['inactivity_warning'])->default('inactivity_warning');
            $table->timestamp('sent_at')->nullable();
            $table->enum('status', ['pending', 'sent', 'failed'])->default('pending');
            $table->unsignedTinyInteger('retry_count')->default(0);
            $table->timestamps();
            $table->index(['sent_at', 'status'], 'notifications_sent_at_status_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};