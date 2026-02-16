<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Hotel;
use App\Models\HotelDetail;
use App\Models\PaymentMethod;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hotel_id',
        'hotel_detail_id',
        'payment_method_id',

        // guest info
        'guest_first_name',
        'guest_last_name',
        'guest_age',
        'guest_email',
        'guest_address',
        'guest_phone',

        // accommodation
        'guests_count',
        'rooms_count',
        'check_in_date',
        'check_out_date',
        'check_in_time',
        'special_request',

        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // reservation belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // reservation belongs to hotel
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    // reservation belongs to room (hotel_details)
    public function room()
    {
        return $this->belongsTo(HotelDetail::class, 'hotel_detail_id');
    }

    // reservation belongs to payment method
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
