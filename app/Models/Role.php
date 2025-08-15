<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    public function Person(): HasMany
    {
        return $this->hasMany(Person::class);
    }
}
