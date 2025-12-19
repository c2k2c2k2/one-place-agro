<?php

/**
 * Database Schema Verification Script
 * Run with: php database/test_schema.php
 */

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "=== Database Schema Verification ===\n\n";

// Test 1: Verify all tables exist
echo "✓ Test 1: Checking if all tables exist...\n";
$requiredTables = [
    'users',
    'crop_varieties',
    'market_prices',
    'yields',
    'requirements',
    'bids',
    'notifications',
    'news',
];

foreach ($requiredTables as $table) {
    if (Schema::hasTable($table)) {
        echo "  ✓ Table '$table' exists\n";
    } else {
        echo "  ✗ Table '$table' MISSING!\n";
    }
}

// Test 2: Verify users table columns
echo "\n✓ Test 2: Checking users table columns...\n";
$usersColumns = ['id', 'name', 'email', 'mobile', 'password', 'role', 'location', 'avatar', 'company_name', 'is_verified', 'remember_token'];
foreach ($usersColumns as $column) {
    if (Schema::hasColumn('users', $column)) {
        echo "  ✓ Column 'users.$column' exists\n";
    } else {
        echo "  ✗ Column 'users.$column' MISSING!\n";
    }
}

// Test 3: Verify yields table columns (including location)
echo "\n✓ Test 3: Checking yields table columns...\n";
$yieldsColumns = ['id', 'user_id', 'variety_id', 'quantity', 'price_per_ton', 'description', 'images', 'status', 'harvest_date', 'location', 'deleted_at'];
foreach ($yieldsColumns as $column) {
    if (Schema::hasColumn('yields', $column)) {
        echo "  ✓ Column 'yields.$column' exists\n";
    } else {
        echo "  ✗ Column 'yields.$column' MISSING!\n";
    }
}

// Test 4: Verify bids table columns (including quantity and message)
echo "\n✓ Test 4: Checking bids table columns...\n";
$bidsColumns = ['id', 'yield_id', 'trader_id', 'bid_amount', 'quantity', 'message', 'status', 'deleted_at'];
foreach ($bidsColumns as $column) {
    if (Schema::hasColumn('bids', $column)) {
        echo "  ✓ Column 'bids.$column' exists\n";
    } else {
        echo "  ✗ Column 'bids.$column' MISSING!\n";
    }
}

// Test 5: Verify requirements table columns (including location and description)
echo "\n✓ Test 5: Checking requirements table columns...\n";
$requirementsColumns = ['id', 'user_id', 'variety_id', 'quantity_required', 'max_budget', 'location', 'description', 'is_active', 'deleted_at'];
foreach ($requirementsColumns as $column) {
    if (Schema::hasColumn('requirements', $column)) {
        echo "  ✓ Column 'requirements.$column' exists\n";
    } else {
        echo "  ✗ Column 'requirements.$column' MISSING!\n";
    }
}

// Test 6: Check indices on users table
echo "\n✓ Test 6: Checking indices...\n";
$indices = DB::select("SHOW INDEX FROM users WHERE Key_name != 'PRIMARY'");
echo "  Users table indices:\n";
foreach ($indices as $index) {
    echo "    - {$index->Key_name} on column {$index->Column_name}\n";
}

// Test 7: Check foreign keys on yields table
echo "\n✓ Test 7: Checking foreign keys on yields table...\n";
$foreignKeys = DB::select("
    SELECT 
        CONSTRAINT_NAME,
        COLUMN_NAME,
        REFERENCED_TABLE_NAME,
        REFERENCED_COLUMN_NAME
    FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
    WHERE TABLE_SCHEMA = DATABASE()
    AND TABLE_NAME = 'yields'
    AND REFERENCED_TABLE_NAME IS NOT NULL
");
foreach ($foreignKeys as $fk) {
    echo "  ✓ {$fk->CONSTRAINT_NAME}: {$fk->COLUMN_NAME} -> {$fk->REFERENCED_TABLE_NAME}.{$fk->REFERENCED_COLUMN_NAME}\n";
}

// Test 8: Verify soft deletes
echo "\n✓ Test 8: Checking soft delete columns...\n";
$softDeleteTables = ['yields', 'bids', 'requirements'];
foreach ($softDeleteTables as $table) {
    if (Schema::hasColumn($table, 'deleted_at')) {
        echo "  ✓ Table '$table' has soft delete support\n";
    } else {
        echo "  ✗ Table '$table' MISSING deleted_at column!\n";
    }
}

echo "\n=== Schema Verification Complete ===\n";
