<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MidComissionSubject extends Model
{
    public function Subject(): HasMany
    {
        return $this->hasMany(Subject::class);
    }

    public function Comission(): HasMany
    {
        return $this->hasMany(Comission::class);
    }

    public function Assignment(): HasMany
    {
        return $this->hasMany(Assignment::class);
    }
}
