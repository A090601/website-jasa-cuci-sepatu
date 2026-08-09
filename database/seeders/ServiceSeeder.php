<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::insert([
            [
                'name' => 'Fast Clean',
                'slug' => 'fast-clean',
                'description' => 'Pembersihan cepat',
                'is_active' => 1,
            ],
            [
                'name' => 'Deep Clean',
                'slug' => 'deep-clean',
                'description' => 'Cuci mendalam',
                'is_active' => 1,
            ],
            [
                'name' => 'Whitening',
                'slug' => 'whitening',
                'description' => 'Memutihkan sole',
                'is_active' => 1,
            ],
            [
                'name' => 'Repaint',
                'slug' => 'repaint',
                'description' => 'Cat ulang sepatu',
                'is_active' => 1,
            ],
        ]);
    }
}
