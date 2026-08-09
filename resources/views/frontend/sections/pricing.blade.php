<section id="pricing" class="py-20 bg-white">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-14">
            <h2 class="text-4xl font-bold">
                Daftar Harga
            </h2>

            <p class="text-gray-500 mt-2">
                Harga transparan tanpa biaya tersembunyi.
            </p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">

            @forelse($prices as $price)
                <div class="border rounded-3xl p-8 shadow hover:shadow-xl transition">

                    <h3 class="text-2xl font-bold">
                        {{ $price->service->name }}
                    </h3>

                    @if ($price->package_name)
                        <p class="text-gray-500 mt-2">
                            {{ $price->package_name }}
                        </p>
                    @endif

                    <p class="text-5xl font-black text-blue-600 my-6">
                        Rp{{ number_format($price->price, 0, ',', '.') }}
                    </p>

                    @if ($price->duration)
                        <p class="text-gray-500 mb-6">
                            Durasi: {{ $price->duration }}
                        </p>
                    @endif

                </div>

            @empty

                <div class="col-span-3 text-center text-gray-500">

                    Belum ada daftar harga.

                </div>
            @endforelse

        </div>

    </div>

</section>
