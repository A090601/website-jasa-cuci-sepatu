<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\Price;
use App\Models\Gallery;
use App\Models\Testimonial;
use App\Models\Setting;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingController extends Controller
{
    public function create()
    {
        $services = Service::where('is_active', 1)->get();

        $prices = Price::with('service')->get();

        return view('frontend.booking', compact(
            'services',
            'prices'
        ));
    }

    public function statusForm()
    {
        return view('frontend.status');
    }

    public function checkStatus(Request $request)
    {
        $request->validate([
            'phone' => 'required'
        ]);

        $bookings = Booking::with(['service', 'price'])
            ->where('phone', $request->phone)
            ->latest()
            ->get();

        $setting = Setting::first();

        $services = Service::where('is_active', 1)->get();

        $prices = Price::with('service')->get();

        $galleries = Gallery::where('is_active', 1)->get();

        $testimonials = Testimonial::latest()->get();

        return view('frontend.home', compact(
            'services',
            'prices',
            'galleries',
            'testimonials',
            'setting',
            'bookings'
        ));
    }
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|max:255',
            'phone' => 'required|max:20',

            'service_id' => 'required|exists:services,id',
            'price_id' => 'required|exists:prices,id',
            'quantity' => 'required|integer|min:1',

            'booking_date' => 'required|date',
            'booking_time' => 'required',

            'shoe_type' => 'nullable|max:255',
            'shoe_brand' => 'nullable|max:255',

            'shoe_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'note' => 'nullable',
        ]);

        $shoePhoto = null;

        if ($request->hasFile('shoe_photo')) {
            $shoePhoto = $request->file('shoe_photo')
                ->store('shoe_photos', 'public');
        }

        $price = Price::findOrFail($request->price_id);

        $quantity = (int) $request->quantity;
        $totalPrice = $price->price * $quantity;

        $lastBooking = Booking::latest('id')->first();

        $next = $lastBooking ? $lastBooking->id + 1 : 1;

        $bookingCode = 'SW-' . str_pad($next, 6, '0', STR_PAD_LEFT);

        $booking = Booking::create([
            'booking_code' => $bookingCode,
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'service_id' => $request->service_id,
            'price_id' => $request->price_id,
            'quantity' => $quantity,
            'total_price' => $totalPrice,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'shoe_brand' => $request->shoe_brand,
            'shoe_type' => $request->shoe_type,
            'shoe_photo' => $shoePhoto,
            'note' => $request->note,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('booking.success', $booking)
            ->with('booking_success', 'Booking Anda berhasil dibuat.');
    }

    public function success(Booking $booking)
    {
        $booking->load('service');

        $message = "Halo Admin ShoeWash 👋

Saya baru saja melakukan booking.

Nomor Booking : {$booking->booking_code}
Nama : {$booking->customer_name}
No HP : {$booking->phone}
Layanan : {$booking->service->name}
Tanggal : {$booking->booking_date}
Jam : {$booking->booking_time}
Total : Rp " . number_format($booking->total_price, 0, ',', '.') . "

Mohon konfirmasi booking saya.

Terima kasih.";

        $waLink =
            "https://wa.me/" .
            env('ADMIN_WHATSAPP') .
            "?text=" .
            urlencode($message);

        return view(
            'frontend.booking-success',
            compact('booking', 'waLink')
        );
    }

    public function nota(Booking $booking)
    {
        $booking->load(['service', 'price']);

        $pdf = Pdf::loadView(
            'frontend.booking-nota',
            compact('booking')
        );

        return $pdf->download(
            'Nota-' . $booking->booking_code . '.pdf'
        );
    }
}
