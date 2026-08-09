<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Price;
use App\Models\Gallery;
use App\Models\Testimonial;
use App\Models\Setting;


class HomeController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        $services = Service::where('is_active', 1)->get();

        $prices = Price::with('service')->get();

        $galleries = Gallery::where('is_active', 1)->get();

        $testimonials = Testimonial::where('is_active', 1)
            ->latest()
            ->get();

        $bookings = null;

        return view('frontend.home', compact(
            'services',
            'prices',
            'galleries',
            'testimonials',
            'setting',
            'bookings'
        ));
    }
}
