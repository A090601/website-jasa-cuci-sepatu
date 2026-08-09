<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Title --}}
    <title>
        @yield('title', $setting?->meta_title ?: $setting?->site_name ?: 'ShoeWash')
    </title>

    {{-- SEO --}}
    <meta name="description" content="{{ $setting?->meta_description ?: 'Jasa cuci sepatu profesional.' }}">

    <meta name="keywords" content="{{ $setting?->meta_keywords ?: 'cuci sepatu, laundry sepatu' }}">

    <meta name="author" content="{{ $setting?->site_name ?: 'ShoeWash' }}">

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $setting?->meta_title ?: $setting?->site_name }}">

    <meta property="og:description" content="{{ $setting?->meta_description }}">

    <meta property="og:type" content="website">

    <meta property="og:url" content="{{ url()->current() }}">

    @if ($setting?->logo)
        <meta property="og:image" content="{{ asset('storage/' . $setting->logo) }}">
    @endif

    {{-- Canonical --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Favicon --}}
    @if ($setting?->favicon)
        <link rel="icon" href="{{ asset('storage/' . $setting->favicon) }}">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 flex flex-col min-h-screen">

    @include('frontend.partials.navbar')

    <main class="flex-1">
        @yield('content')
    </main>

    @include('frontend.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                confirmButtonColor: '#4F46E5'
            });
        </script>
    @endif

    @stack('scripts')

</body>

</html>
