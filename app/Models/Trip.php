<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'flight_number',
        'airline_id',
        'origin',
        'destination',
        'flight_date',
        'flight_time',
        'price',
        'capacity',
        'aircraft_type',
        'status',
        'created_by',
    ];

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}