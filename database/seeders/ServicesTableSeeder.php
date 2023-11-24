<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Service::factory()->create([
            'name' => 'Usługa dostępu do danych meteo',
            'description' => 'Podgląd danych meteo z zamówionej usługi',
            'price' => 1000,
            'available' => true,
        ]);

        Service::factory()->count(11)->create();
    }
}
