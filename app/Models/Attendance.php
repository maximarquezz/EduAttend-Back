<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    protected $fillable = [
        'enrollment_id',
        'attendance_date',
        'attendance_status',
        'notes'
    ];

    protected $casts = [
        'attendance_date' => 'date',
    ];

    public function Enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }
}
