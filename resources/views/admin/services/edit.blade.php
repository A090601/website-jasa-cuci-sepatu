@extends('admin.layouts.app')

@section('title', 'Edit Layanan')

@section('content')

    <div class="max-w-4xl mx-auto">

        <div class="bg-white rounded-2xl shadow-lg p-8">

            <h1 class="text-3xl font-bold mb-8">

                Edit Layanan

            </h1>

            <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <input type="text" name="name" value="{{ old('name', $service->name) }}"
                    class="w-full border rounded-xl p-3 mb-5">

                <textarea name="description" rows="5" class="w-full border rounded-xl p-3 mb-5">{{ old('description', $service->description) }}</textarea>

                @if ($service->image)
                    <img src="{{ asset('storage/' . $service->image) }}" class="w-56 rounded-xl mb-5">
                @endif

                <input type="file" name="image" class="w-full border rounded-xl p-3 mb-5">

                <label class="inline-flex items-center mb-6">

                    <input type="checkbox" name="is_active" {{ $service->is_active ? 'checked' : '' }} class="mr-2">

                    Aktif

                </label>

                <br>

                <button class="bg-blue-600 text-white px-8 py-3 rounded-xl">

                    Update

                </button>

            </form>

        </div>

    </div>

@endsection
