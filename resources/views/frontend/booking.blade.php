@extends('layouts.frontend')

@section('content')
    <div class="max-w-6xl mx-auto pt-32 pb-16 px-6">

        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold">Booking Cuci Sepatu</h1>
            <p class="text-gray-500 mt-3">
                Isi formulir berikut untuk melakukan booking online.
            </p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">

            {{-- FORM --}}
            <div class="lg:col-span-2">

                <form action="{{ route('booking.store') }}" method="POST" class="bg-white rounded-2xl shadow-lg p-8">

                    @csrf

                    <div class="grid md:grid-cols-2 gap-5">

                        <input type="text" name="customer_name" placeholder="Nama" class="border rounded-lg p-3"
                            required>

                        <input type="text" name="phone" placeholder="No WhatsApp" class="border rounded-lg p-3"
                            required>

                    </div>

                    <div class="mt-5">

                        <select id="service" name="service_id" class="w-full border rounded-lg p-3">

                            <option value="">Pilih Layanan</option>

                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">
                                    {{ $service->name }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    <div class="mt-5">

                        <select id="price" name="price_id" class="w-full border rounded-lg p-3">

                            <option value="">
                                Pilih Paket
                            </option>

                        </select>

                    </div>

                    <div class="grid md:grid-cols-2 gap-5 mt-5">

                        <input type="text" name="shoe_brand" placeholder="Merk Sepatu" class="border rounded-lg p-3">

                        <input type="text" name="shoe_type" placeholder="Jenis Sepatu" class="border rounded-lg p-3">

                    </div>

                    <div class="grid md:grid-cols-2 gap-5 mt-5">

                        <input type="date" name="booking_date" class="border rounded-lg p-3">

                        <input type="time" name="booking_time" class="border rounded-lg p-3">

                    </div>

                    <div class="mt-5">

                        <textarea name="note" rows="4" placeholder="Catatan" class="w-full border rounded-lg p-3"></textarea>

                    </div>

                    <button class="mt-8 w-full bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-xl">

                        Booking Sekarang

                    </button>

                </form>

            </div>

            {{-- PANEL KANAN --}}
            <div>

                <div class="bg-white rounded-2xl shadow-lg p-8 sticky top-28">

                    <h2 class="text-2xl font-bold mb-6">

                        Ringkasan Booking

                    </h2>

                    <div class="space-y-4">

                        <div class="flex justify-between">

                            <span>Layanan</span>

                            <span id="summaryService">-</span>

                        </div>

                        <div class="flex justify-between">

                            <span>Total Harga</span>

                            <span id="summaryPrice">Rp 0</span>

                        </div>

                        <hr>

                        <p>📅 Estimasi pengerjaan 2 Hari</p>

                        <p>💳 Bayar di Tempat</p>

                        <p>📱 Konfirmasi melalui WhatsApp</p>

                        <p>✔ Status Awal Pending</p>

                    </div>

                </div>

            </div>

        </div>

    </div>

    @push('scripts')
        <script>
            const prices = @json($prices);

            const service = document.getElementById('service');
            const price = document.getElementById('price');

            const summaryService = document.getElementById('summaryService');
            const summaryPrice = document.getElementById('summaryPrice');

            service.addEventListener('change', function() {

                summaryService.innerHTML =
                    this.options[this.selectedIndex].text;

                price.innerHTML =
                    '<option value="">Pilih Paket</option>';

                const selected = Number(this.value);

                prices.forEach(function(item) {

                    if (item.service_id == selected) {

                        price.innerHTML +=
                            `<option value="${item.id}" data-price="${item.price}">
                ${item.package_name} - Rp ${Number(item.price).toLocaleString('id-ID')}
            </option>`;

                    }

                });

            });

            price.addEventListener('change', function() {

                const option = this.options[this.selectedIndex];

                summaryPrice.innerHTML =
                    'Rp ' +
                    Number(option.dataset.price || 0).toLocaleString('id-ID');

            });
        </script>
    @endpush
@endsection
