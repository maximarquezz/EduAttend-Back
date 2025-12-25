<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Enrollment extends Model
{
    protected $fillable = [
        'user_id',
        'mid_comission_subject_id',
        'enrollment_year',
        'enrollment_status'
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function MidComissionSubject(): BelongsTo
    {
        return $this->belongsTo(MidComissionSubject::class);
    }

    public function Attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
}
