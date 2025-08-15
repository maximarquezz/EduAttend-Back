<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Degree extends Model
{
    protected $fillable = ['degree_name'];

    public function Subject(): HasMany
    {
        return $this->hasMany(Subject::class);
    }

    public function Comission(): HasMany
    {
        return $this->hasMany(Comission::class);
    }
}
