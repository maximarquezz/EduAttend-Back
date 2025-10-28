<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comission extends Model
{
    protected $fillable = [
        'comission_name',
        'comission_year',
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
