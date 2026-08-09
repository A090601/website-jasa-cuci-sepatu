@extends('layouts.frontend')

@section('content')
    <section class="bg-slate-100 py-28">
        <div class="max-w-2xl mx-auto px-4 mt-8">

            <div class="bg-white rounded-2xl shadow-xl p-8">

                <h2 class="text-3xl font-bold text-center mb-2">
                    Beri Testimoni
                </h2>

                <p class="text-center text-gray-500 mb-8">
                    Terima kasih telah menggunakan ShoeWash 🙏
                </p>

                <div class="mb-8 bg-slate-50 rounded-xl p-5">

                    <p><strong>Nomor Booking:</strong> {{ $booking->booking_code }}</p>

                    <p><strong>Nama:</strong> {{ $booking->customer_name }}</p>

                    <p><strong>Layanan:</strong> {{ $booking->service->name }}</p>

                </div>

                <form action="{{ route('testimonial.store') }}" method="POST">

                    @csrf

                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                    <div class="mb-6">

                        <label class="block mb-2 font-semibold">
                            Rating
                        </label>

                        <select name="rating" class="w-full border rounded-xl px-4 py-3">

                            <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                            <option value="4">⭐⭐⭐⭐ (4)</option>
                            <option value="3">⭐⭐⭐ (3)</option>
                            <option value="2">⭐⭐ (2)</option>
                            <option value="1">⭐ (1)</option>

                        </select>

                    </div>

                    <div class="mb-6">

                        <label class="block mb-2 font-semibold">
                            Testimoni
                        </label>

                        <textarea name="message" rows="5" class="w-full border rounded-xl px-4 py-3"
                            placeholder="Bagaimana pengalaman Anda menggunakan ShoeWash?"></textarea>

                    </div>

                    <button
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-xl font-semibold transition">

                        Kirim Testimoni

                    </button>

                </form>

            </div>

        </div>

    </section>
@endsection
