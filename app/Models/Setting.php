<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [

        'site_name',
        'site_description',

        'phone',
        'email',
        'address',
        'google_maps',

        'instagram',
        'facebook',
        'tiktok',
        'whatsapp',

        'meta_title',
        'meta_description',
        'meta_keywords',

        'copyright',

        'logo',
        'favicon',

    ];
}
