<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel | Royal Clean Shoes</title>

    <link rel="preconnect" href="https://fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600;700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased bg-gradient-to-br from-blue-100 via-white to-cyan-100">

    <div class="min-h-screen flex items-center justify-center px-6">

        <div
            class="w-full sm:max-w-lg mt-6 px-10 py-12 bg-white/95 backdrop-blur rounded-3xl shadow-2xl hover:shadow-blue-200 transition duration-300">

            {{ $slot }}

        </div>

    </div>

</body>

</html>
