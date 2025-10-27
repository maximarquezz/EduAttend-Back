<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Person extends Model
{
    public function City(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
