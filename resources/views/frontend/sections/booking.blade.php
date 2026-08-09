<section id="booking" class="py-24 bg-slate-50">

    <div class="max-w-6xl mx-auto px-6">

        <div class="text-center mb-10">

            <h2 class="text-4xl font-bold">
                Booking Online
            </h2>

            <p class="text-gray-500 mt-3">
                Isi formulir berikut untuk melakukan booking online.
            </p>

        </div>

        <div class="grid lg:grid-cols-3 gap-8">

            {{-- FORM --}}
            <div class="lg:col-span-2">

                <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data">

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

    {{-- INPUT TANGGAL BAWAAN (Aman & Memiliki Teks Petunjuk di HP) --}}
    <input type="date" 
           name="booking_date" 
           class="w-full border rounded-lg p-3 text-gray-700 bg-white relative 
                  before:content-['Pilih_Tanggal_Booking'] before:text-gray-400 before:absolute before:left-3 before:top-3.5 before:pointer-events-none 
                  focus:before:hidden valid:before:hidden"
           required>

    {{-- INPUT JAM BAWAAN (Aman & Memiliki Teks Petunjuk di HP) --}}
    <input type="time" 
           name="booking_time" 
           class="w-full border rounded-lg p-3 text-gray-700 bg-white relative 
                  before:content-['Pilih_Jam_Booking'] before:text-gray-400 before:absolute before:left-3 before:top-3.5 before:pointer-events-none 
                  focus:before:hidden valid:before:hidden"
           required>

</div>


                    <div class="mt-5">

                        <label class="block mb-2 font-semibold">
                            Foto Sepatu
                        </label>

                        <input type="file" name="shoe_photo" accept="image/jpeg,image/png,image/webp"
                            class="w-full border rounded-lg p-3">

                        <p class="text-sm text-gray-500 mt-2">
                            Upload foto kondisi sepatu (Opsional)
                        </p>

                    </div>

                    <div class="mt-5">

                        <textarea name="note" rows="4" placeholder="Catatan" class="w-full border rounded-lg p-3"></textarea>

                    </div>

                    <button class="mt-8 w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-xl">

                        Booking Sekarang

                    </button>

                </form>

            </div>

            {{-- Ringkasan --}}
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
                        <p>📱 Konfirmasi via WhatsApp</p>
                        <p>✔ Status Awal Pending</p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@push('scripts')
    <script>
        const prices = @json($prices);

        const service = document.getElementById('service');
        const price = document.getElementById('price');

        const summaryService = document.getElementById('summaryService');
        const summaryPrice = document.getElementById('summaryPrice');

        service.addEventListener('change', function() {

            summaryService.innerHTML = this.options[this.selectedIndex].text;

            price.innerHTML = '<option value="">Pilih Paket</option>';

            const selected = Number(this.value);

            prices.forEach(function(item) {

                if (item.service_id == selected) {

                    price.innerHTML += `
<option value="${item.id}" data-price="${item.price}">
${item.package_name} - Rp ${Number(item.price).toLocaleString('id-ID')}
</option>`;

                }

            });

        });

        price.addEventListener('change', function() {

            summaryPrice.innerHTML = 'Rp ' + Number(
                this.options[this.selectedIndex].dataset.price || 0
            ).toLocaleString('id-ID');

        });
    </script>
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
@endpush
