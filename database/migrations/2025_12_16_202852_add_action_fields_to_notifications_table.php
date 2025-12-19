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
        Schema::table('notifications', function (Blueprint $table) {
            $table->string('action_url')->nullable()->after('type');
            $table->unsignedBigInteger('related_id')->nullable()->after('action_url');
            $table->string('related_type')->nullable()->after('related_id'); // e.g., 'bid', 'yield', 'requirement'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn(['action_url', 'related_id', 'related_type']);
        });
    }
};
