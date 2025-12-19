<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run seeders in order (respecting foreign key constraints)
        $this->call([
            CropVarietySeeder::class,      // 1. Master data first
            UserSeeder::class,              // 2. Users (farmers & traders)
            MarketPriceSeeder::class,       // 3. Market prices (depends on crop_varieties)
            YieldSeeder::class,             // 4. Yields (depends on users & crop_varieties)
            RequirementSeeder::class,       // 5. Requirements (depends on users & crop_varieties)
            BidSeeder::class,               // 6. Bids (depends on yields & users)
            NotificationSeeder::class,      // 7. Notifications (depends on users)
            NewsSeeder::class,              // 8. News (independent)
        ]);

        $this->command->info('Database seeded successfully!');
        $this->command->info('');
        $this->command->info('Test Credentials:');
        $this->command->info('==================');
        $this->command->info('Admin:');
        $this->command->info('  Mobile: 9999999999 | Password: password');
        $this->command->info('');
        $this->command->info('Farmers:');
        $this->command->info('  Mobile: 9876543210 | Password: password (Ramesh Patil)');
        $this->command->info('  Mobile: 9876543211 | Password: password (Suresh Deshmukh)');
        $this->command->info('');
        $this->command->info('Traders:');
        $this->command->info('  Mobile: 9123456780 | Password: password (Rajesh Agarwal)');
        $this->command->info('  Mobile: 9123456781 | Password: password (Mahesh Gupta)');
    }
}
