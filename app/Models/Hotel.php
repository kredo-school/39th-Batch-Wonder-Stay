<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'name',
        'region_id',
        'description',
        'address',
        'phone',
        'email',
        'photos',
    ];

    // The photos column is stored as JSON in the database and should be handled as an array in PHP
    protected $casts = [
        'photos' => 'array',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
