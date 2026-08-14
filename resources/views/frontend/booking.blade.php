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

                <form action="{{ route('booking.store') }}" method="POST"
                    class="bg-white rounded-2xl shadow-lg p-8">

                    @csrf

                    {{-- DATA CUSTOMER --}}
                    <div class="grid md:grid-cols-2 gap-5">

                        <div>
                            <label for="customer_name" class="block mb-2 font-medium text-gray-700">
                                Nama
                            </label>

                            <input
                                type="text"
                                id="customer_name"
                                name="customer_name"
                                placeholder="Nama"
                                class="border rounded-lg p-3 w-full"
                                required
                            >
                        </div>

                        <div>
                            <label for="phone" class="block mb-2 font-medium text-gray-700">
                                No WhatsApp
                            </label>

                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                placeholder="No WhatsApp"
                                class="border rounded-lg p-3 w-full"
                                required
                            >
                        </div>

                    </div>

                    {{-- LAYANAN --}}
                    <div class="mt-5">

                        <label for="service" class="block mb-2 font-medium text-gray-700">
                            Layanan
                        </label>

                        <select
                            id="service"
                            name="service_id"
                            class="w-full border rounded-lg p-3"
                            required
                        >

                            <option value="">Pilih Layanan</option>

                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">
                                    {{ $service->name }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    {{-- PAKET --}}
                    <div class="mt-5">

                        <label for="price" class="block mb-2 font-medium text-gray-700">
                            Paket
                        </label>

                        <select
                            id="price"
                            name="price_id"
                            class="w-full border rounded-lg p-3"
                            required
                        >

                            <option value="">
                                Pilih Paket
                            </option>

                        </select>

                    </div>

                    {{-- MERK & JENIS SEPATU --}}
                    <div class="grid md:grid-cols-2 gap-5 mt-5">

                        <div>
                            <label for="shoe_brand" class="block mb-2 font-medium text-gray-700">
                                Merk Sepatu
                            </label>

                            <input
                                type="text"
                                id="shoe_brand"
                                name="shoe_brand"
                                placeholder="Merk Sepatu"
                                class="border rounded-lg p-3 w-full"
                            >
                        </div>

                        <div>
                            <label for="shoe_type" class="block mb-2 font-medium text-gray-700">
                                Jenis Sepatu
                            </label>

                            <input
                                type="text"
                                id="shoe_type"
                                name="shoe_type"
                                placeholder="Jenis Sepatu"
                                class="border rounded-lg p-3 w-full"
                            >
                        </div>

                    </div>

                    {{-- JUMLAH SEPATU --}}
                    <div class="mt-5">

                        <label for="quantity" class="block mb-2 font-medium text-gray-700">
                            Jumlah Sepatu
                        </label>

                        <input
                            type="number"
                            id="quantity"
                            name="quantity"
                            min="1"
                            value="1"
                            class="w-full border rounded-lg p-3"
                            required
                        >

                        <p class="text-sm text-gray-500 mt-2">
                            Masukkan jumlah sepatu yang ingin dicuci.
                        </p>

                    </div>

                    {{-- TANGGAL & WAKTU --}}
                    <div class="grid md:grid-cols-2 gap-5 mt-5">

                        <div>
                            <label for="booking_date" class="block mb-2 font-medium text-gray-700">
                                Tanggal Booking
                            </label>

                            <input
                                type="date"
                                id="booking_date"
                                name="booking_date"
                                class="border rounded-lg p-3 w-full"
                            >
                        </div>

                        <div>
                            <label for="booking_time" class="block mb-2 font-medium text-gray-700">
                                Waktu Booking
                            </label>

                            <input
                                type="time"
                                id="booking_time"
                                name="booking_time"
                                class="border rounded-lg p-3 w-full"
                            >
                        </div>

                    </div>

                    {{-- CATATAN --}}
                    <div class="mt-5">

                        <label for="note" class="block mb-2 font-medium text-gray-700">
                            Catatan
                        </label>

                        <textarea
                            id="note"
                            name="note"
                            rows="4"
                            placeholder="Catatan"
                            class="w-full border rounded-lg p-3"
                        ></textarea>

                    </div>

                    {{-- SUBMIT --}}
                    <button
                        type="submit"
                        class="mt-8 w-full bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-xl transition"
                    >
                        Booking Sekarang
                    </button>

                </form>

            </div>

            {{-- PANEL RINGKASAN --}}
            <div>

                <div class="bg-white rounded-2xl shadow-lg p-8 sticky top-28">

                    <h2 class="text-2xl font-bold mb-6">
                        Ringkasan Booking
                    </h2>

                    <div class="space-y-4">

                        {{-- LAYANAN --}}
                        <div class="flex justify-between gap-4">
                            <span class="text-gray-600">
                                Layanan
                            </span>

                            <span
                                id="summaryService"
                                class="font-medium text-right"
                            >
                                -
                            </span>
                        </div>

                        {{-- PAKET --}}
                        <div class="flex justify-between gap-4">
                            <span class="text-gray-600">
                                Paket
                            </span>

                            <span
                                id="summaryPackage"
                                class="font-medium text-right"
                            >
                                -
                            </span>
                        </div>

                        {{-- HARGA SATUAN --}}
                        <div class="flex justify-between gap-4">
                            <span class="text-gray-600">
                                Harga Satuan
                            </span>

                            <span
                                id="summaryUnitPrice"
                                class="font-medium text-right"
                            >
                                Rp 0
                            </span>
                        </div>

                        {{-- JUMLAH --}}
                        <div class="flex justify-between gap-4">
                            <span class="text-gray-600">
                                Jumlah
                            </span>

                            <span
                                id="summaryQuantity"
                                class="font-medium text-right"
                            >
                                1
                            </span>
                        </div>

                        <hr>

                        {{-- TOTAL --}}
                        <div class="flex justify-between gap-4 items-center">

                            <span class="font-bold text-lg">
                                Total Harga
                            </span>

                            <span
                                id="summaryPrice"
                                class="font-bold text-xl text-indigo-600 text-right"
                            >
                                Rp 0
                            </span>

                        </div>

                        <div class="border-t pt-4 space-y-3 text-sm text-gray-600">

                            <p>
                                📅 Estimasi pengerjaan 2 Hari
                            </p>

                            <p>
                                💳 Bayar di Tempat
                            </p>

                            <p>
                                📱 Konfirmasi melalui WhatsApp
                            </p>

                            <p>
                                ✔ Status Awal Pending
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    @push('scripts')
        <script>
            /**
             * Data harga dari Laravel
             */
            const prices = @json($prices);

            /**
             * Element form
             */
            const service = document.getElementById('service');
            const price = document.getElementById('price');
            const quantity = document.getElementById('quantity');

            /**
             * Element summary
             */
            const summaryService = document.getElementById('summaryService');
            const summaryPackage = document.getElementById('summaryPackage');
            const summaryUnitPrice = document.getElementById('summaryUnitPrice');
            const summaryQuantity = document.getElementById('summaryQuantity');
            const summaryPrice = document.getElementById('summaryPrice');

            /**
             * Harga satuan yang sedang dipilih
             */
            let unitPrice = 0;

            /**
             * Format Rupiah
             */
            function formatRupiah(value) {
                return 'Rp ' + Number(value || 0).toLocaleString('id-ID');
            }

            /**
             * Update seluruh ringkasan booking
             */
            function updateSummary() {

                let qty = Number(quantity.value);

                if (!qty || qty < 1) {
                    qty = 1;
                    quantity.value = 1;
                }

                const total = unitPrice * qty;

                summaryQuantity.textContent = qty;

                summaryUnitPrice.textContent =
                    formatRupiah(unitPrice);

                summaryPrice.textContent =
                    formatRupiah(total);
            }

            /**
             * Ketika layanan berubah
             */
            service.addEventListener('change', function () {

                const selectedOption =
                    this.options[this.selectedIndex];

                summaryService.textContent =
                    selectedOption && this.value
                        ? selectedOption.text
                        : '-';

                /**
                 * Reset paket
                 */
                price.innerHTML =
                    '<option value="">Pilih Paket</option>';

                /**
                 * Reset harga
                 */
                unitPrice = 0;

                summaryPackage.textContent = '-';

                updateSummary();

                const selectedService =
                    Number(this.value);

                if (!selectedService) {
                    return;
                }

                /**
                 * Masukkan paket berdasarkan service_id
                 */
                prices.forEach(function (item) {

                    if (Number(item.service_id) === selectedService) {

                        price.innerHTML += `
                            <option
                                value="${item.id}"
                                data-price="${item.price}"
                            >
                                ${item.package_name} - ${formatRupiah(item.price)}
                            </option>
                        `;
                    }

                });

            });

            /**
             * Ketika paket berubah
             */
            price.addEventListener('change', function () {

                const option =
                    this.options[this.selectedIndex];

                if (!this.value) {

                    unitPrice = 0;

                    summaryPackage.textContent = '-';

                    updateSummary();

                    return;
                }

                unitPrice =
                    Number(option.dataset.price || 0);

                summaryPackage.textContent =
                    option.text.split(' - Rp')[0];

                updateSummary();

            });

            /**
             * Ketika jumlah sepatu berubah
             */
            quantity.addEventListener('input', function () {

                updateSummary();

            });

            /**
             * Inisialisasi awal
             */
            updateSummary();
        </script>
    @endpush

@endsection