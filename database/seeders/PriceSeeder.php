<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Price;
use App\Models\Service;

class PriceSeeder extends Seeder
{
    public function run(): void
    {
        $fastClean = Service::where('slug', 'fast-clean')->first();
        $deepClean = Service::where('slug', 'deep-clean')->first();
        $whitening = Service::where('slug', 'whitening')->first();
        $repaint = Service::where('slug', 'repaint')->first();

        Price::insert([
            [
                'service_id' => $fastClean->id,
                'package_name' => 'Reguler',
                'price' => 25000,
                'duration' => '2 Hari',
            ],
            [
                'service_id' => $deepClean->id,
                'package_name' => 'Reguler',
                'price' => 45000,
                'duration' => '3 Hari',
            ],
            [
                'service_id' => $whitening->id,
                'package_name' => 'Reguler',
                'price' => 35000,
                'duration' => '2 Hari',
            ],
            [
                'service_id' => $repaint->id,
                'package_name' => 'Reguler',
                'price' => 85000,
                'duration' => '5 Hari',
            ],
        ]);
    }
}
