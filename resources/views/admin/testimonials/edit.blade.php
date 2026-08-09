@extends('admin.layouts.app')

@section('title', 'Edit Testimoni')

@section('content')

    <div class="max-w-3xl mx-auto">

        <h1 class="text-3xl font-bold mb-8">
            Edit Testimoni
        </h1>

        <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-2xl shadow p-6 space-y-5">

            @csrf
            @method('PUT')

            <div>
                <label class="font-semibold">Nama Pelanggan</label>

                <input type="text" name="customer_name" value="{{ old('customer_name', $testimonial->customer_name) }}"
                    class="w-full border rounded-lg p-3 mt-2">
            </div>

            <div>
                <label class="font-semibold">Foto</label>

                @if ($testimonial->photo)
                    <div class="my-3">
                        <img src="{{ asset('storage/' . $testimonial->photo) }}" class="w-24 h-24 rounded-full object-cover">
                    </div>
                @endif

                <input type="file" name="photo" class="w-full border rounded-lg p-3 mt-2">
            </div>

            <div>
                <label class="font-semibold">Rating</label>

                <select name="rating" class="w-full border rounded-lg p-3 mt-2">

                    @for ($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>
                            ⭐ {{ $i }}
                        </option>
                    @endfor

                </select>
            </div>

            <div>
                <label class="font-semibold">Testimoni</label>

                <textarea name="message" rows="5" class="w-full border rounded-lg p-3 mt-2">{{ old('message', $testimonial->message) }}</textarea>
            </div>

            <div>
                <label>

                    <input type="checkbox" name="is_active" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>

                    Aktif

                </label>
            </div>

            <div class="flex gap-3">

                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg">

                    Update

                </button>

                <a href="{{ route('admin.testimonials.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg">

                    Batal

                </a>

            </div>

        </form>

    </div>

@endsection
