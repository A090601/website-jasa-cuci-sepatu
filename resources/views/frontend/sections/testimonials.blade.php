<section id="testimonial" class="py-20 bg-white">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-14">

            <h2 class="text-4xl font-bold">
                Apa Kata Pelanggan?
            </h2>

            <p class="text-gray-500 mt-3">
                Testimoni asli dari pelanggan ShoeWash.
            </p>

        </div>

        <div class="grid md:grid-cols-3 gap-8">

            @forelse($testimonials as $testimonial)

                <div class="bg-slate-100 p-8 rounded-3xl shadow hover:shadow-lg transition">

                    <div class="flex items-center gap-4 mb-5">

                        @if ($testimonial->photo)
                            <img src="{{ asset('storage/' . $testimonial->photo) }}"
                                class="w-16 h-16 rounded-full object-cover">
                        @else
                            <div
                                class="w-16 h-16 rounded-full bg-indigo-600 text-white flex items-center justify-center text-xl font-bold">

                                {{ strtoupper(substr($testimonial->customer_name, 0, 1)) }}

                            </div>
                        @endif

                        <div>

                            <h4 class="font-bold text-lg">

                                {{ $testimonial->customer_name }}

                            </h4>

                            <div class="text-yellow-500">

                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $testimonial->rating)
                                        ⭐
                                    @else
                                        ☆
                                    @endif
                                @endfor

                            </div>

                        </div>

                    </div>

                    <p class="italic text-gray-600">

                        "{{ $testimonial->message }}"

                    </p>

                </div>

            @empty

                <div class="col-span-3 text-center text-gray-500">

                    Belum ada testimoni.

                </div>

            @endforelse

        </div>

    </div>

</section>
