<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Therapist;
use App\Models\User;


class Booking extends Model
{
     protected $fillable = ['user_id','therapist_id','session_date','session_time','status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function therapist()
    {
        return $this->belongsTo(Therapist::class);
    }
    public function patient()
{
    return $this->belongsTo(User::class, 'user_id');
}


}
