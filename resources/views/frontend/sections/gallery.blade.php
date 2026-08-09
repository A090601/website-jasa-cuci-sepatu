<section id="gallery" class="py-20 bg-gray-50">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-14">

            <h2 class="text-4xl font-bold">
                Hasil Pengerjaan Kami
            </h2>

            <p class="text-gray-500 mt-4">
                Before & After Shoe Cleaning
            </p>

        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($galleries as $gallery)
                <div class="bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-xl transition">

                    <div class="grid grid-cols-2">

                        <div>

                            <img src="{{ asset('storage/' . $gallery->before_image) }}" alt="Before"
                                class="w-full h-56 object-cover">

                            <div class="bg-red-100 text-red-600 text-center py-2 font-semibold">
                                Before
                            </div>

                        </div>

                        <div>

                            <img src="{{ asset('storage/' . $gallery->after_image) }}" alt="After"
                                class="w-full h-56 object-cover">

                            <div class="bg-green-100 text-green-600 text-center py-2 font-semibold">
                                After
                            </div>

                        </div>

                    </div>

                    <div class="p-6">

                        <h3 class="text-xl font-bold">
                            {{ $gallery->title }}
                        </h3>

                        @if (!empty($gallery->description))
                            <p class="text-gray-500 mt-3">
                                {{ $gallery->description }}
                            </p>
                        @endif

                    </div>

                </div>

            @empty

                <div class="col-span-3 text-center text-gray-400">

                    Belum ada galeri.

                </div>
            @endforelse

        </div>

    </div>

</section>
