@extends('admin.layouts.app')

@section('title', 'Edit Booking')

@section('content')

    <div class="max-w-4xl mx-auto">

        <div class="bg-white rounded-2xl shadow p-8">

            <h1 class="text-3xl font-bold mb-8">
                Edit Booking
            </h1>

            <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" enctype="multipart/form-data">

                @csrf
               

                <div class="mb-5">

                    <label class="block mb-2 font-medium">
                        Nama Pelanggan
                    </label>

                    <input type="text" name="customer_name" value="{{ old('customer_name', $booking->customer_name) }}"
                        class="w-full border rounded-xl px-4 py-3">

                </div>

                <div class="mb-5">

                    <label class="block mb-2 font-medium">
                        Nomor HP
                    </label>

                    <input type="text" name="phone" value="{{ old('phone', $booking->phone) }}"
                        class="w-full border rounded-xl px-4 py-3">

                </div>

                <div class="mb-5">

                    <label class="block mb-2 font-medium">
                        Layanan
                    </label>

                    <select name="service_id" class="w-full border rounded-xl px-4 py-3">

                        @foreach ($services as $service)
                            <option value="{{ $service->id }}"
                                {{ $booking->service_id == $service->id ? 'selected' : '' }}>

                                {{ $service->name }}

                            </option>
                        @endforeach

                    </select>

                </div>

                <div class="mb-5">

                    <label class="block mb-2 font-medium">
                        Paket
                    </label>

                    <select name="price_id" class="w-full border rounded-xl px-4 py-3">

                        @foreach ($prices as $price)
                            <option value="{{ $price->id }}" data-service="{{ $price->service_id }}"
                                data-price="{{ $price->price }}" {{ $booking->price_id == $price->id ? 'selected' : '' }}>

                                {{ $price->package_name }}
                                - Rp {{ number_format($price->price, 0, ',', '.') }}

                            </option>
                        @endforeach

                    </select>

                </div>

                <div class="mb-5">

                    <label class="block mb-2 font-medium">
                        Total Harga
                    </label>

                    <input type="text" id="totalPrice" class="w-full border rounded-xl px-4 py-3 bg-gray-100"
                        value="Rp {{ number_format($booking->total_price, 0, ',', '.') }}" readonly>

                </div>

                <div class="grid grid-cols-2 gap-5">

                    <div>

                        <label class="block mb-2">
                            Tanggal
                        </label>

                        <input type="date" name="booking_date" value="{{ $booking->booking_date }}"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                    <div>

                        <label class="block mb-2">
                            Jam
                        </label>

                        <input type="time" name="booking_time" value="{{ $booking->booking_time }}"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                </div>

                <div class="mt-5">
                    <label class="block mb-2 font-semibold">
                        Foto Sepatu
                    </label>

                    @if ($booking->shoe_photo)
                        <img src="{{ asset('storage/' . $booking->shoe_photo) }}"
                            class="w-32 h-32 object-cover rounded-xl border mb-3">
                    @endif

                    <input type="file" name="shoe_photo" accept="image/*" capture="environment"
                        class="w-full border rounded-lg p-3">

                    <p class="text-sm text-gray-500 mt-2">
                        Kosongkan jika tidak ingin mengganti foto.
                    </p>
                </div>

                <div class="mt-5">
                    <label class="block mb-2 font-semibold">
                        Foto Sesudah Dicuci
                    </label>

                    @if ($booking->after_photo)
                        <img src="{{ asset('storage/' . $booking->after_photo) }}"
                            class="w-32 h-32 object-cover rounded-xl border mb-3">
                    @endif

                    <input type="file" name="after_photo" accept="image/*" capture="environment"
                        class="w-full border rounded-lg p-3">

                    <p class="text-sm text-gray-500 mt-2">
                        Upload foto hasil setelah sepatu selesai dicuci.
                    </p>
                </div>

                <div class="mt-5">

                    <label class="block mb-2">
                        Status
                    </label>

                    <select name="status" class="w-full border rounded-xl px-4 py-3">

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

                </div>

                <div class="mt-8 flex gap-3">

                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl">

                        Update Booking

                    </button>

                    <a href="{{ route('admin.bookings.index') }}" class="bg-gray-300 px-6 py-3 rounded-xl">

                        Batal

                    </a>

                </div>

            </form>

        </div>

    </div>
    @push('scripts')
        <script>
            const serviceSelect = document.querySelector('[name="service_id"]');
            const priceSelect = document.querySelector('[name="price_id"]');
            const totalPrice = document.getElementById('totalPrice');

            function filterPrices() {

                const serviceId = serviceSelect.value;

                [...priceSelect.options].forEach(option => {

                    option.hidden = option.dataset.service != serviceId;

                });

                const firstVisible = [...priceSelect.options].find(option => !option.hidden);

                if (firstVisible) {
                    firstVisible.selected = true;
                    updatePrice();
                }

            }

            function updatePrice() {

                const option = priceSelect.options[priceSelect.selectedIndex];

                totalPrice.value = 'Rp ' + Number(option.dataset.price).toLocaleString('id-ID');

            }

            serviceSelect.addEventListener('change', filterPrices);
            priceSelect.addEventListener('change', updatePrice);

            filterPrices();
        </script>
    @endpush

@endsection
