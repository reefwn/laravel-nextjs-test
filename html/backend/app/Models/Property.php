<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Property extends Model
{
    protected $fillable = [
        'title',
        'description',
        'for_sale',
        'for_rent',
        'sold',
        'price',
        'currency',
        'currency_symbol',
        'property_type',
        'bedrooms',
        'bathrooms',
        'area',
        'area_type',
        'geo_location_id',
        'photo_set_id',
    ];

    public function geoLocation(): BelongsTo
    {
        return $this->belongsTo(GeoLocation::class);
    }

    public function photoSet(): BelongsTo
    {
        return $this->belongsTo(PhotoSet::class);
    }
}
