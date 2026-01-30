<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
     use HasFactory;

    protected $fillable = [
        'name',
        'code',
    ];

    public function cities()
{
    return $this->hasMany(\App\Models\City::class);
}

public function region()
{
    return $this->belongsTo(Region::class);
}

}
