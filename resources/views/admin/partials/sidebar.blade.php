<aside class="fixed left-0 top-0 w-64 h-screen bg-slate-900 text-white flex flex-col shadow-2xl">

    {{-- Logo --}}
    <div class="px-6 py-6 border-b border-slate-700">
        <h1 class="text-2xl font-bold tracking-wide">
            👟 ShoeWash
        </h1>
        <p class="text-sm text-slate-400 mt-1">
            Admin Panel
        </p>
    </div>

    {{-- Menu --}}
    <nav class="flex-1 px-3 py-5 space-y-2">

        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200
{{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

            <span>🏠</span>
            <span>Dashboard</span>

        </a>

        <a href="{{ route('admin.bookings.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200
{{ request()->routeIs('admin.bookings.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

            <span>📅</span>
            <span>Booking</span>

        </a>

        <a href="{{ route('admin.services.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200
            {{ request()->routeIs('admin.services.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <span>🧽</span>
            <span>Layanan</span>
        </a>

        <a href="{{ route('admin.prices.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200
            {{ request()->routeIs('admin.prices.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <span>💰</span>
            <span>Harga</span>
        </a>

        <a href="{{ route('admin.galleries.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200
            {{ request()->routeIs('admin.galleries.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <span>🖼️</span>
            <span>Galeri</span>
        </a>

        <a href="{{ route('admin.testimonials.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200
            {{ request()->routeIs('admin.testimonials.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <span>⭐</span>
            <span>Testimoni</span>
        </a>

        <a href="{{ route('admin.settings.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200
            {{ request()->routeIs('admin.settings.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
            <span>⚙️</span>
            <span>Pengaturan</span>
        </a>

    </nav>

    {{-- Footer --}}
    <div class="border-t border-slate-700 p-5">
        <div class="text-sm text-slate-300">
            👤 Administrator
        </div>
        <div class="text-xs text-slate-500 mt-1">
            ShoeWash v1.0
        </div>
    </div>

</aside>
