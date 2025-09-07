<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Booking;



class Therapist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialization',
        'experience_years',
        'consultation_fee',
        'languages',
        'rating',
        'is_verified',
        'availability',
        'description',
        'image'
    ];

    protected $casts = [
        'availability' => 'array', // JSON to array
        'is_verified' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookings()
{
    return $this->hasMany(Booking::class);
}
public function availabilities()
{
    return $this->hasMany(\App\Models\Availability::class);
}



}
