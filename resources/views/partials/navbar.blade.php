<nav class="bg-white shadow sticky top-0 z-50">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex justify-between items-center h-20">

            <a href="/" class="text-2xl font-bold text-blue-600">
                👟 ShoeWash
            </a>

            <ul class="hidden md:flex gap-8">

                <li><a href="{{ route('home') }}" class="hover:text-blue-600">Home</a></li>

                <li><a href="#services" class="hover:text-blue-600">Layanan</a></li>

                <li><a href="#pricing" class="hover:text-blue-600">Harga</a></li>

                <li><a href="#gallery" class="hover:text-blue-600">Galeri</a></li>

                <li><a href="#testimonial" class="hover:text-blue-600">Testimoni</a></li>

            </ul>

            <a href="{{ route('login') }}"
                class="bg-blue-600 text-white px-8 py-3 rounded-full hover:bg-blue-700 transition duration-300">
                Login
            </a>

            <a href="{{ route('booking.status') }}">
                Cek Status
            </a>

        </div>

    </div>

</nav>
