<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\PhotoSet;
use App\Models\GeoLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'for_sale' => $this->faker->boolean(),
            'for_rent' => $this->faker->boolean(),
            'sold' => $this->faker->boolean(),
            'price' => $this->faker->numberBetween(100000, 1000000),
            'currency' => 'THB',
            'currency_symbol' => '฿',
            'property_type' => $this->faker->word(),
            'bedrooms' => $this->faker->numberBetween(1, 5),
            'bathrooms' => $this->faker->numberBetween(1, 3),
            'area' => $this->faker->numberBetween(50, 150),
            'area_type' => 'sqm',
            'geo_location_id' => GeoLocation::factory(),
            'photo_set_id' => PhotoSet::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
