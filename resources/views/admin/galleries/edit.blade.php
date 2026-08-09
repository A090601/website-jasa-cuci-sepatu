@extends('admin.layouts.app')

@section('title', 'Edit Galeri')

@section('content')

    <div class="max-w-4xl mx-auto">

        <div class="bg-white rounded-2xl shadow p-8">

            <h1 class="text-3xl font-bold mb-8">
                Edit Galeri
            </h1>

            @if ($errors->any())

                <div class="mb-6 bg-red-100 border border-red-300 rounded-xl p-4">

                    <ul class="list-disc ml-5">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-5">

                    <label class="block mb-2 font-medium">
                        Judul
                    </label>

                    <input type="text" name="title" value="{{ old('title', $gallery->title) }}"
                        class="w-full border rounded-xl px-4 py-3" required>

                </div>

                <div class="mb-5">

                    <label class="block mb-2 font-medium">
                        Deskripsi
                    </label>

                    <textarea name="description" rows="4" class="w-full border rounded-xl px-4 py-3">{{ old('description', $gallery->description) }}</textarea>

                </div>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <label class="block mb-2 font-medium">
                            Foto Before
                        </label>

                        <img src="{{ asset('storage/' . $gallery->before_image) }}"
                            class="w-full h-56 object-cover rounded-xl border mb-4">

                        <input type="file" name="before_image" accept="image/*"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">
                            Foto After
                        </label>

                        <img src="{{ asset('storage/' . $gallery->after_image) }}"
                            class="w-full h-56 object-cover rounded-xl border mb-4">

                        <input type="file" name="after_image" accept="image/*"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                </div>

                <div class="flex gap-3 mt-8">

                    <a href="{{ route('admin.galleries.index') }}"
                        class="px-6 py-3 rounded-xl bg-gray-200 hover:bg-gray-300">

                        Kembali

                    </a>

                    <button type="submit" class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white">

                        Update Galeri

                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection
