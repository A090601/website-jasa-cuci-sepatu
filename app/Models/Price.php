<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
        'service_id',
        'package_name',
        'price',
        'duration',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
