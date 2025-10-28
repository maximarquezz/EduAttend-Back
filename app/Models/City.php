<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $fillable = [
        'city_name',
        'city_postalcode',
        'province_id'
    ];

    public function User(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function Province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }
}
