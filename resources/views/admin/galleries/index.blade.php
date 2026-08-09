@extends('admin.layouts.app')

@section('title', 'Galeri')

@section('content')

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-3xl font-bold">
            Galeri
        </h1>

        <a href="{{ route('admin.galleries.create') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl">

            + Tambah Galeri

        </a>

    </div>

    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <table class="datatable w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-4 text-left">Before</th>

                    <th class="p-4 text-left">After</th>

                    <th class="p-4 text-left">Judul</th>

                    <th class="p-4 text-left">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($galleries as $gallery)
                    <tr class="border-b">

                        <td class="p-4">

                            <img src="{{ asset('storage/' . $gallery->before_image) }}"
                                class="w-24 h-24 object-cover rounded-lg">

                        </td>

                        <td class="p-4">

                            <img src="{{ asset('storage/' . $gallery->after_image) }}"
                                class="w-24 h-24 object-cover rounded-lg">

                        </td>

                        <td class="p-4">

                            <h3 class="font-semibold">
                                {{ $gallery->title }}
                            </h3>

                            <p class="text-gray-500 text-sm">
                                {{ $gallery->description }}
                            </p>

                        </td>

                        <td class="p-4">

                            <div class="flex gap-2">

                                <a href="{{ route('admin.galleries.edit', $gallery) }}"
                                    class="bg-yellow-500 text-white px-4 py-2 rounded-lg">

                                    Edit

                                </a>

                                <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST"
                                    class="delete-form">

                                    @csrf
                                    @method('DELETE')

                                    <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="p-10 text-center text-gray-400">

                            Belum ada galeri

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>
@endsection
@push('scripts')
    <script>
        document.querySelectorAll('.delete-form').forEach(form => {

            form.addEventListener('submit', function(e) {

                e.preventDefault();

                Swal.fire({
                    title: 'Hapus galeri?',
                    text: 'Data tidak bisa dikembalikan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {

                    if (result.isConfirmed) {
                        form.submit();
                    }

                });

            });

        });
    </script>
@endpush
