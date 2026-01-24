<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }
}
