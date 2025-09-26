<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'trip_id', 'user_id', 'booked_at', 'first_name', 'last_name', 'email', 'phone', 'passport_number', 'date_of_birth', 'seat'
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}