<nav class="fixed top-0 left-0 right-0 bg-white shadow-md z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 h-20">

        {{-- Logo + Nama Website --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3">

            @if ($setting?->logo)
                <img src="{{ asset('storage/' . $setting->logo) }}" alt="{{ $setting->site_name }}"
                    class="w-12 h-12 object-contain">
            @endif

            <span class="text-2xl font-extrabold text-blue-600">
                {{ $setting?->site_name ?? 'ShoeWash' }}
            </span>

        </a>

        {{-- Menu --}}
        <ul class="hidden lg:flex gap-8 font-medium">

            <li>
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">
                    Home
                </a>
            </li>
            <li><a href="#services" class="hover:text-blue-600 transition">Layanan</a></li>
            <li><a href="#pricing" class="hover:text-blue-600 transition">Harga</a></li>
            <li><a href="#gallery" class="hover:text-blue-600 transition">Galeri</a></li>
            <li><a href="#testimonial" class="hover:text-blue-600 transition">Testimoni</a></li>

        </ul>

        <div class="flex items-center gap-3">

            <a href="#status"
                class="bg-green-600 text-white px-6 py-3 rounded-full hover:bg-green-700 transition duration-300">
                Cek Status Booking
            </a>

            <a href="{{ route('login') }}"
                class="bg-blue-600 text-white px-8 py-3 rounded-full hover:bg-blue-700 transition duration-300">
                Login
            </a>

        </div>

    </div>
</nav>
