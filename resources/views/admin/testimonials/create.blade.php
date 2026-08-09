@extends('admin.layouts.app')

@section('title', 'Tambah Testimoni')

@section('content')

    <div class="max-w-4xl mx-auto">

        <h1 class="text-3xl font-bold mb-6">
            Tambah Testimoni
        </h1>

        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-2xl shadow p-8">

            @csrf

            <div class="mb-5">
                <label class="block font-semibold mb-2">
                    Nama Pelanggan
                </label>

                <input type="text" name="customer_name" class="w-full border rounded-lg p-3" required>
            </div>

            <div class="mb-5">
                <label class="block font-semibold mb-2">
                    Foto
                </label>

                <input type="file" name="photo" class="w-full border rounded-lg p-3">
            </div>

            <div class="mb-5">
                <label class="block font-semibold mb-2">
                    Rating
                </label>

                <select name="rating" class="w-full border rounded-lg p-3">

                    <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                    <option value="4">⭐⭐⭐⭐ (4)</option>
                    <option value="3">⭐⭐⭐ (3)</option>
                    <option value="2">⭐⭐ (2)</option>
                    <option value="1">⭐ (1)</option>

                </select>
            </div>

            <div class="mb-5">
                <label class="block font-semibold mb-2">
                    Testimoni
                </label>

                <textarea name="message" rows="5" class="w-full border rounded-lg p-3" required></textarea>
            </div>

            <div class="mb-6">
                <label class="inline-flex items-center gap-2">

                    <input type="checkbox" name="is_active" checked>

                    Aktif

                </label>
            </div>

            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg">

                Simpan

            </button>

        </form>

    </div>

@endsection
