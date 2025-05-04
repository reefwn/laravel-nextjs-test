<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GeoLocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'country',
        'province',
        'street',
    ];

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
}
