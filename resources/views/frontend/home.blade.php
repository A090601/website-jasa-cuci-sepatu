@extends('layouts.frontend')

@section('content')
    @include('frontend.sections.hero')

    @include('frontend.sections.about')

    @include('frontend.sections.services')

    @include('frontend.sections.pricing')

    @include('frontend.sections.booking')

    @include('frontend.sections.status')

    @include('frontend.sections.gallery')

    @include('frontend.sections.testimonials')
    {{-- Lokasi --}}
    <section class="py-20 bg-gray-50">

        <div class="max-w-7xl mx-auto px-6 text-center">

            <h2 class="text-4xl font-bold mb-4">
                Lokasi Kami
            </h2>

            <p class="text-gray-500 mb-8">
                Datang langsung ke outlet kami atau buka lokasi melalui Google Maps.
            </p>

            @if ($setting && $setting->address)
                <p class="text-lg font-medium mb-6">
                    📍 {{ $setting->address }}
                </p>
            @endif

            @if ($setting && $setting->google_maps)
                <a href="{{ $setting->google_maps }}" target="_blank"
                    class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-xl transition">

                    📍 Buka di Google Maps

                </a>
            @else
                <div class="bg-white border rounded-2xl p-8 text-gray-500">

                    Lokasi belum tersedia.

                </div>
            @endif

        </div>

    </section>
@endsection
