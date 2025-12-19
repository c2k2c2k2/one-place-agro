<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->enum('type', ['bid_received', 'bid_accepted', 'bid_rejected', 'market_alert', 'requirement_matched', 'system'])->default('system');
            $table->timestamps();

            // Indices for performance
            $table->index('user_id');
            $table->index('is_read');
            $table->index(['user_id', 'is_read']); // Composite index for unread notifications
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
