<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Service;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(6),
            'description' => $this->faker->paragraph(),
            'price' =>  $this->faker->numberBetween(100, 5000),
            'available' => $this->faker->boolean(),
        ];
    }
}