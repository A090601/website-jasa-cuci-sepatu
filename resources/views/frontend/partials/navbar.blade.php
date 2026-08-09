<nav class="fixed top-0 left-0 right-0 bg-white shadow-md z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-3 sm:px-6 h-20">

        {{-- Logo + Nama Website --}}
        <a href="{{ route('home') }}" class="flex items-center gap-1.5 sm:gap-3 shrink-0">

            @if ($setting?->logo)
                <img src="{{ asset('storage/' . $setting->logo) }}" alt="{{ $setting->site_name }}"
                    class="w-8 h-8 sm:w-12 sm:h-12 object-contain">
            @endif

            <span class="text-lg sm:text-2xl font-extrabold text-blue-600">
                {{ $setting?->site_name ?? 'ShoeWash' }}
            </span>

        </a>

        {{-- Menu (Sekarang selalu muncul di HP dengan penyesuaian ukuran) --}}
        <ul class="flex gap-2 sm:gap-4 lg:gap-8 font-medium text-[11px] sm:text-sm lg:text-base shrink-0">

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

        {{-- Tombol Aksi (Disesuaikan ukurannya di layar HP agar muat satu baris) --}}
        <div class="flex items-center gap-1.5 sm:gap-3 shrink-0">

            <a href="#status"
                class="bg-green-600 text-white px-2.5 py-2 sm:px-6 sm:py-3 rounded-full hover:bg-green-700 transition duration-300 text-[10px] sm:text-sm font-semibold">
                Cek Status
            </a>

            <a href="{{ route('login') }}"
                class="bg-blue-600 text-white px-4 py-2 sm:px-8 sm:py-3 rounded-full hover:bg-blue-700 transition duration-300 text-[10px] sm:text-sm font-semibold">
                Login
            </a>

        </div>

    </div>
</nav>
