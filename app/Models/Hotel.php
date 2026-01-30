<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    public function region()
    {
        return $this->belongsTo(Region::class);
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
