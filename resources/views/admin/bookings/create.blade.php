@extends('admin.layouts.app')

@section('title', 'Tambah Booking')

@section('content')

    <div class="max-w-4xl mx-auto">

        <div class="bg-white rounded-2xl shadow p-8">

            <h1 class="text-3xl font-bold mb-8">
                Tambah Booking
            </h1>

            @if ($errors->any())

                <div class="mb-6 rounded-xl bg-red-100 border border-red-300 p-4">

                    <ul class="list-disc ml-5">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ route('admin.bookings.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                {{-- Nama --}}
                <div class="mb-5">

                    <label class="block mb-2 font-medium">
                        Nama Pelanggan
                    </label>

                    <input type="text" name="customer_name" value="{{ old('customer_name') }}"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500" required>

                </div>

                {{-- No HP --}}
                <div class="mb-5">

                    <label class="block mb-2 font-medium">
                        Nomor HP
                    </label>

                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="w-full border rounded-xl px-4 py-3" required>

                </div>

                {{-- Layanan --}}
                <div class="mb-5">

                    <label class="block mb-2 font-medium">
                        Layanan
                    </label>

                    <select id="service" name="service_id" class="w-full border rounded-xl px-4 py-3" required>

                        <option value="">-- Pilih Layanan --</option>

                        @foreach ($services as $service)
                            <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                {{ $service->name }}
                            </option>
                        @endforeach

                    </select>

                    <div class="mt-5">

                        <label class="block mb-2 font-semibold">

                            Paket Harga

                        </label>

                        <select name="price_id" id="price" class="w-full border rounded-xl p-3" required>

                            <option value="">

                                Pilih Paket

                            </option>

                        </select>

                    </div>

                    <div class="mb-5">
                        <label class="block mb-2 font-medium">
                            Jumlah Sepatu
                        </label>

                        <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1" max="50"
                            class="w-full border rounded-xl px-4 py-3" required>

                        <p class="text-sm text-gray-500 mt-2">
                            Masukkan jumlah sepatu yang ingin dicuci.
                        </p>
                    </div>

                </div>

                <div class="grid md:grid-cols-2 gap-5 mt-5">

                    {{-- KOLOM TANGGAL ADMIN (Dengan Ikon Emoji Manual agar selalu muncul di HP) --}}
                    <div class="relative w-full">
                        <label class="block mb-1 font-semibold text-gray-700">Tanggal Booking</label>
                        <input type="text" name="booking_date" placeholder="Pilih Tanggal Booking"
                            class="w-full border rounded-lg p-3 pr-10 text-gray-700 bg-white" onfocus="(this.type='date')"
                            onblur="(this.type='text')" required>
                        <span class="absolute right-3 top-[42px] text-gray-400 pointer-events-none">📅</span>
                    </div>

                    {{-- KOLOM JAM ADMIN (Dengan Ikon Emoji Manual agar selalu muncul di HP) --}}
                    <div class="relative w-full">
                        <label class="block mb-1 font-semibold text-gray-700">Jam Booking</label>
                        <input type="text" name="booking_time" placeholder="Pilih Jam Booking"
                            class="w-full border rounded-lg p-3 pr-10 text-gray-700 bg-white" onfocus="(this.type='time')"
                            onblur="(this.type='text')" required>
                        <span class="absolute right-3 top-[42px] text-gray-400 pointer-events-none">🕒</span>
                    </div>

                </div>


                {{-- Jenis Sepatu --}}
                <div class="mt-5">

                    <label class="block mb-2 font-medium">
                        Jenis Sepatu
                    </label>

                    <input type="text" name="shoe_type" placeholder="Sneakers, Boots, Running..."
                        class="w-full border rounded-xl px-4 py-3">

                </div>

                {{-- Merk Sepatu --}}
                <div class="mt-5">

                    <label class="block mb-2 font-medium">
                        Merk Sepatu
                    </label>

                    <input type="text" name="shoe_brand" placeholder="Nike, Adidas, Vans..."
                        class="w-full border rounded-xl px-4 py-3">

                </div>

                <div class="mt-5">
                    <label class="block mb-2 font-semibold">
                        Foto Sepatu
                    </label>

                    <input type="file" name="shoe_photo" accept="image/*" capture="environment"
                        class="w-full border rounded-lg p-3">

                    <p class="text-sm text-gray-500 mt-2">
                        Upload foto atau ambil foto langsung menggunakan kamera.
                    </p>
                </div>

                {{-- Catatan --}}
                <div class="mt-5">

                    <label class="block mb-2 font-medium">
                        Catatan
                    </label>

                    <textarea name="note" rows="4" class="w-full border rounded-xl px-4 py-3"></textarea>

                </div>

                <div class="flex gap-3 mt-8">

                    <a href="{{ route('admin.bookings.index') }}"
                        class="px-6 py-3 rounded-xl bg-gray-200 hover:bg-gray-300">

                        Kembali

                    </a>

                    <button type="submit" class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white">

                        Simpan Booking

                    </button>

                </div>

            </form>

        </div>

    </div>
    @push('scripts')
        <script>
            const prices = @json($prices);
            const oldPrice = "{{ old('price_id') }}";

            const service = document.getElementById('service');
            const price = document.getElementById('price');

            service.addEventListener('change', function() {

                const id = Number(this.value);

                price.innerHTML = '<option value="">Pilih Paket</option>';

                prices.forEach(function(item) {

                    if (item.service_id == id) {

                        price.innerHTML += `
                    <option
                        value="${item.id}"
                        ${oldPrice == item.id ? 'selected' : ''}>

                        ${item.package_name}
                        - Rp ${Number(item.price).toLocaleString('id-ID')}

                    </option>
                `;

                    }

                });

            });

            // Menampilkan paket saat halaman dibuka kembali (misalnya setelah validasi gagal)
            if (service.value) {
                service.dispatchEvent(new Event('change'));
            }
        </script>
    @endpush
@endsection
