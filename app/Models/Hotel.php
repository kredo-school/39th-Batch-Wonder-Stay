<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
