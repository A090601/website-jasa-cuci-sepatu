@extends('admin.layouts.app')

@section('title', 'Tambah Layanan')

@section('content')

    <div class="max-w-4xl mx-auto">

        <div class="bg-white rounded-2xl shadow-lg p-8">

            <h1 class="text-3xl font-bold mb-8">
                Tambah Layanan
            </h1>

            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                {{-- Nama --}}

                <div class="mb-6">

                    <label class="block font-semibold mb-2">
                        Nama Layanan
                    </label>

                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh : Deep Clean">

                    @error('name')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror

                </div>

                {{-- Deskripsi --}}

                <div class="mb-6">

                    <label class="block font-semibold mb-2">
                        Deskripsi
                    </label>

                    <textarea name="description" rows="5" class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>

                </div>

                {{-- Upload Gambar --}}

                <div class="mb-6">

                    <label class="block font-semibold mb-2">
                        Gambar Layanan
                    </label>

                    <input type="file" name="image" id="image" class="w-full border rounded-xl p-3">

                </div>

                {{-- Preview --}}

                <div class="mb-6">

                    <img id="preview" class="hidden w-64 rounded-xl shadow">

                </div>

                {{-- Status --}}

                <div class="mb-8">

                    <label class="inline-flex items-center">

                        <input type="checkbox" name="is_active" checked class="mr-2">

                        Aktif

                    </label>

                </div>

                {{-- Tombol --}}

                <div class="flex gap-4">

                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl">

                        Simpan

                    </button>

                    <a href="{{ route('admin.services.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 px-8 py-3 rounded-xl">

                        Batal

                    </a>

                </div>

            </form>

        </div>

    </div>

    <script>
        document.getElementById('image').onchange = function(e) {

            const reader = new FileReader();

            reader.onload = function() {

                const preview = document.getElementById('preview');

                preview.src = reader.result;

                preview.classList.remove('hidden');

            }

            reader.readAsDataURL(e.target.files[0]);

        }
    </script>

@endsection
