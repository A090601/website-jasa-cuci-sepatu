<section id="status" class="py-20 bg-slate-100">

    <div class="max-w-4xl mx-auto px-6">

        <div class="text-center mb-10">

            <h2 class="text-4xl font-bold text-slate-800">
                Cek Status Pesanan
            </h2>

            <p class="text-slate-500 mt-3">
                Masukkan nomor WhatsApp yang digunakan saat booking.
            </p>

        </div>

        <form action="{{ route('booking.checkStatus') }}" method="POST" class="flex gap-4 mb-10">

            @csrf

            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Masukkan Nomor WhatsApp"
                class="flex-1 border border-slate-300 rounded-xl px-5 py-4 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-10 rounded-xl">

                Cari

            </button>

        </form>

        @isset($bookings)

            @forelse($bookings as $booking)
                <div class="bg-white rounded-2xl shadow-md p-6 mb-6">

                    <h3 class="text-2xl font-bold">

                        {{ $booking->customer_name }}

                    </h3>

                    <p class="text-slate-600 mt-2">

                        📱 {{ $booking->phone }}

                    </p>

                    <div class="mt-5 space-y-2">

                        <p>🧽 {{ $booking->service->name }}</p>

                        <p>📅 {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') }}</p>

                        <p>🕒 {{ $booking->booking_time }}</p>

                        <p>👟 {{ $booking->shoe_brand ?: '-' }}</p>

                        <p>👞 {{ $booking->shoe_type ?: '-' }}</p>

                        @if ($booking->note)
                            <p>📝 {{ $booking->note }}</p>
                        @endif

                        <div class="mt-4 bg-indigo-50 rounded-xl p-4 space-y-3">

                            <div class="flex justify-between">
                                <span class="text-slate-600">
                                    Paket
                                </span>

                                <span class="font-semibold text-slate-800">
                                    {{ $booking->price->package_name ?? '-' }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-slate-600">
                                    Harga Satuan
                                </span>

                                <span class="font-semibold text-slate-800">
                                    Rp {{ number_format($booking->price->price ?? 0, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-slate-600">
                                    Jumlah Sepatu
                                </span>

                                <span class="font-semibold text-slate-800">
                                    {{ $booking->quantity ?? 1 }} Sepatu
                                </span>
                            </div>

                            <div class="border-t border-indigo-200 pt-3 flex justify-between">
                                <span class="font-bold text-slate-800">
                                    Total
                                </span>

                                <span class="text-green-600 font-bold text-xl">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                </span>
                            </div>

                        </div>

                    </div>

                    <div class="mt-5">

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

                        @if ($booking->status == 'done')
                            <div class="mt-6 flex flex-wrap gap-3">

                                <a href="{{ route('testimonial.create', $booking) }}"
                                    class="inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-xl transition">

                                    ⭐ Beri Testimoni

                                </a>

                                <a href="{{ route('booking.nota', $booking) }}"
                                    class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl transition">

                                    📄 Nota PDF

                                </a>

                            </div>
                        @endif

                    </div>

                </div>

            @empty

                <div class="bg-red-100 text-red-700 rounded-xl p-5 text-center">

                    Data booking tidak ditemukan.

                </div>
            @endforelse

        @endisset

    </div>

</section>
