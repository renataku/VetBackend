<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    use HasFactory;

    public function species(): BelongsTo
    {
        return $this->belongsTo(Species::class);
    }

    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }
}
