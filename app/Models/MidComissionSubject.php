<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MidComissionSubject extends Model
{
    protected $table = 'mid_comissions_subjects';

    protected $fillable = [
        'comission_id',
        'subject_id'
    ];

    public function Subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function Comission(): BelongsTo
    {
        return $this->belongsTo(Comission::class);
    }

    public function Assignment(): HasMany
    {
        return $this->hasMany(Assignment::class);
    }
}
