<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RoomPhoto;   // ← IMPORTANT


class HotelDetail extends Model
{
    protected $table = 'hotel_details';

    public $timestamps = false;

    protected $fillable = [
        'hotel_id',
        'room_number',
        'price',
        'size_area',
        'capacity',
        'bed_type',
        'amenities',
        'is_active',

    ];

   
   protected $casts = [
    'price'     => 'decimal:2',
    'size_area' => 'decimal:2',
];


    /**
     * Relationships
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function reservations(){ return $this->hasMany(Reservation::class); }
    public function photos()
{
    return $this->hasMany(RoomPhoto::class)
                ->orderByDesc('is_main')   
                ->orderBy('sort_order');   
}

}
