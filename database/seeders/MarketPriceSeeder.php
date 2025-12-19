<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarketPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $markets = ['Nagpur APMC', 'Katol Market', 'Kamptee Market', 'Hingna Market'];
        $prices = [];

        // Generate market prices for the last 30 days
        for ($i = 0; $i < 30; $i++) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');

            foreach ($markets as $market) {
                // Nagpur Mandarin (variety_id: 1)
                $prices[] = [
                    'market_name' => $market,
                    'variety_id' => 1,
                    'min_price' => rand(3000, 3500),
                    'max_price' => rand(4500, 5000),
                    'modal_price' => rand(3800, 4200),
                    'date' => $date,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Nagpur Orange (variety_id: 2)
                $prices[] = [
                    'market_name' => $market,
                    'variety_id' => 2,
                    'min_price' => rand(2800, 3200),
                    'max_price' => rand(4200, 4800),
                    'modal_price' => rand(3500, 4000),
                    'date' => $date,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Kinnow (variety_id: 3)
                $prices[] = [
                    'market_name' => $market,
                    'variety_id' => 3,
                    'min_price' => rand(2500, 3000),
                    'max_price' => rand(3800, 4300),
                    'modal_price' => rand(3200, 3600),
                    'date' => $date,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Mosambi (variety_id: 4)
                $prices[] = [
                    'market_name' => $market,
                    'variety_id' => 4,
                    'min_price' => rand(2200, 2700),
                    'max_price' => rand(3500, 4000),
                    'modal_price' => rand(2800, 3300),
                    'date' => $date,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert in chunks to avoid memory issues
        foreach (array_chunk($prices, 100) as $chunk) {
            DB::table('market_prices')->insert($chunk);
        }
    }
}
