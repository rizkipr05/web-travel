<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = ['origin', 'destination', 'price', 'estimated_duration'];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
