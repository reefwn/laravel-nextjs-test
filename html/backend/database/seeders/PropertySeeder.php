<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\GeoLocation;
use App\Models\PhotoSet;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = Storage::get('seeds/properties.json');
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $geo = GeoLocation::create([
                'country' => $item['geo']['country'] ?? null,
                'province' => $item['geo']['province'] ?? null,
                'street' => $item['geo']['street'] ?? null,
            ]);

            $photoSet = PhotoSet::create([
                'thumb' => $item['photos']['thumb'] ?? null,
                'search' => $item['photos']['search'] ?? null,
                'full' => $item['photos']['full'] ?? null,
            ]);

            Property::create([
                'title' => $item['title'],
                'description' => $item['description'],
                'for_sale' => $item['for_sale'],
                'for_rent' => $item['for_rent'],
                'sold' => $item['sold'],
                'price' => $item['price'],
                'currency' => $item['currency'],
                'currency_symbol' => $item['currency_symbol'],
                'property_type' => $item['property_type'],
                'bedrooms' => $item['bedrooms'],
                'bathrooms' => $item['bathrooms'],
                'area' => $item['area'],
                'area_type' => $item['area_type'],
                'geo_location_id' => $geo->id,
                'photo_set_id' => $photoSet->id,
            ]);
        }
    }
}
