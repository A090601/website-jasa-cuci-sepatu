<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Gallery;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        $booking = Booking::count();
        $service = Service::count();
        $gallery = Gallery::count();
        $testimonial = Testimonial::count();

        $todayBooking = Booking::whereDate('booking_date', today())->count();

        $latestBookings = Booking::with('service')
            ->latest()
            ->take(10)
            ->get();

        $chart = [];

        for ($i = 1; $i <= 12; $i++) {
            $chart[] = Booking::whereYear('created_at', now()->year)
                ->whereMonth('created_at', $i)
                ->count();
        }

        $revenue = Booking::where('status', 'done')
            ->sum('total_price');

        $pending = Booking::where('status', 'pending')->count();

        $process = Booking::where('status', 'process')->count();

        $done = Booking::where('status', 'done')->count();

        return view('admin.dashboard', compact(
            'booking',
            'service',
            'gallery',
            'testimonial',
            'todayBooking',
            'latestBookings',
            'chart',
            'revenue',
            'pending',
            'process',
            'done',
        ));
    }
}
