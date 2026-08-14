```blade
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
                @method('PUT')

                {{-- NAMA --}}
                <div class="mb-5">

                    <label class="block mb-2 font-medium">
                        Nama Pelanggan
                    </label>

                    <input type="text" name="customer_name" value="{{ old('customer_name', $booking->customer_name) }}"
                        class="w-full border rounded-xl px-4 py-3" required>

                </div>


                {{-- NOMOR HP --}}
                <div class="mb-5">

                    <label class="block mb-2 font-medium">
                        Nomor HP
                    </label>

                    <input type="text" name="phone" value="{{ old('phone', $booking->phone) }}"
                        class="w-full border rounded-xl px-4 py-3" required>

                </div>


                {{-- LAYANAN --}}
                <div class="mb-5">

                    <label class="block mb-2 font-medium">
                        Layanan
                    </label>

                    <select id="serviceSelect" name="service_id" class="w-full border rounded-xl px-4 py-3" required>

                        @foreach ($services as $service)
                            <option value="{{ $service->id }}"
                                {{ old('service_id', $booking->service_id) == $service->id ? 'selected' : '' }}>
                                {{ $service->name }}
                            </option>
                        @endforeach

                    </select>

                </div>


                {{-- PAKET --}}
                <div class="mb-5">

                    <label class="block mb-2 font-medium">
                        Paket
                    </label>

                    <select id="priceSelect" name="price_id" class="w-full border rounded-xl px-4 py-3" required>

                        @foreach ($prices as $price)
                            <option value="{{ $price->id }}" data-service="{{ $price->service_id }}"
                                data-price="{{ $price->price }}"
                                {{ old('price_id', $booking->price_id) == $price->id ? 'selected' : '' }}>
                                {{ $price->package_name }}
                                - Rp {{ number_format($price->price, 0, ',', '.') }}
                            </option>
                        @endforeach

                    </select>

                </div>

                <div class="mb-5">
                    <label class="block mb-2 font-medium">
                        Jumlah Sepatu
                    </label>

                    <input type="number" name="quantity" id="quantity"
                        value="{{ old('quantity', $booking->quantity ?? 1) }}" min="1" max="50"
                        class="w-full border rounded-xl px-4 py-3" required>

                    <p class="text-sm text-gray-500 mt-2">
                        Masukkan jumlah sepatu yang ingin dicuci.
                    </p>
                </div>

                {{-- TOTAL HARGA --}}
                <div class="mb-5">
                    <label class="block mb-2 font-medium">
                        Total Harga
                    </label>

                    <input type="text" id="totalPrice" class="w-full border rounded-xl px-4 py-3 bg-gray-100"
                        value="Rp {{ number_format($booking->total_price, 0, ',', '.') }}" readonly>
                </div>


                {{-- TANGGAL & JAM --}}
                <div class="grid grid-cols-2 gap-5">

                    <div>

                        <label class="block mb-2">
                            Tanggal
                        </label>

                        <input type="date" name="booking_date" value="{{ old('booking_date', $booking->booking_date) }}"
                            class="w-full border rounded-xl px-4 py-3" required>

                    </div>


                    <div>

                        <label class="block mb-2">
                            Jam
                        </label>

                        <input type="time" name="booking_time" value="{{ old('booking_time', $booking->booking_time) }}"
                            class="w-full border rounded-xl px-4 py-3" required>

                    </div>

                </div>


                {{-- FOTO SEPATU --}}
                <div class="mt-5">

                    <label class="block mb-2 font-semibold">
                        Foto Sepatu
                    </label>

                    @if ($booking->shoe_photo)
                        <img src="{{ asset('storage/' . $booking->shoe_photo) }}"
                            class="w-32 h-32 object-cover rounded-xl border mb-3">
                    @endif

                    <input type="file" name="shoe_photo" accept="image/*"
                        class="block w-full text-sm text-gray-500 border border-gray-300 rounded-xl cursor-pointer bg-gray-50 focus:outline-none file:mr-4 file:py-3 file:px-4 file:rounded-l-xl file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">

                    <p class="text-sm text-gray-500 mt-2">
                        Kosongkan jika tidak ingin mengganti foto.
                    </p>

                </div>


                {{-- FOTO SESUDAH DICUCI --}}
                <div class="mt-5">

                    <label class="block mb-2 font-semibold">
                        Foto Sesudah Dicuci
                    </label>

                    @if ($booking->after_photo)
                        <img src="{{ asset('storage/' . $booking->after_photo) }}"
                            class="w-32 h-32 object-cover rounded-xl border mb-3">
                    @endif

                    <input type="file" name="after_photo" accept="image/*"
                        class="block w-full text-sm text-gray-500 border border-gray-300 rounded-xl cursor-pointer bg-gray-50 focus:outline-none file:mr-4 file:py-3 file:px-4 file:rounded-l-xl file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">

                    <p class="text-sm text-gray-500 mt-2">
                        Upload foto hasil setelah sepatu selesai dicuci.
                    </p>

                </div>


                {{-- STATUS --}}
                <div class="mt-5">

                    <label class="block mb-2">
                        Status
                    </label>

                    <select name="status" class="w-full border rounded-xl px-4 py-3" required>

                        <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="process" {{ old('status', $booking->status) == 'process' ? 'selected' : '' }}>
                            Diproses
                        </option>

                        <option value="done" {{ old('status', $booking->status) == 'done' ? 'selected' : '' }}>
                            Selesai
                        </option>

                    </select>

                </div>


                {{-- BUTTON --}}
                <div class="mt-8 flex gap-3">

                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl">
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
            const quantityInput = document.getElementById('quantity');
            const totalPrice = document.getElementById('totalPrice');

            function updatePrice() {
                const option = priceSelect.options[priceSelect.selectedIndex];

                if (!option || !option.value) {
                    totalPrice.value = 'Rp 0';
                    return;
                }

                const unitPrice = Number(option.dataset.price || 0);
                const quantity = Math.max(1, Number(quantityInput.value || 1));

                const total = unitPrice * quantity;

                totalPrice.value =
                    'Rp ' + total.toLocaleString('id-ID');
            }

            function filterPrices(isInit = false) {
                const serviceId = serviceSelect.value;
                let selectedPriceId = priceSelect.value;

                [...priceSelect.options].forEach(option => {

                    if (!option.value) {
                        option.hidden = false;
                        return;
                    }

                    const isMatch = option.dataset.service == serviceId;

                    option.hidden = !isMatch;

                    if (!isMatch && option.selected) {
                        option.selected = false;
                    }
                });

                const selectedOption = [...priceSelect.options].find(
                    option =>
                    option.value &&
                    option.dataset.service == serviceId &&
                    option.value == selectedPriceId
                );

                if (selectedOption) {
                    selectedOption.selected = true;
                } else {
                    const firstVisible = [...priceSelect.options].find(
                        option =>
                        option.value &&
                        option.dataset.service == serviceId &&
                        !option.hidden
                    );

                    if (firstVisible) {
                        firstVisible.selected = true;
                    }
                }

                updatePrice();
            }

            serviceSelect.addEventListener('change', function() {
                filterPrices(false);
            });

            priceSelect.addEventListener('change', function() {
                updatePrice();
            });

            quantityInput.addEventListener('input', function() {

                if (!this.value || Number(this.value) < 1) {
                    this.value = 1;
                }

                if (Number(this.value) > 50) {
                    this.value = 50;
                }

                updatePrice();
            });

            // Jalankan saat halaman edit dibuka
            filterPrices(true);
        </script>
    @endpush

@endsection
```
