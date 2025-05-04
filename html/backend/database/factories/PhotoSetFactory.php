<?php

namespace Database\Factories;

use App\Models\PhotoSet;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoSetFactory extends Factory
{
    protected $model = PhotoSet::class;

    public function definition()
    {
        return [
            'thumb' => $this->faker->imageUrl(150, 100),
            'search' => $this->faker->imageUrl(300, 150),
            'full' => $this->faker->imageUrl(600, 300),
        ];
    }
}
