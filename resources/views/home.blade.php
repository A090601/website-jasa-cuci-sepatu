@extends('layouts.app')

@section('content')
    <section class="min-h-screen flex items-center">

        <div class="max-w-7xl mx-auto px-6">

            <div class="grid lg:grid-cols-2 gap-12 items-center">

                <div>

                    <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full">

                        Jasa Cuci Sepatu Profesional

                    </span>

                    <h1 class="text-5xl lg:text-6xl font-extrabold mt-6 leading-tight">

                        Sepatu Bersih,

                        <span class="text-blue-600">

                            Tampil Percaya Diri

                        </span>

                    </h1>

                    <p class="text-gray-500 mt-6 text-lg">

                        Kami melayani Fast Clean,
                        Deep Clean,
                        Repaint,
                        Whitening,
                        hingga Unyellowing
                        dengan hasil profesional.

                    </p>

                    <div class="mt-8 flex gap-4">

                        <a href="{{ route('booking.create') }}">

                            Booking Sekarang

                        </a>

                        <a href="#pricing" class="border border-blue-600 text-blue-600 px-8 py-4 rounded-full">

                            Lihat Harga

                        </a>

                    </div>

                </div>

                <div>

                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=900"
                        class="rounded-3xl shadow-2xl">

                </div>

            </div>

        </div>

    </section>
@endsection
