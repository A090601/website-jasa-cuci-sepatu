@extends('layouts.frontend')

@section('content')
    <div class="min-h-screen bg-slate-100 py-24">

        <div class="max-w-3xl mx-auto px-6">

            <div class="bg-white rounded-3xl shadow-xl p-10">

                <div class="text-center">

                    <div class="text-6xl mb-4">
                        🎉
                    </div>

                    <h1 class="text-4xl font-bold text-green-600">
                        Booking Berhasil
                    </h1>

                    <p class="text-gray-500 mt-3">
                        Terima kasih. Booking Anda telah berhasil dikirim.
                    </p>

                </div>

                <div class="mt-10 bg-slate-50 rounded-2xl p-6">

                    <div class="mb-6">

                        <p class="text-sm text-gray-500">
                            Nomor Booking
                        </p>

                        <h2 class="text-3xl font-bold text-indigo-600">
                            {{ $booking->booking_code }}
                        </h2>

                    </div>

                    <div class="grid md:grid-cols-2 gap-5">

                        <div>
                            <p class="text-gray-500 text-sm">Nama</p>
                            <p class="font-semibold">{{ $booking->customer_name }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">Nomor WhatsApp</p>
                            <p class="font-semibold">{{ $booking->phone }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">Layanan</p>
                            <p class="font-semibold">{{ $booking->service->name }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">Tanggal</p>
                            <p class="font-semibold">{{ $booking->booking_date }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">Jam</p>
                            <p class="font-semibold">{{ $booking->booking_time }}</p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">Total</p>
                            <p class="font-bold text-green-600">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="md:col-span-2">
                            <p class="text-gray-500 text-sm">Status</p>

                            <span class="inline-flex bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full font-semibold">
                                Pending
                            </span>
                        </div>

                    </div>

                </div>

                <div class="mt-8">

                    <a href="{{ $waLink }}" target="_blank"
                        class="block w-full bg-green-600 hover:bg-green-700 text-white text-center font-semibold py-4 rounded-xl transition">

                        Hubungi Admin via WhatsApp

                    </a>

                </div>

            </div>

        </div>

    </div>
@endsection
