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
        Schema::create('yields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('variety_id')->constrained('crop_varieties')->onDelete('cascade');
            $table->decimal('quantity', 10, 2); // in tons
            $table->decimal('price_per_ton', 10, 2);
            $table->text('description')->nullable();
            $table->json('images')->nullable(); // Store multiple image URLs
            $table->enum('status', ['active', 'sold', 'expired'])->default('active');
            $table->date('harvest_date');
            $table->string('location'); // Critical for Screen 12 filtering
            $table->timestamps();
            $table->softDeletes(); // Soft delete for audit trail

            // Indices for performance
            $table->index('user_id');
            $table->index('variety_id');
            $table->index('status');
            $table->index('location');
            $table->index(['user_id', 'status']); // Composite index for farmer dashboard
            $table->index(['status', 'location']); // Composite index for browse yields
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yields');
    }
};
