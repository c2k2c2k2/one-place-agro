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
        Schema::create('market_prices', function (Blueprint $table) {
            $table->id();
            $table->string('market_name');
            $table->foreignId('variety_id')->constrained('crop_varieties')->onDelete('cascade');
            $table->decimal('min_price', 10, 2);
            $table->decimal('max_price', 10, 2);
            $table->decimal('modal_price', 10, 2);
            $table->date('date');
            $table->timestamps();

            // Indices for performance
            $table->index('date');
            $table->index('variety_id');
            $table->index(['variety_id', 'date']); // Composite index for common queries
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('market_prices');
    }
};
