@extends('admin.layouts.app')

@section('title', 'Setting Website')

@section('content')

    <div class="max-w-5xl mx-auto">

        <div class="bg-white rounded-2xl shadow p-8">

            <h1 class="text-3xl font-bold mb-8">
                Setting Website
            </h1>

            <form action="{{ route('admin.settings.update', $setting) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-2 gap-6">

                    {{-- Nama Website --}}
                    <div>
                        <label class="block mb-2 font-semibold">
                            Nama Website
                        </label>

                        <input type="text" name="site_name" value="{{ old('site_name', $setting->site_name) }}"
                            class="w-full border rounded-xl px-4 py-3">
                    </div>

                    {{-- Nomor HP --}}
                    <div>
                        <label class="block mb-2 font-semibold">
                            Nomor HP
                        </label>

                        <input type="text" name="phone" value="{{ old('phone', $setting->phone) }}"
                            class="w-full border rounded-xl px-4 py-3">
                    </div>

                    {{-- WhatsApp --}}
                    <div>
                        <label class="block mb-2 font-semibold">
                            WhatsApp
                        </label>

                        <input type="text" name="whatsapp" value="{{ old('whatsapp', $setting->whatsapp) }}"
                            class="w-full border rounded-xl px-4 py-3">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block mb-2 font-semibold">
                            Email
                        </label>

                        <input type="email" name="email" value="{{ old('email', $setting->email) }}"
                            class="w-full border rounded-xl px-4 py-3">
                    </div>

                </div>

                {{-- Alamat --}}
                <div class="mt-6">

                    <label class="block mb-2 font-semibold">
                        Alamat
                    </label>

                    <textarea name="address" rows="3" class="w-full border rounded-xl px-4 py-3">{{ old('address', $setting->address) }}</textarea>

                </div>

                <div class="mt-6">

                    <label class="block mb-2 font-medium">
                        Link Google Maps
                    </label>

                    <input type="url" name="google_maps" value="{{ old('google_maps', $setting->google_maps) }}"
                        class="w-full border rounded-xl px-4 py-3" placeholder="https://maps.app.goo.gl/...">

                    <p class="text-gray-500 text-sm mt-2">
                        Cukup tempel link Google Maps (Share → Copy Link).
                    </p>

                </div>

                {{-- Deskripsi --}}
                <div class="mt-6">

                    <label class="block mb-2 font-semibold">
                        Deskripsi Website
                    </label>

                    <textarea name="site_description" rows="3" class="w-full border rounded-xl px-4 py-3">{{ old('site_description', $setting->site_description) }}</textarea>

                </div>

                <hr class="my-8">

                <h2 class="text-xl font-bold mb-5">
                    Sosial Media
                </h2>

                <div class="grid md:grid-cols-3 gap-5">

                    <input type="text" name="instagram" placeholder="Instagram"
                        value="{{ old('instagram', $setting->instagram) }}" class="border rounded-xl px-4 py-3">

                    <input type="text" name="facebook" placeholder="Facebook"
                        value="{{ old('facebook', $setting->facebook) }}" class="border rounded-xl px-4 py-3">

                    <input type="text" name="tiktok" placeholder="TikTok" value="{{ old('tiktok', $setting->tiktok) }}"
                        class="border rounded-xl px-4 py-3">

                </div>

                <hr class="my-8">

                <h2 class="text-xl font-bold mb-5">
                    SEO
                </h2>

                <div class="space-y-5">

                    <input type="text" name="meta_title" placeholder="Meta Title"
                        value="{{ old('meta_title', $setting->meta_title) }}" class="w-full border rounded-xl px-4 py-3">

                    <textarea name="meta_description" rows="3" placeholder="Meta Description"
                        class="w-full border rounded-xl px-4 py-3">{{ old('meta_description', $setting->meta_description) }}</textarea>

                    <textarea name="meta_keywords" rows="2" placeholder="Meta Keywords" class="w-full border rounded-xl px-4 py-3">{{ old('meta_keywords', $setting->meta_keywords) }}</textarea>

                </div>

                <hr class="my-8">

                <h2 class="text-xl font-bold mb-5">
                    Logo Website
                </h2>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <label class="block mb-2">
                            Logo
                        </label>

                        <input type="file" name="logo" class="w-full">

                        @if ($setting->logo)
                            <img src="{{ asset('storage/' . $setting->logo) }}" class="h-24 mt-4 rounded-lg border">
                        @endif

                    </div>

                    <div>

                        <label class="block mb-2">
                            Favicon
                        </label>

                        <input type="file" name="favicon" class="w-full">

                        @if ($setting->favicon)
                            <img src="{{ asset('storage/' . $setting->favicon) }}" class="h-16 mt-4 rounded-lg border">
                        @endif

                    </div>

                </div>

                <div class="mt-8">

                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl">

                        Simpan Setting

                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection
