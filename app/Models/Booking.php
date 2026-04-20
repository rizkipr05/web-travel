<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'schedule_id', 'user_id', 'booking_code', 'user_name', 'phone', 
        'pickup_address', 'dropoff_address', 'total_passengers', 
        'total_price', 'payment_token', 'status', 'payment_proof'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function bookedSeats()
    {
        return $this->hasMany(BookedSeat::class);
    }
}
