<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Price;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\BookingsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with('service');

        // Search nama / nomor HP
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('customer_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter status
        if ($request->filled('status')) {

            $query->where('status', $request->status);
        }

        $bookings = $query
            ->latest()
            ->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function exportExcel()
    {
        return Excel::download(
            new BookingsExport,
            'laporan-booking.xlsx'
        );
    }

    public function create()
    {
        $services = Service::where('is_active', 1)->get();

        $prices = Price::all();

        return view(
            'admin.bookings.create',
            compact('services', 'prices')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'service_id' => 'required|exists:services,id',
            'price_id' => 'required|exists:prices,id',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'shoe_type' => 'nullable|string|max:255',
            'shoe_brand' => 'nullable|string|max:255',
            'shoe_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:40960',
            'note' => 'nullable|string',
        ]);

        $price = Price::findOrFail($request->price_id);

        $lastBooking = Booking::latest('id')->first();

        $next = $lastBooking ? $lastBooking->id + 1 : 1;

        $bookingCode = 'SW-' . str_pad($next, 6, '0', STR_PAD_LEFT);

        $shoePhoto = null;

        if ($request->hasFile('shoe_photo')) {
            $shoePhoto = $request->file('shoe_photo')
                ->store('shoe-photos', 'public');
        }

        Booking::create([
            'booking_code' => $bookingCode,
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'service_id' => $request->service_id,
            'price_id' => $request->price_id,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'shoe_type' => $request->shoe_type,
            'shoe_brand' => $request->shoe_brand,
            'shoe_photo' => $shoePhoto,
            'note' => $request->note,
            'status' => 'pending',
            'total_price' => $price->price,
        ]);

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking berhasil ditambahkan.');
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $services = Service::where('is_active', 1)->get();

        $prices = Price::all();

        return view(
            'admin.bookings.edit',
            compact(
                'booking',
                'services',
                'prices'
            )
        );
    }

     public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'service_id' => 'required|exists:services,id',
            'price_id' => 'required|exists:prices,id',
            'booking_date' => 'required|date',
            'booking_time' => 'required',

            'shoe_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'after_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',

            'status' => 'required|in:pending,process,done',
        ]);

        $price = Price::findOrFail($request->price_id);

        $shoePhoto = $booking->shoe_photo;

        if ($request->hasFile('shoe_photo')) {

            if ($booking->shoe_photo && Storage::disk('public')->exists($booking->shoe_photo)) {
                Storage::disk('public')->delete($booking->shoe_photo);
            }
            $shoePhoto = $request->file('shoe_photo')
                ->store('shoe-photos', 'public');
        }

        $afterPhoto = $booking->after_photo;

        if ($request->hasFile('after_photo')) {

            if ($booking->after_photo && Storage::disk('public')->exists($booking->after_photo)) {
                Storage::disk('public')->delete($booking->after_photo);
            }

            $afterPhoto = $request->file('after_photo')
                ->store('after-photos', 'public');
        }

        $booking->update([
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'service_id' => $request->service_id,
            'price_id' => $request->price_id,
            'total_price' => $price->price,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'shoe_photo' => $shoePhoto,
            'after_photo' => $afterPhoto,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking berhasil diperbarui.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Booking berhasil dihapus.');
    }

    public function exportPdf()
    {
        $bookings = Booking::with('service')
            ->latest()
            ->get();

        $pdf = Pdf::loadView(
            'admin.bookings.pdf',
            compact('bookings')
        );

        return $pdf->download('laporan-booking.pdf');
    }
}
