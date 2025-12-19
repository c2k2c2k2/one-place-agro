<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $requirements = [
            // Trader 1 (user_id: 7) - Rajesh Agarwal
            [
                'user_id' => 7,
                'variety_id' => 1, // Nagpur Mandarin
                'quantity_required' => 50.00,
                'max_budget' => 200000.00,
                'location' => 'Sitabuldi, Nagpur',
                'description' => 'Looking for premium quality Nagpur Mandarin for export. Need consistent supply for next 3 months. Prefer organic certified.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 7,
                'variety_id' => 2, // Nagpur Orange
                'quantity_required' => 30.00,
                'max_budget' => 120000.00,
                'location' => 'Sitabuldi, Nagpur',
                'description' => 'Need Grade A Nagpur Oranges for retail chain. Immediate requirement.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Trader 2 (user_id: 8) - Mahesh Gupta
            [
                'user_id' => 8,
                'variety_id' => 3, // Kinnow
                'quantity_required' => 40.00,
                'max_budget' => 140000.00,
                'location' => 'Dharampeth, Nagpur',
                'description' => 'Bulk requirement for juice processing unit. Quality should be consistent. Payment within 7 days.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8,
                'variety_id' => 4, // Mosambi
                'quantity_required' => 25.00,
                'max_budget' => 80000.00,
                'location' => 'Dharampeth, Nagpur',
                'description' => 'Sweet Lime needed for fresh juice bars. Prefer local farmers from Nagpur region.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Trader 3 (user_id: 9) - Sanjay Joshi
            [
                'user_id' => 9,
                'variety_id' => 1, // Nagpur Mandarin
                'quantity_required' => 35.00,
                'max_budget' => 150000.00,
                'location' => 'Ramdaspeth, Nagpur',
                'description' => 'Premium Nagpur Mandarin for wholesale distribution. Need delivery at our warehouse.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 9,
                'variety_id' => 6, // Valencia Orange
                'quantity_required' => 20.00,
                'max_budget' => 75000.00,
                'location' => 'Ramdaspeth, Nagpur',
                'description' => 'Valencia Oranges for juice concentrate production. Long-term contract possible.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Trader 4 (user_id: 10) - Amit Shah
            [
                'user_id' => 10,
                'variety_id' => 2, // Nagpur Orange
                'quantity_required' => 60.00,
                'max_budget' => 240000.00,
                'location' => 'Gandhibagh, Nagpur',
                'description' => 'Large order for Nagpur Oranges. Export quality required. Can provide advance payment.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 10,
                'variety_id' => 5, // Blood Orange
                'quantity_required' => 10.00,
                'max_budget' => 55000.00,
                'location' => 'Gandhibagh, Nagpur',
                'description' => 'Specialty requirement for Blood Oranges. Premium price offered for quality produce.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Trader 5 (user_id: 11) - Deepak Mehta
            [
                'user_id' => 11,
                'variety_id' => 1, // Nagpur Mandarin
                'quantity_required' => 45.00,
                'max_budget' => 185000.00,
                'location' => 'Mahal, Nagpur',
                'description' => 'Wholesale requirement for Nagpur Mandarin. Need regular supply throughout the season.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Some inactive/fulfilled requirements
            [
                'user_id' => 7,
                'variety_id' => 3,
                'quantity_required' => 20.00,
                'max_budget' => 70000.00,
                'location' => 'Sitabuldi, Nagpur',
                'description' => 'Fulfilled requirement for Kinnow.',
                'is_active' => false,
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(5),
            ],
        ];

        DB::table('requirements')->insert($requirements);
    }
}
