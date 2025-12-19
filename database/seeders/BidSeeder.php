<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bids = [
            // Bids on Yield 1 (Ramesh Patil's Nagpur Mandarin - 15.50 tons @ 4000/ton)
            [
                'yield_id' => 1,
                'trader_id' => 7, // Rajesh Agarwal
                'bid_amount' => 62000.00, // 15.50 * 4000
                'quantity' => 15.50,
                'message' => 'Interested in full quantity. Can provide immediate payment. Please confirm quality certificates.',
                'status' => 'pending',
                'created_at' => now()->subHours(2),
                'updated_at' => now()->subHours(2),
            ],
            [
                'yield_id' => 1,
                'trader_id' => 9, // Sanjay Joshi
                'bid_amount' => 50000.00,
                'quantity' => 12.50,
                'message' => 'Need 12.5 tons only. Can pickup from farm. Payment on delivery.',
                'status' => 'pending',
                'created_at' => now()->subHours(1),
                'updated_at' => now()->subHours(1),
            ],

            // Bids on Yield 2 (Ramesh Patil's Nagpur Orange - 20 tons @ 3800/ton)
            [
                'yield_id' => 2,
                'trader_id' => 10, // Amit Shah
                'bid_amount' => 76000.00, // 20 * 3800
                'quantity' => 20.00,
                'message' => 'Full quantity required. Export quality needed. Can arrange transport.',
                'status' => 'accepted',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subHours(12),
            ],

            // Bids on Yield 3 (Suresh Deshmukh's Nagpur Mandarin - 25 tons @ 4200/ton)
            [
                'yield_id' => 3,
                'trader_id' => 7, // Rajesh Agarwal
                'bid_amount' => 105000.00, // 25 * 4200
                'quantity' => 25.00,
                'message' => 'Perfect for our export requirements. Organic certification is a plus. Ready to sign contract.',
                'status' => 'pending',
                'created_at' => now()->subHours(5),
                'updated_at' => now()->subHours(5),
            ],
            [
                'yield_id' => 3,
                'trader_id' => 11, // Deepak Mehta
                'bid_amount' => 84000.00,
                'quantity' => 20.00,
                'message' => 'Need 20 tons for wholesale market. Can you deliver to Mahal?',
                'status' => 'pending',
                'created_at' => now()->subHours(3),
                'updated_at' => now()->subHours(3),
            ],

            // Bids on Yield 4 (Suresh Deshmukh's Kinnow - 18.75 tons @ 3500/ton)
            [
                'yield_id' => 4,
                'trader_id' => 8, // Mahesh Gupta
                'bid_amount' => 65625.00, // 18.75 * 3500
                'quantity' => 18.75,
                'message' => 'Excellent for our juice processing. Full quantity needed. Payment within 7 days as mentioned.',
                'status' => 'pending',
                'created_at' => now()->subHours(4),
                'updated_at' => now()->subHours(4),
            ],

            // Bids on Yield 5 (Prakash Bhosale's Nagpur Orange - 30 tons @ 3900/ton)
            [
                'yield_id' => 5,
                'trader_id' => 10, // Amit Shah
                'bid_amount' => 117000.00, // 30 * 3900
                'quantity' => 30.00,
                'message' => 'High sugar content is what we need. Full quantity bid. Can arrange pickup today.',
                'status' => 'pending',
                'created_at' => now()->subMinutes(30),
                'updated_at' => now()->subMinutes(30),
            ],
            [
                'yield_id' => 5,
                'trader_id' => 7, // Rajesh Agarwal
                'bid_amount' => 78000.00,
                'quantity' => 20.00,
                'message' => 'Need 20 tons for retail chain. Premium quality as described.',
                'status' => 'pending',
                'created_at' => now()->subMinutes(45),
                'updated_at' => now()->subMinutes(45),
            ],

            // Bids on Yield 6 (Prakash Bhosale's Mosambi - 12.50 tons @ 3200/ton)
            [
                'yield_id' => 6,
                'trader_id' => 8, // Mahesh Gupta
                'bid_amount' => 40000.00, // 12.50 * 3200
                'quantity' => 12.50,
                'message' => 'Perfect for fresh juice production. Chemical-free is important for us. Full quantity.',
                'status' => 'pending',
                'created_at' => now()->subHours(6),
                'updated_at' => now()->subHours(6),
            ],

            // Bids on Yield 7 (Vijay Kale's Nagpur Mandarin - 22 tons @ 4100/ton)
            [
                'yield_id' => 7,
                'trader_id' => 9, // Sanjay Joshi
                'bid_amount' => 90200.00, // 22 * 4100
                'quantity' => 22.00,
                'message' => 'Export grade quality needed. Full quantity. Can provide advance payment.',
                'status' => 'pending',
                'created_at' => now()->subHours(1),
                'updated_at' => now()->subHours(1),
            ],

            // Bids on Yield 8 (Vijay Kale's Blood Orange - 8 tons @ 5000/ton)
            [
                'yield_id' => 8,
                'trader_id' => 10, // Amit Shah
                'bid_amount' => 40000.00, // 8 * 5000
                'quantity' => 8.00,
                'message' => 'Rare variety! Full quantity required. Premium price acceptable. Immediate pickup possible.',
                'status' => 'accepted',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subHours(18),
            ],
            [
                'yield_id' => 8,
                'trader_id' => 7, // Rajesh Agarwal
                'bid_amount' => 30000.00,
                'quantity' => 6.00,
                'message' => 'Need 6 tons for specialty market. Can you reserve this quantity?',
                'status' => 'rejected',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subHours(18),
            ],

            // Bids on Yield 9 (Ashok Wankhede's Valencia Orange - 16 tons @ 3700/ton)
            [
                'yield_id' => 9,
                'trader_id' => 9, // Sanjay Joshi
                'bid_amount' => 59200.00, // 16 * 3700
                'quantity' => 16.00,
                'message' => 'Great for juice concentrate. Full quantity needed. Long-term partnership possible.',
                'status' => 'pending',
                'created_at' => now()->subHours(2),
                'updated_at' => now()->subHours(2),
            ],
        ];

        DB::table('bids')->insert($bids);
    }
}
