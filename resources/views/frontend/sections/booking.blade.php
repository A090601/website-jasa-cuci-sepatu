```blade
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

                    {{-- NAMA & WHATSAPP --}}
                    <div class="grid md:grid-cols-2 gap-5">

                        <input type="text" name="customer_name" placeholder="Nama" class="border rounded-lg p-3"
                            required>

                        <input type="text" name="phone" placeholder="No WhatsApp" class="border rounded-lg p-3"
                            required>

                    </div>

                    {{-- LAYANAN --}}
                    <div class="mt-5">

                        <select id="service" name="service_id" class="w-full border rounded-lg p-3" required>

                            <option value="">
                                Pilih Layanan
                            </option>

                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">
                                    {{ $service->name }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    {{-- PAKET --}}
                    <div class="mt-5">

                        <select id="price" name="price_id" class="w-full border rounded-lg p-3" required disabled>

                            <option value="">
                                Pilih Paket
                            </option>

                        </select>

                    </div>

                    {{-- JUMLAH SEPATU --}}
                    <div class="mt-5">

                        <label for="quantity" class="block mb-2 font-semibold">
                            Jumlah Sepatu
                        </label>

                        <input type="number" id="quantity" name="quantity" value="1" min="1"
                            max="50" class="w-full border rounded-lg p-3" required>

                        <p class="text-sm text-gray-500 mt-2">
                            Masukkan jumlah sepatu yang ingin dicuci.
                        </p>

                    </div>

                    {{-- MERK & JENIS --}}
                    <div class="grid md:grid-cols-2 gap-5 mt-5">

                        <input type="text" name="shoe_brand" placeholder="Merk Sepatu" class="border rounded-lg p-3">

                        <input type="text" name="shoe_type" placeholder="Jenis Sepatu" class="border rounded-lg p-3">

                    </div>

                    {{-- TANGGAL & JAM --}}
                    <div class="grid md:grid-cols-2 gap-5 mt-5">

                        {{-- TANGGAL --}}
                        <div class="relative w-full">

                            <input type="text" name="booking_date" placeholder="Pilih Tanggal Booking"
                                class="w-full border rounded-lg p-3 pr-10 text-gray-700 bg-white"
                                onfocus="this.type='date'" onblur="if(!this.value)this.type='text'" required>

                            <span class="absolute right-3 top-3.5 text-gray-400 pointer-events-none">
                                📅
                            </span>

                        </div>

                        {{-- JAM --}}
                        <div class="relative w-full">

                            <input type="text" name="booking_time" placeholder="Pilih Jam Booking"
                                class="w-full border rounded-lg p-3 pr-10 text-gray-700 bg-white"
                                onfocus="this.type='time'" onblur="if(!this.value)this.type='text'" required>

                            <span class="absolute right-3 top-3.5 text-gray-400 pointer-events-none">
                                🕒
                            </span>

                        </div>

                    </div>

                    {{-- FOTO SEPATU --}}
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

                    {{-- CATATAN --}}
                    <div class="mt-5">

                        <textarea name="note" rows="4" placeholder="Catatan" class="w-full border rounded-lg p-3"></textarea>

                    </div>

                    {{-- BUTTON --}}
                    <button type="submit" class="mt-8 w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-xl">
                        Booking Sekarang
                    </button>

                </form>

            </div>

            {{-- RINGKASAN --}}
            <div>

                <div class="bg-white rounded-2xl shadow-lg p-8 sticky top-28">

                    <h2 class="text-2xl font-bold mb-6">
                        Ringkasan Booking
                    </h2>

                    <div class="space-y-4">

                        {{-- LAYANAN --}}
                        <div class="flex justify-between gap-4">

                            <span>
                                Layanan
                            </span>

                            <span id="summaryService" class="font-semibold text-right">
                                -
                            </span>

                        </div>

                        {{-- PAKET --}}
                        <div class="flex justify-between gap-4">

                            <span>
                                Paket
                            </span>

                            <span id="summaryPackage" class="font-semibold text-right">
                                -
                            </span>

                        </div>

                        {{-- HARGA SATUAN --}}
                        <div class="flex justify-between gap-4">

                            <span>
                                Harga Satuan
                            </span>

                            <span id="summaryUnitPrice" class="font-semibold text-right">
                                Rp 0
                            </span>

                        </div>

                        {{-- JUMLAH --}}
                        <div class="flex justify-between gap-4">

                            <span>
                                Jumlah
                            </span>

                            <span id="summaryQuantity" class="font-semibold text-right">
                                1 Sepatu
                            </span>

                        </div>

                        <hr>

                        {{-- TOTAL --}}
                        <div class="flex justify-between gap-4">

                            <span class="font-bold">
                                Total Harga
                            </span>

                            <span id="summaryPrice" class="text-green-600 font-bold text-xl text-right">
                                Rp 0
                            </span>

                        </div>

                        <hr>

                        <p>
                            📅 Estimasi pengerjaan 2 Hari
                        </p>

                        <p>
                            💳 Bayar di Tempat
                        </p>

                        <p>
                            📱 Konfirmasi via WhatsApp
                        </p>

                        <p>
                            ✔ Status Awal Pending
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const prices = @json($prices);

            const service = document.getElementById('service');
            const price = document.getElementById('price');
            const quantity = document.getElementById('quantity');

            const summaryService = document.getElementById('summaryService');
            const summaryPackage = document.getElementById('summaryPackage');
            const summaryUnitPrice = document.getElementById('summaryUnitPrice');
            const summaryQuantity = document.getElementById('summaryQuantity');
            const summaryPrice = document.getElementById('summaryPrice');


            /*
            |--------------------------------------------------------------------------
            | FORMAT RUPIAH
            |--------------------------------------------------------------------------
            */

            function formatRupiah(value) {

                return 'Rp ' + Number(value).toLocaleString('id-ID');

            }


            /*
            |--------------------------------------------------------------------------
            | UPDATE TOTAL
            |--------------------------------------------------------------------------
            */

            function updateTotal() {

                const selectedOption =
                    price.options[price.selectedIndex];

                const unitPrice =
                    Number(selectedOption?.dataset?.price || 0);

                let qty =
                    parseInt(quantity.value, 10);

                if (!qty || qty < 1) {

                    qty = 1;
                    quantity.value = 1;

                }

                const total =
                    unitPrice * qty;


                /*
                | Jumlah
                */

                summaryQuantity.textContent =
                    qty + ' Sepatu';


                /*
                | Harga satuan
                */

                summaryUnitPrice.textContent =
                    formatRupiah(unitPrice);


                /*
                | Total
                */

                summaryPrice.textContent =
                    formatRupiah(total);

            }


            /*
            |--------------------------------------------------------------------------
            | PILIH LAYANAN
            |--------------------------------------------------------------------------
            */

            service.addEventListener('change', function() {

                const serviceId =
                    Number(this.value);


                /*
                | Tampilkan nama layanan
                */

                if (this.value) {

                    summaryService.textContent =
                        this.options[this.selectedIndex].text.trim();

                } else {

                    summaryService.textContent = '-';

                }


                /*
                | Reset paket
                */

                price.innerHTML =
                    '<option value="">Pilih Paket</option>';

                price.disabled = true;


                /*
                | Reset ringkasan
                */

                summaryPackage.textContent = '-';

                summaryUnitPrice.textContent = 'Rp 0';

                summaryPrice.textContent = 'Rp 0';


                /*
                | Jika layanan belum dipilih
                */

                if (!serviceId) {

                    return;

                }


                /*
                | Masukkan paket berdasarkan layanan
                */

                prices.forEach(function(item) {

                    if (Number(item.service_id) === serviceId) {

                        const option =
                            document.createElement('option');

                        option.value =
                            item.id;

                        option.dataset.price =
                            item.price;

                        option.dataset.package =
                            item.package_name;

                        option.textContent =
                            item.package_name +
                            ' - ' +
                            formatRupiah(item.price);

                        price.appendChild(option);

                    }

                });


                /*
                | Aktifkan select paket
                */

                if (price.options.length > 1) {

                    price.disabled = false;

                }

            });


            /*
            |--------------------------------------------------------------------------
            | PILIH PAKET
            |--------------------------------------------------------------------------
            */

            price.addEventListener('change', function() {

                const selectedOption =
                    this.options[this.selectedIndex];


                if (!this.value) {

                    summaryPackage.textContent = '-';

                    summaryUnitPrice.textContent = 'Rp 0';

                    summaryPrice.textContent = 'Rp 0';

                    return;

                }


                /*
                | Nama paket
                */

                summaryPackage.textContent =
                    selectedOption.dataset.package;


                /*
                | Hitung total
                */

                updateTotal();

            });


            /*
            |--------------------------------------------------------------------------
            | JUMLAH SEPATU
            |--------------------------------------------------------------------------
            */

            quantity.addEventListener('input', function() {

                let qty =
                    parseInt(this.value, 10);


                /*
                | Jangan izinkan angka kurang dari 1
                */

                if (qty < 1 || isNaN(qty)) {

                    return;

                }


                /*
                | Jangan lebih dari 50
                */

                if (qty > 50) {

                    this.value = 50;

                }


                /*
                | Hitung ulang total
                */

                updateTotal();

            });


            quantity.addEventListener('change', function() {

                let qty =
                    parseInt(this.value, 10);


                if (!qty || qty < 1) {

                    this.value = 1;

                }


                if (qty > 50) {

                    this.value = 50;

                }


                updateTotal();

            });


            /*
            |--------------------------------------------------------------------------
            | INITIAL STATE
            |--------------------------------------------------------------------------
            */

            quantity.value = 1;

            price.disabled = true;

            summaryService.textContent = '-';

            summaryPackage.textContent = '-';

            summaryUnitPrice.textContent = 'Rp 0';

            summaryQuantity.textContent = '1 Sepatu';

            summaryPrice.textContent = 'Rp 0';

        });
    </script>
@endpush
```
