@extends('layouts.frontend')

@section('content')

    <div class="min-h-screen bg-slate-100 pt-32 pb-24">

        <div class="max-w-4xl mx-auto px-6">

            <div class="text-center mb-10">

                <h1 class="text-4xl font-bold text-slate-800">
                    Cek Status Pesanan
                </h1>

                <p class="text-slate-500 mt-3">
                    Masukkan nomor WhatsApp yang digunakan saat booking.
                </p>

            </div>

            <form action="{{ route('booking.checkStatus') }}" method="POST" class="flex gap-4 mb-10">

                @csrf

                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Masukkan Nomor WhatsApp"
                    class="flex-1 border border-slate-300 rounded-xl px-5 py-4 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    required>

                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-10 rounded-xl transition">
                    Cari
                </button>

            </form>

            @isset($bookings)
                @forelse($bookings as $booking)
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition p-6 mb-6">

                        <div>

                            <h2 class="text-2xl font-bold text-slate-800">
                                {{ $booking->customer_name }}
                            </h2>

                            <p class="text-slate-600 mt-2">
                                📱 {{ $booking->phone }}
                            </p>

                            <div class="mt-5 space-y-3">

                                <p class="text-slate-600">
                                    🧽
                                    <span class="font-medium">Layanan :</span>
                                    {{ $booking->service->name ?? '-' }}
                                </p>

                                <p class="text-slate-600">
                                    📦
                                    <span class="font-medium">Paket :</span>
                                    {{ $booking->price->package_name ?? '-' }}
                                </p>

                                <p class="text-slate-600">
                                    💵
                                    <span class="font-medium">Harga Satuan :</span>
                                    Rp {{ number_format($booking->price->price ?? 0, 0, ',', '.') }}
                                </p>

                                <p class="text-slate-600">
                                    🔢
                                    <span class="font-medium">Jumlah Sepatu :</span>
                                    {{ $booking->quantity ?? 1 }}
                                </p>

                                <p class="text-slate-600">
                                    📅
                                    <span class="font-medium">Tanggal :</span>
                                    {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') }}
                                </p>

                                <p class="text-slate-600">
                                    🕒
                                    <span class="font-medium">Jam :</span>
                                    {{ $booking->booking_time }}
                                </p>

                                <p class="text-slate-600">
                                    👟
                                    <span class="font-medium">Merk :</span>
                                    {{ $booking->shoe_brand ?: '-' }}
                                </p>

                                <p class="text-slate-600">
                                    👞
                                    <span class="font-medium">Jenis :</span>
                                    {{ $booking->shoe_type ?: '-' }}
                                </p>

                                @if ($booking->note)
                                    <p class="text-slate-600">
                                        📝
                                        <span class="font-medium">Catatan :</span>
                                        {{ $booking->note }}
                                    </p>
                                @endif

                                <hr class="my-4">

                                <div class="bg-indigo-50 rounded-xl p-4">

                                    <div class="flex justify-between items-center">
                                        <span class="text-slate-600">
                                            Harga Satuan
                                        </span>

                                        <span class="font-semibold text-slate-800">
                                            Rp {{ number_format($booking->price->price ?? 0, 0, ',', '.') }}
                                        </span>
                                    </div>

                                    <div class="flex justify-between items-center mt-2">
                                        <span class="text-slate-600">
                                            Jumlah
                                        </span>

                                        <span class="font-semibold text-slate-800">
                                            {{ $booking->quantity ?? 1 }} Sepatu
                                        </span>
                                    </div>

                                    <div class="flex justify-between items-center mt-3 pt-3 border-t border-indigo-100">

                                        <span class="text-lg font-bold text-slate-800">
                                            Total
                                        </span>

                                        <span class="text-green-600 text-xl font-bold">
                                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="pt-5">

                            @if ($booking->status == 'pending')
                                <span class="inline-block bg-yellow-100 text-yellow-700 px-5 py-2 rounded-full font-semibold">
                                    Pending
                                </span>
                            @elseif($booking->status == 'process')
                                <span class="inline-block bg-blue-100 text-blue-700 px-5 py-2 rounded-full font-semibold">
                                    Diproses
                                </span>
                            @else
                                <span class="inline-block bg-green-100 text-green-700 px-5 py-2 rounded-full font-semibold">
                                    Selesai
                                </span>
                            @endif

                        </div>

                    </div>

                @empty

                    <div class="bg-red-100 text-red-700 rounded-2xl p-6 text-center">
                        Data booking tidak ditemukan.
                    </div>
                @endforelse
            @endisset

        </div>

    </div>

@endsection
