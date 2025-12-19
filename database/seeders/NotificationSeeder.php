<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notifications = [
            // Notifications for Farmer 1 (user_id: 2) - Ramesh Patil
            [
                'user_id' => 2,
                'title' => 'New Bid Received',
                'message' => 'Rajesh Agarwal placed a bid of ₹62,000 on your Nagpur Mandarin listing (15.50 tons).',
                'is_read' => false,
                'type' => 'bid_received',
                'action_url' => '/farmer/bids',
                'related_id' => 1,
                'related_type' => 'bid',
                'created_at' => now()->subHours(2),
                'updated_at' => now()->subHours(2),
            ],
            [
                'user_id' => 2,
                'title' => 'New Bid Received',
                'message' => 'Sanjay Joshi placed a bid of ₹50,000 on your Nagpur Mandarin listing (12.50 tons).',
                'is_read' => false,
                'type' => 'bid_received',
                'action_url' => '/farmer/bids',
                'related_id' => 2,
                'related_type' => 'bid',
                'created_at' => now()->subHours(1),
                'updated_at' => now()->subHours(1),
            ],
            [
                'user_id' => 2,
                'title' => 'Bid Accepted',
                'message' => 'You accepted the bid from Amit Shah for ₹76,000 on your Nagpur Orange listing.',
                'is_read' => true,
                'type' => 'bid_accepted',
                'action_url' => '/farmer/yields/1',
                'related_id' => 1,
                'related_type' => 'yield',
                'created_at' => now()->subHours(12),
                'updated_at' => now()->subHours(10),
            ],
            [
                'user_id' => 2,
                'title' => 'Market Alert',
                'message' => 'Nagpur Mandarin prices increased by 5% in Nagpur APMC today. Current modal price: ₹4,100/ton.',
                'is_read' => true,
                'type' => 'market_alert',
                'action_url' => '/market-prices',
                'related_id' => null,
                'related_type' => null,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],

            // Notifications for Farmer 2 (user_id: 3) - Suresh Deshmukh
            [
                'user_id' => 3,
                'title' => 'New Bid Received',
                'message' => 'Rajesh Agarwal placed a bid of ₹105,000 on your Nagpur Mandarin listing (25 tons).',
                'is_read' => false,
                'type' => 'bid_received',
                'action_url' => '/farmer/bids',
                'related_id' => 3,
                'related_type' => 'bid',
                'created_at' => now()->subHours(5),
                'updated_at' => now()->subHours(5),
            ],
            [
                'user_id' => 3,
                'title' => 'New Bid Received',
                'message' => 'Deepak Mehta placed a bid of ₹84,000 on your Nagpur Mandarin listing (20 tons).',
                'is_read' => false,
                'type' => 'bid_received',
                'action_url' => '/farmer/bids',
                'related_id' => 4,
                'related_type' => 'bid',
                'created_at' => now()->subHours(3),
                'updated_at' => now()->subHours(3),
            ],
            [
                'user_id' => 3,
                'title' => 'New Bid Received',
                'message' => 'Mahesh Gupta placed a bid of ₹65,625 on your Kinnow listing (18.75 tons).',
                'is_read' => false,
                'type' => 'bid_received',
                'action_url' => '/farmer/bids',
                'related_id' => 5,
                'related_type' => 'bid',
                'created_at' => now()->subHours(4),
                'updated_at' => now()->subHours(4),
            ],

            // Notifications for Farmer 3 (user_id: 4) - Prakash Bhosale
            [
                'user_id' => 4,
                'title' => 'New Bid Received',
                'message' => 'Amit Shah placed a bid of ₹117,000 on your Nagpur Orange listing (30 tons).',
                'is_read' => false,
                'type' => 'bid_received',
                'action_url' => '/farmer/bids',
                'related_id' => 6,
                'related_type' => 'bid',
                'created_at' => now()->subMinutes(30),
                'updated_at' => now()->subMinutes(30),
            ],
            [
                'user_id' => 4,
                'title' => 'New Bid Received',
                'message' => 'Rajesh Agarwal placed a bid of ₹78,000 on your Nagpur Orange listing (20 tons).',
                'is_read' => false,
                'type' => 'bid_received',
                'action_url' => '/farmer/bids',
                'related_id' => 7,
                'related_type' => 'bid',
                'created_at' => now()->subMinutes(45),
                'updated_at' => now()->subMinutes(45),
            ],
            [
                'user_id' => 4,
                'title' => 'New Bid Received',
                'message' => 'Mahesh Gupta placed a bid of ₹40,000 on your Mosambi listing (12.50 tons).',
                'is_read' => false,
                'type' => 'bid_received',
                'action_url' => '/farmer/bids',
                'related_id' => 8,
                'related_type' => 'bid',
                'created_at' => now()->subHours(6),
                'updated_at' => now()->subHours(6),
            ],

            // Notifications for Farmer 4 (user_id: 5) - Vijay Kale
            [
                'user_id' => 5,
                'title' => 'New Bid Received',
                'message' => 'Sanjay Joshi placed a bid of ₹90,200 on your Nagpur Mandarin listing (22 tons).',
                'is_read' => false,
                'type' => 'bid_received',
                'action_url' => '/farmer/bids',
                'related_id' => 9,
                'related_type' => 'bid',
                'created_at' => now()->subHours(1),
                'updated_at' => now()->subHours(1),
            ],
            [
                'user_id' => 5,
                'title' => 'Bid Accepted',
                'message' => 'You accepted the bid from Amit Shah for ₹40,000 on your Blood Orange listing.',
                'is_read' => true,
                'type' => 'bid_accepted',
                'action_url' => '/farmer/yields/5',
                'related_id' => 5,
                'related_type' => 'yield',
                'created_at' => now()->subHours(18),
                'updated_at' => now()->subHours(16),
            ],
            [
                'user_id' => 5,
                'title' => 'Bid Rejected',
                'message' => 'You rejected the bid from Rajesh Agarwal for ₹30,000 on your Blood Orange listing.',
                'is_read' => true,
                'type' => 'bid_rejected',
                'action_url' => '/farmer/yields/5',
                'related_id' => 5,
                'related_type' => 'yield',
                'created_at' => now()->subHours(18),
                'updated_at' => now()->subHours(16),
            ],

            // Notifications for Trader 1 (user_id: 7) - Rajesh Agarwal
            [
                'user_id' => 7,
                'title' => 'Bid Rejected',
                'message' => 'Your bid of ₹30,000 on Blood Orange listing was rejected by the farmer.',
                'is_read' => true,
                'type' => 'bid_rejected',
                'action_url' => '/trader/bids',
                'related_id' => 10,
                'related_type' => 'bid',
                'created_at' => now()->subHours(18),
                'updated_at' => now()->subHours(17),
            ],
            [
                'user_id' => 7,
                'title' => 'Requirement Matched',
                'message' => 'New Nagpur Mandarin listing matches your requirement. Check it out now!',
                'is_read' => false,
                'type' => 'requirement_matched',
                'action_url' => '/trader/yields',
                'related_id' => null,
                'related_type' => null,
                'created_at' => now()->subHours(3),
                'updated_at' => now()->subHours(3),
            ],

            // Notifications for Trader 2 (user_id: 8) - Mahesh Gupta
            [
                'user_id' => 8,
                'title' => 'Requirement Matched',
                'message' => 'New Kinnow listing matches your requirement. Quantity: 18.75 tons.',
                'is_read' => false,
                'type' => 'requirement_matched',
                'action_url' => '/trader/yields',
                'related_id' => null,
                'related_type' => null,
                'created_at' => now()->subHours(4),
                'updated_at' => now()->subHours(4),
            ],

            // Notifications for Trader 3 (user_id: 10) - Amit Shah
            [
                'user_id' => 10,
                'title' => 'Bid Accepted',
                'message' => 'Your bid of ₹76,000 on Nagpur Orange listing was accepted! Contact the farmer for pickup details.',
                'is_read' => true,
                'type' => 'bid_accepted',
                'action_url' => '/trader/bids',
                'related_id' => 11,
                'related_type' => 'bid',
                'created_at' => now()->subHours(12),
                'updated_at' => now()->subHours(11),
            ],
            [
                'user_id' => 10,
                'title' => 'Bid Accepted',
                'message' => 'Your bid of ₹40,000 on Blood Orange listing was accepted! Rare variety secured.',
                'is_read' => true,
                'type' => 'bid_accepted',
                'action_url' => '/trader/bids',
                'related_id' => 12,
                'related_type' => 'bid',
                'created_at' => now()->subHours(18),
                'updated_at' => now()->subHours(17),
            ],

            // System notifications for all users
            [
                'user_id' => 2,
                'title' => 'Welcome to One Place',
                'message' => 'Thank you for joining One Place Agro Trading Platform. Start listing your yields today!',
                'is_read' => true,
                'type' => 'system',
                'action_url' => null,
                'related_id' => null,
                'related_type' => null,
                'created_at' => now()->subDays(30),
                'updated_at' => now()->subDays(29),
            ],
        ];

        DB::table('notifications')->insert($notifications);
    }
}
