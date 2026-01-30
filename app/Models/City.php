<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'region_id', 
        'country_id',
        'name',
    ];

    // Get the region this city belongs to
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    // Get the country this city belongs to
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
