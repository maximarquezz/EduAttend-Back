<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_name',
        'subject_year',
        'degree_id'
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
