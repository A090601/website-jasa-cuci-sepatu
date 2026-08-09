<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            ServiceSeeder::class,
            PriceSeeder::class,
            GallerySeeder::class,
            TestimonialSeeder::class,
            SettingSeeder::class,
            BookingSeeder::class,
        ]);
    }
}
