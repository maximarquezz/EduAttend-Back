<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    public function Person(): HasMany
    {
        return $this->hasMany(Person::class);
    }

    public function Province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }
}
