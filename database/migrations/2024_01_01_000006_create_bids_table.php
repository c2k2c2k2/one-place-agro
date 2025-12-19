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
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('yield_id')->constrained('yields')->onDelete('cascade');
            $table->foreignId('trader_id')->constrained('users')->onDelete('cascade');
            $table->decimal('bid_amount', 10, 2); // Total bid amount
            $table->decimal('quantity', 10, 2); // Quantity trader wants to purchase (can be partial)
            $table->text('message')->nullable(); // Optional trader note/message
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
            $table->softDeletes(); // Soft delete for audit trail

            // Indices for performance
            $table->index('yield_id');
            $table->index('trader_id');
            $table->index('status');
            $table->index(['yield_id', 'status']); // Composite index for yield bids
            $table->index(['trader_id', 'status']); // Composite index for trader's bids
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
