@extends('admin.layouts.app')

@section('title', 'Layanan')

@section('content')

    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold">

                Kelola Layanan

            </h1>

            <p class="text-gray-500">

                Manajemen seluruh layanan ShoeWash

            </p>

        </div>

        <a href="{{ route('admin.services.create') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl">

            + Tambah Layanan

        </a>

    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

        <table id="serviceTable" class="datatable min-w-full divide-y divide-gray-200">

            <thead class="bg-gray-100">
                <tr>

                    <th class="px-6 py-4 text-left text-sm font-semibold">
                        Gambar
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold">
                        Nama
                    </th>

                    <th class="px-6 py-4 text-left text-sm font-semibold">
                        Status
                    </th>

                    <th class="px-6 py-4 text-center text-sm font-semibold">
                        Aksi
                    </th>

                </tr>
            </thead>

            <tbody>

                @forelse($services as $service)
                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-4">
                            @if ($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}"
                                    class="w-16 h-16 object-cover rounded-lg border">
                            @else
                                <div class="w-16 h-16 rounded-lg bg-gray-200 flex items-center justify-center">
                                    -
                                </div>
                            @endif
                        </td>

                        <td class="p-4 font-semibold">
                            {{ $service->name }}
                        </td>

                        <td class="p-4">

                            @if ($service->is_active)
                                <span
                                    class="inline-flex px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                                    Aktif
                                </span>
                            @else
                                <span
                                    class="inline-flex px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-semibold">
                                    Nonaktif
                                </span>
                            @endif

                        </td>

                        <td class="p-4">

                            <div class="flex justify-center gap-2">

                                <a href="{{ route('admin.services.edit', $service) }}"
                                    class="inline-flex items-center justify-center w-24 h-10 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg font-medium transition">
                                    Edit
                                </a>

                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST"
                                    class="delete-form">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="inline-flex items-center justify-center w-24 h-10 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition">
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="text-center py-12 text-gray-500">
                            Belum ada layanan.
                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">
    </div>

@endsection
@push('scripts')
    <script>
        document.querySelectorAll('.delete-form').forEach(form => {

            form.addEventListener('submit', function(e) {

                e.preventDefault();

                Swal.fire({
                    title: 'Hapus layanan?',
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
