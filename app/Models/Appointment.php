<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'slot_id',
        'client_id',
        'pet_id',
        'description',
        'closed'
    ];

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
