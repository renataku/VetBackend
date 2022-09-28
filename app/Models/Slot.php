<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

/**
 * @property DateTimeInterface $date_from
 * @property DateTimeInterface $date_to
 * @property string $status
 * @property int $service_id
 */

class Slot extends Model
{
    public const CREATED = 'CREATED';
    public const RESERVED = 'RESERVED';
    public const CANCELLED = 'CANCELLED';

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function appointment()
    {
        return $this->hasOne(Appointment::class);
    }
}
