<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


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
}
