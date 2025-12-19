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
        Schema::create('requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('variety_id')->constrained('crop_varieties')->onDelete('cascade');
            $table->decimal('quantity_required', 10, 2); // in tons
            $table->decimal('max_budget', 10, 2);
            $table->string('location'); // Where trader needs delivery
            $table->text('description')->nullable(); // Additional details
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes(); // Soft delete for audit trail

            // Indices for performance
            $table->index('user_id');
            $table->index('variety_id');
            $table->index('is_active');
            $table->index(['user_id', 'is_active']); // Composite index for trader dashboard
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requirements');
    }
};
