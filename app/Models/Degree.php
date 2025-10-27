<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Degree extends Model
{
    use HasFactory;

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
