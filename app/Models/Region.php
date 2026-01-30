<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Country;


class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
    ];

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function countries()
    {
        return $this->hasMany(Country::class);
    }
}
