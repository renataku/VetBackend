<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'breed_id',
        'name',
        'date_of_birth',
        'gender'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function breed(): BelongsTo
    {
        return $this->belongsTo(Breed::class);
    }

    public function species(): HasOneThrough
    {
        return $this->hasOneThrough(Species::class, Breed::class, 'id', 'id', 'breed_id', 'species_id');
    }
}
