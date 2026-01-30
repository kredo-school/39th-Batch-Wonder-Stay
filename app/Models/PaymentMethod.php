<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'name',
        'code',
        'type',
        'is_enabled',
    ];

    public function isEnabled(): bool
    {
        return (bool) $this->is_enabled;
    }
}
