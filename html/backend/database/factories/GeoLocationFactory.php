<?php

namespace Database\Factories;

use App\Models\GeoLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class GeoLocationFactory extends Factory
{
    protected $model = GeoLocation::class;

    public function definition()
    {
        return [
            'country' => $this->faker->country(),
            'province' => $this->faker->state(),
            'street' => $this->faker->address(),
        ];
    }
}
