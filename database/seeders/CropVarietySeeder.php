<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CropVarietySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $varieties = [
            [
                'name' => 'Nagpur Mandarin',
                'image_url' => 'images/varieties/nagpur-mandarin.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nagpur Orange',
                'image_url' => 'images/varieties/nagpur-orange.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kinnow',
                'image_url' => 'images/varieties/kinnow.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mosambi (Sweet Lime)',
                'image_url' => 'images/varieties/mosambi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Blood Orange',
                'image_url' => 'images/varieties/blood-orange.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Valencia Orange',
                'image_url' => 'images/varieties/valencia-orange.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('crop_varieties')->insert($varieties);
    }
}
