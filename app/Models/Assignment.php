<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assignment extends Model
{

    protected $fillable = [
        'user_id',
        'mid_comissions_subjects_id',
        'assign_type'
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function MidComissionSubject(): BelongsTo
    {
        return $this->belongsTo(MidComissionSubject::class);
    }
}
