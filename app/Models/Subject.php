<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    protected $fillable = [
        'subject_name',
        'subject_year'
    ];

    public function Degree(): BelongsTo
    {
        return $this->belongsTo(Degree::class);
    }

    public function MidComissionSubject(): HasMany
    {
        return $this->hasMany(MidComissionSubject::class);
    }
}
