<nav class="fixed top-0 left-0 right-0 bg-white shadow-md z-50">
    <!-- BARIS UTAMA: Logo dan Tombol (Responsif & Lega) -->
    <div class="max-w-7xl mx-auto flex justify-between items-center px-4 sm:px-6 h-16 sm:h-20 border-b border-gray-100 lg:border-none">

        {{-- Logo + Nama Website --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2 sm:gap-3">
            @if ($setting?->logo)
                <img src="{{ asset('storage/' . $setting->logo) }}" alt="{{ $setting->site_name }}"
                    class="w-9 h-9 sm:w-12 sm:h-12 object-contain">
            @endif
            <span class="text-xl sm:text-2xl font-extrabold text-blue-600">
                {{ $setting?->site_name ?? 'ShoeWash' }}
            </span>
        </a>

        {{-- Menu versi LAPTOP & TABLET (Tersembunyi di HP karena pindah ke bawah) --}}
        <ul class="hidden lg:flex gap-8 font-medium text-base">
            <li><a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a></li>
            <li><a href="#services" class="hover:text-blue-600 transition">Layanan</a></li>
            <li><a href="#pricing" class="hover:text-blue-600 transition">Harga</a></li>
            <li><a href="#gallery" class="hover:text-blue-600 transition">Galeri</a></li>
            <li><a href="#testimonial" class="hover:text-blue-600 transition">Testimoni</a></li>
        </ul>

        {{-- Tombol Aksi (Ukurannya pas dan tidak kekecilan di HP) --}}
        <div class="flex items-center gap-2 sm:gap-3">
            <a href="#status"
                class="bg-green-600 text-white px-4 py-2 sm:px-6 sm:py-3 rounded-full hover:bg-green-700 transition duration-300 text-xs sm:text-sm font-semibold">
                Cek Status
            </a>
            <a href="{{ route('login') }}"
                class="bg-blue-600 text-white px-5 py-2 sm:px-8 sm:py-3 rounded-full hover:bg-blue-700 transition duration-300 text-xs sm:text-sm font-semibold">
                Login
            </a>
        </div>
    </div>

    <!-- BARIS KEDUA: Khusus Menu Teks di HP (Otomatis hilang di laptop) -->
    <div class="block lg:hidden bg-gray-50/80 backdrop-blur-sm py-2.5 px-4 shadow-inner">
        <ul class="flex justify-between items-center gap-1 font-semibold text-[13px] text-gray-600">
            <li><a href="{{ route('home') }}" class="text-blue-600 border-b-2 border-blue-600 pb-0.5">Home</a></li>
            <li><a href="#services" class="hover:text-blue-600 transition">Layanan</a></li>
            <li><a href="#pricing" class="hover:text-blue-600 transition">Harga</a></li>
            <li><a href="#gallery" class="hover:text-blue-600 transition">Galeri</a></li>
            <li><a href="#testimonial" class="hover:text-blue-600 transition">Testimoni</a></li>
        </ul>
    </div>
</nav>
