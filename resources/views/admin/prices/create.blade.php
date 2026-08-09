@extends('admin.layouts.app')

@section('title', 'Tambah Harga')

@section('content')

    <div class="max-w-3xl mx-auto">

        <div class="flex items-center justify-between mb-8">

            <div>
                <h1 class="text-3xl font-bold">
                    Tambah Harga
                </h1>

                <p class="text-gray-500">
                    Tambahkan paket harga layanan baru.
                </p>
            </div>

            <a href="{{ route('admin.prices.index') }}" class="bg-gray-200 hover:bg-gray-300 px-5 py-3 rounded-xl">

                Kembali

            </a>

        </div>

        <div class="bg-white rounded-2xl shadow p-8">

            <form action="{{ route('admin.prices.store') }}" method="POST">

                @csrf

                <div class="space-y-6">

                    <div>

                        <label class="block mb-2 font-semibold">

                            Layanan

                        </label>

                        <select name="service_id" class="w-full border rounded-xl p-3">

                            <option value="">
                                -- Pilih Layanan --
                            </option>

                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">

                                    {{ $service->name }}

                                </option>
                            @endforeach

                        </select>

                        @error('service_id')
                            <small class="text-red-500">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                    <div>

                        <label class="block mb-2 font-semibold">

                            Nama Paket

                        </label>

                        <input type="text" name="package_name" class="w-full border rounded-xl p-3"
                            placeholder="Contoh : Regular">

                        @error('package_name')
                            <small class="text-red-500">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                    <div>

                        <label class="block mb-2 font-semibold">

                            Harga

                        </label>

                        <input type="number" name="price" class="w-full border rounded-xl p-3" placeholder="35000">

                        @error('price')
                            <small class="text-red-500">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                    <div>

                        <label class="block mb-2 font-semibold">

                            Durasi

                        </label>

                        <input type="text" name="duration" class="w-full border rounded-xl p-3" placeholder="2 Hari">

                        @error('duration')
                            <small class="text-red-500">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                    <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-xl">

                        Simpan Harga

                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection
