<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    protected $fillable = [
        'name',
        'short_name',
        'code',
        'description',
        'founded',
        'headquarters',
        'fleet_size',
        'destinations',
        'website',
        'flag_url',
        'badge_color',
    ];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}