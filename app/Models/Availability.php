<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Availability extends Model
{
     use HasFactory;

    protected $fillable = [
        'therapist_id',
        'available_date',
        'start_time',
        'end_time',
        'is_booked', // <-- add this line
    ];

    public function therapist()
    {
        return $this->belongsTo(Therapist::class);
    }
}
