@extends('admin.layouts.app')

@section('title', 'Tambah Galeri')

@section('content')

    <div class="max-w-4xl mx-auto">

        <div class="bg-white rounded-2xl shadow p-8">

            <h1 class="text-3xl font-bold mb-8">
                Tambah Galeri
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

            <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="mb-5">

                    <label class="block mb-2 font-medium">

                        Judul

                    </label>

                    <input type="text" name="title" class="w-full border rounded-xl px-4 py-3" required>

                </div>

                <div class="mb-5">

                    <label class="block mb-2 font-medium">

                        Deskripsi

                    </label>

                    <textarea name="description" rows="4" class="w-full border rounded-xl px-4 py-3"></textarea>

                </div>

                <div class="grid grid-cols-2 gap-6">

                    <div>

                        <label class="block mb-2 font-medium">

                            Foto Before

                        </label>

                        <input type="file" name="before_image" accept="image/*"
                            class="w-full border rounded-xl px-4 py-3" required>

                    </div>

                    <div>

                        <label class="block mb-2 font-medium">

                            Foto After

                        </label>

                        <input type="file" name="after_image" accept="image/*" class="w-full border rounded-xl px-4 py-3"
                            required>

                    </div>

                </div>

                <div class="flex gap-3 mt-8">

                    <a href="{{ route('admin.galleries.index') }}" class="px-6 py-3 rounded-xl bg-gray-200">

                        Kembali

                    </a>

                    <button class="px-6 py-3 rounded-xl bg-indigo-600 text-white">

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection
