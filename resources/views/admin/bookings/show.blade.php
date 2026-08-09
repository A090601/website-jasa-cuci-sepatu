@extends('admin.layouts.app')

@section('title', 'Detail Booking')

@section('content')

    <div class="max-w-4xl mx-auto">

        <div class="bg-white rounded-2xl shadow p-8">

            <div class="flex justify-between items-center mb-8">

                <h1 class="text-3xl font-bold">
                    Detail Booking
                </h1>

                <a href="{{ route('admin.bookings.index') }}" class="bg-gray-200 hover:bg-gray-300 px-5 py-3 rounded-xl">

                    Kembali

                </a>

            </div>

            <div class="grid md:grid-cols-2 gap-6">

                <div>
                    <label class="text-gray-500">Nomor Booking</label>
                    <div class="font-bold text-xl text-indigo-600">
                        {{ $booking->booking_code }}
                    </div>
                </div>

                <div>
                    <label class="text-gray-500">Nama Pelanggan</label>

                    <div class="font-semibold text-lg">
                        {{ $booking->customer_name }}
                    </div>
                </div>

                <div>
                    <label class="text-gray-500">Nomor HP</label>

                    <div class="font-semibold text-lg">
                        {{ $booking->phone }}
                    </div>
                </div>

                <div>
                    <label class="text-gray-500">Layanan</label>

                    <div class="font-semibold text-lg">
                        {{ $booking->service->name }}
                    </div>
                </div>

                <div class="mt-4">
                    <p class="text-gray-500 text-sm">
                        Paket
                    </p>

                    <p class="font-semibold">
                        {{ $booking->price->package_name ?? '-' }}
                    </p>
                </div>

                <div>
                    <label class="text-gray-500">Total Harga</label>

                    <div class="font-semibold text-lg text-indigo-600">
                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                    </div>
                </div>

                <div>
                    <label class="text-gray-500">Tanggal</label>

                    <div class="font-semibold text-lg">
                        {{ $booking->booking_date }}
                    </div>
                </div>

                <div>
                    <label class="text-gray-500">Jam</label>

                    <div class="font-semibold text-lg">
                        {{ $booking->booking_time }}
                    </div>
                </div>

                <div>
                    <label class="text-gray-500">Merk Sepatu</label>

                    <div class="font-semibold text-lg">
                        {{ $booking->shoe_brand }}
                    </div>
                </div>

                <div>
                    <label class="text-gray-500">Jenis Sepatu</label>

                    <div class="font-semibold text-lg">
                        {{ $booking->shoe_type }}
                    </div>
                </div>

            </div>

            @if ($booking->shoe_photo)
                <div class="mt-8">
                    <label class="text-gray-500 block mb-2">
                        Foto Sepatu
                    </label>

                    <img src="{{ asset('storage/' . $booking->shoe_photo) }}" alt="Foto Sepatu"
                        class="w-80 h-auto rounded-xl border shadow-lg object-cover">
                </div>
            @endif

            <div class="md:col-span-2 mt-6">

                <label class="text-gray-500 font-semibold text-lg">
                    Dokumentasi Sepatu
                </label>

                <div class="grid md:grid-cols-2 gap-8 mt-4">

                    {{-- Foto Sebelum --}}
                    <div>

                        <p class="font-semibold mb-3 text-gray-700">
                            📷 Sebelum Dicuci
                        </p>

                        @if ($booking->shoe_photo)
                            <a href="{{ asset('storage/' . $booking->shoe_photo) }}" target="_blank">
                                <img src="{{ asset('storage/' . $booking->shoe_photo) }}"
                                    class="w-full h-72 object-cover rounded-xl border shadow hover:scale-105 transition cursor-pointer">
                            </a>
                        @else
                            <div class="h-72 border rounded-xl flex items-center justify-center bg-gray-100 text-gray-400">
                                Belum ada foto
                            </div>
                        @endif

                    </div>

                    {{-- Foto Sesudah --}}
                    <div>

                        <p class="font-semibold mb-3 text-gray-700">
                            ✨ Sesudah Dicuci
                        </p>

                        @if ($booking->after_photo)
                            <a href="{{ asset('storage/' . $booking->after_photo) }}" target="_blank">
                                <img src="{{ asset('storage/' . $booking->after_photo) }}"
                                    class="w-full h-72 object-cover rounded-xl border shadow hover:scale-105 transition cursor-pointer">
                            </a>
                        @else
                            <div class="h-72 border rounded-xl flex items-center justify-center bg-gray-100 text-gray-400">
                                Belum ada foto hasil cuci
                            </div>
                        @endif

                    </div>

                </div>

            </div>

            <div class="mt-8">

                <label class="text-gray-500">
                    Catatan
                </label>

                <div class="border rounded-xl p-4 mt-2">
                    {{ $booking->note ?? '-' }}
                </div>

                <div class="mt-8">

                    <label class="text-gray-500 font-medium">
                        Status Booking
                    </label>

                    <div class="mt-2">

                        @if ($booking->status == 'pending')
                            <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full">
                                Pending
                            </span>
                        @elseif($booking->status == 'process')
                            <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full">
                                Diproses
                            </span>
                        @else
                            <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full">
                                Selesai
                            </span>
                        @endif

                    </div>

                </div>

                <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="mt-8">

                    @csrf
                    @method('PUT')

                    <input type="hidden" name="customer_name" value="{{ $booking->customer_name }}">
                    <input type="hidden" name="phone" value="{{ $booking->phone }}">
                    <input type="hidden" name="service_id" value="{{ $booking->service_id }}">
                    <input type="hidden" name="price_id" value="{{ $booking->price_id }}">
                    <input type="hidden" name="booking_date" value="{{ $booking->booking_date }}">
                    <input type="hidden" name="booking_time" value="{{ $booking->booking_time }}">

                    <label class="block mb-2 font-semibold">
                        Ubah Status
                    </label>

                    <select name="status" class="border rounded-xl px-4 py-3 w-full">

                        <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="process" {{ $booking->status == 'process' ? 'selected' : '' }}>
                            Diproses
                        </option>

                        <option value="done" {{ $booking->status == 'done' ? 'selected' : '' }}>
                            Selesai
                        </option>

                    </select>

                    <button class="mt-6 bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl">

                        Simpan Status

                    </button>

                    @php
                        $message =
                            "Halo {$booking->customer_name},%0A%0A" .
                            'Booking Anda telah kami terima.%0A%0A' .
                            "📌 Layanan : {$booking->service->name}%0A" .
                            "📅 Tanggal : {$booking->booking_date}%0A" .
                            "🕒 Jam : {$booking->booking_time}%0A" .
                            '📋 Status : ' .
                            ucfirst($booking->status) .
                            '%0A%0A' .
                            'Terima kasih telah menggunakan ShoeWash 🙏';
                    @endphp

                    <a href="https://wa.me/62{{ ltrim($booking->phone, '0') }}?text={{ $message }}" target="_blank"
                        class="inline-flex items-center mt-4 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl">

                        📱 Konfirmasi via WhatsApp

                    </a>

                </form>

            </div>

        </div>

    </div>

@endsection
