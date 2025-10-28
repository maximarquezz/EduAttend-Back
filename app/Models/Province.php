<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    protected $fillable = [
        'province_name'
    ];

    public function City(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
