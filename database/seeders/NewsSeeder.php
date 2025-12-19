<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $news = [
            [
                'title' => 'Nagpur Orange Exports Reach Record High This Season',
                'content' => 'Nagpur\'s famous oranges have achieved record export numbers this season, with over 50,000 tons shipped to international markets. The Geographical Indication (GI) tag has significantly boosted demand from countries like UAE, Bangladesh, and European nations. Farmers are reporting better prices and increased buyer interest.',
                'thumbnail' => 'images/news/export-record.jpg',
                'source' => 'Agriculture Today',
                'published_at' => Carbon::now()->subDays(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'New Cold Storage Facility Opens in Katol',
                'content' => 'A state-of-the-art cold storage facility with a capacity of 5,000 tons has been inaugurated in Katol, Nagpur district. This facility will help farmers store their produce for longer periods and get better prices. The facility is equipped with modern temperature control systems and will be available at subsidized rates for small farmers.',
                'thumbnail' => 'images/news/cold-storage.jpg',
                'source' => 'Nagpur Times',
                'published_at' => Carbon::now()->subDays(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Government Announces Minimum Support Price for Citrus Fruits',
                'content' => 'The Maharashtra government has announced a minimum support price (MSP) of ₹3,500 per ton for citrus fruits to protect farmers from price fluctuations. This decision comes after extensive consultations with farmer organizations and is expected to benefit over 50,000 citrus farmers in the Vidarbha region.',
                'thumbnail' => 'images/news/msp-announcement.jpg',
                'source' => 'Government Press Release',
                'published_at' => Carbon::now()->subDays(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Organic Farming Training Program for Orange Growers',
                'content' => 'The Agriculture Department is organizing a comprehensive training program on organic farming techniques for orange growers. The program will cover topics like natural pest control, organic fertilizers, and certification processes. Interested farmers can register at their nearest Krishi Vigyan Kendra.',
                'thumbnail' => 'images/news/organic-training.jpg',
                'source' => 'Krishi Vigyan Kendra',
                'published_at' => Carbon::now()->subDays(4),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Weather Alert: Light Rainfall Expected This Week',
                'content' => 'The Meteorological Department has issued a weather advisory predicting light to moderate rainfall in Nagpur district over the next 3-4 days. Farmers are advised to take necessary precautions for their standing crops and harvested produce. Temperatures are expected to drop by 2-3 degrees Celsius.',
                'thumbnail' => 'images/news/weather-alert.jpg',
                'source' => 'IMD Nagpur',
                'published_at' => Carbon::now()->subHours(12),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Digital Payment Adoption Increases Among Farmers',
                'content' => 'A recent survey shows that over 70% of farmers in Nagpur district are now using digital payment methods for agricultural transactions. UPI and mobile banking have become popular choices, reducing cash handling and improving transaction transparency. Several banks are offering special schemes for farmers adopting digital payments.',
                'thumbnail' => 'images/news/digital-payment.jpg',
                'source' => 'Banking Today',
                'published_at' => Carbon::now()->subDays(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'New Pest Control Method Shows Promising Results',
                'content' => 'Agricultural scientists at the Citrus Research Station have developed a new bio-control method for managing citrus pests. The method uses beneficial insects and has shown a 60% reduction in pest damage without using chemical pesticides. Field trials are being conducted in multiple locations.',
                'thumbnail' => 'images/news/pest-control.jpg',
                'source' => 'Citrus Research Station',
                'published_at' => Carbon::now()->subDays(6),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Orange Festival 2024 Dates Announced',
                'content' => 'The annual Nagpur Orange Festival will be held from February 15-18, 2024. The festival will showcase various orange varieties, processing techniques, and value-added products. Farmers, traders, and food processing companies are invited to participate. Online registration is now open.',
                'thumbnail' => 'images/news/orange-festival.jpg',
                'source' => 'Event Organizers',
                'published_at' => Carbon::now()->subDays(7),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Subsidy Scheme for Drip Irrigation Systems',
                'content' => 'The government has announced a 50% subsidy on drip irrigation systems for citrus farmers. This initiative aims to promote water conservation and improve crop yields. Farmers can apply online through the Agriculture Department portal. The scheme will be available until March 2024.',
                'thumbnail' => 'images/news/drip-irrigation.jpg',
                'source' => 'Agriculture Department',
                'published_at' => Carbon::now()->subDays(8),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Market Prices Stabilize After Initial Volatility',
                'content' => 'After experiencing price fluctuations in the early season, orange prices have now stabilized across major markets in Nagpur. The modal price is hovering around ₹3,800-4,200 per ton for premium varieties. Experts attribute this to balanced supply and steady demand from both domestic and export markets.',
                'thumbnail' => 'images/news/market-stable.jpg',
                'source' => 'Market Analysis',
                'published_at' => Carbon::now()->subDays(9),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Success Story: Farmer Doubles Income Through Direct Marketing',
                'content' => 'Ramesh Patil from Katol shares his success story of how he doubled his income by directly connecting with traders through digital platforms. By eliminating middlemen and using online marketplaces, he was able to get better prices for his produce and build long-term relationships with buyers.',
                'thumbnail' => 'images/news/success-story.jpg',
                'source' => 'Farmer Success Stories',
                'published_at' => Carbon::now()->subDays(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'New Variety of Mandarin Shows Disease Resistance',
                'content' => 'Researchers have developed a new variety of Nagpur Mandarin that shows excellent resistance to common citrus diseases. The variety, named "Nagpur Gold", maintains the traditional taste while offering better shelf life and disease resistance. Saplings will be available to farmers from next season.',
                'thumbnail' => 'images/news/new-variety.jpg',
                'source' => 'Agricultural Research',
                'published_at' => Carbon::now()->subDays(11),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('news')->insert($news);
    }
}
