<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelDetail extends Model
{
    /**
     * Table name
     */
    protected $table = 'hotel_details';

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'hotel_id',
        'room_number',
        'price',
        'size_area',
        'capacity',
        'bed_type',
        'amenities',
    ];

    /**
     * Casts
     * amenities は text だけど、将来 JSON 化しやすいように array に
     */
    protected $casts = [
        'amenities' => 'array',
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
}
