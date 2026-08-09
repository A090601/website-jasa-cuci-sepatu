<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'booking_code',
        'customer_name',
        'phone',
        'service_id',
        'price_id',
        'booking_date',
        'booking_time',
        'shoe_type',
        'shoe_brand',
        'shoe_photo',
        'after_photo',
        'note',
        'status',
        'total_price',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function price()
    {
        return $this->belongsTo(Price::class);
    }

    public function testimonial()
    {
        return $this->hasOne(Testimonial::class);
    }
}
