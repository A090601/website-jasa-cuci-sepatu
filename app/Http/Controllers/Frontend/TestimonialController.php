<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function create(Booking $booking)
    {
        if ($booking->status != 'done') {
            return redirect()->route('home')
                ->with('error', 'Booking belum selesai.');
        }

        return view('frontend.testimonial', compact('booking'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|max:1000',
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        Testimonial::create([
            'customer_name' => $booking->customer_name,
            'rating' => $request->rating,
            'message' => $request->message,
            'photo' => null,
            'is_active' => true,
        ]);

        return redirect()
            ->route('home')
            ->with('success', 'Terima kasih! Testimoni Anda berhasil dikirim.');
    }
}
