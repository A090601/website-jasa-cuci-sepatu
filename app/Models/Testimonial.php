<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'booking_id',
        'customer_name',
        'photo',
        'rating',
        'message',
        'is_active',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
