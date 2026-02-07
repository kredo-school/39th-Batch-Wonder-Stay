<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Region;
use App\Models\HotelPhoto;
use App\Models\Hotel;

class Hotel extends Model
{
    protected $fillable = [
        'name',
        'concept',
        'feature',
        'service',
        'description',
        'address',
        'phone',
        'email',
        'region_id',
        'country_id',
        'city_id',
    ];

    protected $casts = [
        'service' => 'array',
        'feature' => 'array',
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

    public function photos()
    {
        return $this->hasMany(HotelPhoto::class);
    }

    public function mainPhoto()
    {
        return $this->hasOne(HotelPhoto::class)
                    ->where('is_main', true);
    }
}

