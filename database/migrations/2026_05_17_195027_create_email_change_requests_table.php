<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('email_change_requests', function (Blueprint $table) {
            $table->id();

            // User who is changing email
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // New email being requested
            $table->string('new_email');

            // Verification token (for secure link)
            $table->string('token')->unique();

            // Status tracking
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('expires_at')->nullable();

            $table->timestamps();

            // Optional: prevent duplicate active requests per user
            $table->index(['user_id', 'verified_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_change_requests');
    }
};