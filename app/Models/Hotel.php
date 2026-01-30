<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'name',
        'city_id',
        'region_id',
        'country_id',
        'description',
        'address',
        'phone',
        'email',
        'photos',
    ];

    protected $casts = [
        'photos' => 'array',
    ];

    // Hotel belongs to Country
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}

