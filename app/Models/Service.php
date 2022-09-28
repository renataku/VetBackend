<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $title
 * @property bool $enabled
 * @property int $slotIntervalInMinutes
 * @property int $employee_id
 */
class Service extends Model
{
    use HasFactory;

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
