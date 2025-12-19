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
        Schema::table('users', function (Blueprint $table) {
            // Make email nullable since we're using mobile as primary identifier
            $table->string('email')->nullable()->change();

            // Add mobile number with unique constraint
            $table->string('mobile', 15)->unique()->after('email');

            // Add role enum
            $table->enum('role', ['farmer', 'trader', 'admin'])->default('farmer')->after('password');

            // Add location
            $table->string('location')->nullable()->after('role');

            // Add avatar
            $table->string('avatar')->nullable()->after('location');

            // Add company name for traders
            $table->string('company_name')->nullable()->after('avatar');

            // Add verification status
            $table->boolean('is_verified')->default(false)->after('company_name');

            // Add indices for performance
            $table->index('mobile');
            $table->index('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['mobile']);
            $table->dropIndex(['role']);
            $table->dropColumn([
                'mobile',
                'role',
                'location',
                'avatar',
                'company_name',
                'is_verified',
            ]);
        });
    }
};
