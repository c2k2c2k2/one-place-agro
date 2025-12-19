<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $yields = [
            // Farmer 1 (user_id: 2) - Ramesh Patil from Katol
            [
                'user_id' => 2,
                'variety_id' => 1, // Nagpur Mandarin
                'quantity' => 15.50,
                'price_per_ton' => 4000.00,
                'description' => 'Premium quality Nagpur Mandarin. Fresh harvest, excellent taste and color. Ready for immediate pickup.',
                'images' => json_encode(['images/yields/mandarin1.jpg', 'images/yields/mandarin2.jpg']),
                'status' => 'active',
                'harvest_date' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'location' => 'Katol, Nagpur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'variety_id' => 2, // Nagpur Orange
                'quantity' => 20.00,
                'price_per_ton' => 3800.00,
                'description' => 'Grade A Nagpur Oranges. Sweet and juicy. Organic farming practices used.',
                'images' => json_encode(['images/yields/orange1.jpg']),
                'status' => 'active',
                'harvest_date' => Carbon::now()->subDays(5)->format('Y-m-d'),
                'location' => 'Katol, Nagpur',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Farmer 2 (user_id: 3) - Suresh Deshmukh from Kamptee
            [
                'user_id' => 3,
                'variety_id' => 1, // Nagpur Mandarin
                'quantity' => 25.00,
                'price_per_ton' => 4200.00,
                'description' => 'Export quality Nagpur Mandarin. Large size, uniform color. Certified organic.',
                'images' => json_encode(['images/yields/mandarin3.jpg', 'images/yields/mandarin4.jpg', 'images/yields/mandarin5.jpg']),
                'status' => 'active',
                'harvest_date' => Carbon::now()->subDays(1)->format('Y-m-d'),
                'location' => 'Kamptee, Nagpur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'variety_id' => 3, // Kinnow
                'quantity' => 18.75,
                'price_per_ton' => 3500.00,
                'description' => 'Fresh Kinnow oranges. Perfect for juice extraction. Bulk orders welcome.',
                'images' => json_encode(['images/yields/kinnow1.jpg']),
                'status' => 'active',
                'harvest_date' => Carbon::now()->subDays(3)->format('Y-m-d'),
                'location' => 'Kamptee, Nagpur',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Farmer 3 (user_id: 4) - Prakash Bhosale from Hingna
            [
                'user_id' => 4,
                'variety_id' => 2, // Nagpur Orange
                'quantity' => 30.00,
                'price_per_ton' => 3900.00,
                'description' => 'Premium Nagpur Oranges. High sugar content. Ideal for retail markets.',
                'images' => json_encode(['images/yields/orange2.jpg', 'images/yields/orange3.jpg']),
                'status' => 'active',
                'harvest_date' => Carbon::now()->format('Y-m-d'),
                'location' => 'Hingna, Nagpur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'variety_id' => 4, // Mosambi
                'quantity' => 12.50,
                'price_per_ton' => 3200.00,
                'description' => 'Sweet Mosambi (Sweet Lime). Excellent for fresh juice. Chemical-free cultivation.',
                'images' => json_encode(['images/yields/mosambi1.jpg']),
                'status' => 'active',
                'harvest_date' => Carbon::now()->subDays(4)->format('Y-m-d'),
                'location' => 'Hingna, Nagpur',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Farmer 4 (user_id: 5) - Vijay Kale from Umred
            [
                'user_id' => 5,
                'variety_id' => 1, // Nagpur Mandarin
                'quantity' => 22.00,
                'price_per_ton' => 4100.00,
                'description' => 'Top grade Nagpur Mandarin. Perfect size and color. Ready for export.',
                'images' => json_encode(['images/yields/mandarin6.jpg']),
                'status' => 'active',
                'harvest_date' => Carbon::now()->subDays(1)->format('Y-m-d'),
                'location' => 'Umred, Nagpur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'variety_id' => 5, // Blood Orange
                'quantity' => 8.00,
                'price_per_ton' => 5000.00,
                'description' => 'Rare Blood Oranges. Rich in antioxidants. Limited quantity available.',
                'images' => json_encode(['images/yields/blood-orange1.jpg', 'images/yields/blood-orange2.jpg']),
                'status' => 'active',
                'harvest_date' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'location' => 'Umred, Nagpur',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Farmer 5 (user_id: 6) - Ashok Wankhede from Saoner
            [
                'user_id' => 6,
                'variety_id' => 6, // Valencia Orange
                'quantity' => 16.00,
                'price_per_ton' => 3700.00,
                'description' => 'Valencia Oranges. Great for juice production. Consistent quality.',
                'images' => json_encode(['images/yields/valencia1.jpg']),
                'status' => 'active',
                'harvest_date' => Carbon::now()->subDays(3)->format('Y-m-d'),
                'location' => 'Saoner, Nagpur',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Some sold yields for history
            [
                'user_id' => 2,
                'variety_id' => 1,
                'quantity' => 10.00,
                'price_per_ton' => 3900.00,
                'description' => 'Sold batch of Nagpur Mandarin.',
                'images' => json_encode(['images/yields/sold1.jpg']),
                'status' => 'sold',
                'harvest_date' => Carbon::now()->subDays(15)->format('Y-m-d'),
                'location' => 'Katol, Nagpur',
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(10),
            ],
            [
                'user_id' => 3,
                'variety_id' => 2,
                'quantity' => 18.00,
                'price_per_ton' => 3750.00,
                'description' => 'Sold batch of Nagpur Oranges.',
                'images' => json_encode(['images/yields/sold2.jpg']),
                'status' => 'sold',
                'harvest_date' => Carbon::now()->subDays(20)->format('Y-m-d'),
                'location' => 'Kamptee, Nagpur',
                'created_at' => Carbon::now()->subDays(20),
                'updated_at' => Carbon::now()->subDays(15),
            ],
        ];

        DB::table('yields')->insert($yields);
    }
}
