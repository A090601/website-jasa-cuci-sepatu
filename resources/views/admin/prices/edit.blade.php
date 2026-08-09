@extends('admin.layouts.app')

@section('title', 'Edit Harga')

@section('content')

    <div class="max-w-3xl mx-auto">

        <div class="flex items-center justify-between mb-8">

            <div>

                <h1 class="text-3xl font-bold">
                    Edit Harga
                </h1>

                <p class="text-gray-500">
                    Perbarui data harga layanan.
                </p>

            </div>

            <a href="{{ route('admin.prices.index') }}" class="bg-gray-200 hover:bg-gray-300 px-5 py-3 rounded-xl">

                Kembali

            </a>

        </div>

        <div class="bg-white rounded-2xl shadow p-8">

            <form action="{{ route('admin.prices.update', $price) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="space-y-6">

                    <div>

                        <label class="block mb-2 font-semibold">

                            Layanan

                        </label>

                        <select name="service_id" class="w-full border rounded-xl p-3">

                            @foreach ($services as $service)
                                <option value="{{ $service->id }}"
                                    {{ $price->service_id == $service->id ? 'selected' : '' }}>

                                    {{ $service->name }}

                                </option>
                            @endforeach

                        </select>

                        @error('service_id')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror

                    </div>

                    <div>

                        <label class="block mb-2 font-semibold">

                            Nama Paket

                        </label>

                        <input type="text" name="package_name" value="{{ old('package_name', $price->package_name) }}"
                            class="w-full border rounded-xl p-3">

                        @error('package_name')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror

                    </div>

                    <div>

                        <label class="block mb-2 font-semibold">

                            Harga

                        </label>

                        <input type="number" name="price" value="{{ old('price', $price->price) }}"
                            class="w-full border rounded-xl p-3">

                        @error('price')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror

                    </div>

                    <div>

                        <label class="block mb-2 font-semibold">

                            Durasi

                        </label>

                        <input type="text" name="duration" value="{{ old('duration', $price->duration) }}"
                            class="w-full border rounded-xl p-3">

                        @error('duration')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror

                    </div>

                    <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-xl">

                        Update Harga

                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection
