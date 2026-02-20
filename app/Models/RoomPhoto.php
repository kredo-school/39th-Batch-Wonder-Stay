<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomPhoto extends Model
{
    protected $fillable = [
        'hotel_detail_id',
        'path',
        'sort_order',
        'is_main',
    ];

    public function room()
    {
        return $this->belongsTo(HotelDetail::class);
    }
}

