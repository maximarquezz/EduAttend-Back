<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assignment extends Model
{
    public function Person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function MidComissionSubject(): BelongsTo
    {
        return $this->belongsTo(MidComissionSubject::class);
    }
}
