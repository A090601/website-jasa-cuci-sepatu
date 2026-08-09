@extends('admin.layouts.app')

@section('title', 'Daftar Harga')

@section('content')

    <div class="space-y-6">

        <div class="flex justify-between items-center">

            <div>
                <h1 class="text-3xl font-bold">
                    Daftar Harga
                </h1>

                <p class="text-gray-500">
                    Kelola harga setiap layanan
                </p>
            </div>

            <a href="{{ route('admin.prices.create') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl">

                + Tambah Harga

            </a>

        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-xl">

                {{ session('success') }}

            </div>
        @endif

        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <table id="priceTable" class="datatable min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="text-left p-4">No</th>

                        <th class="text-left p-4">Layanan</th>

                        <th class="text-left p-4">Paket</th>

                        <th class="text-left p-4">Harga</th>

                        <th class="text-left p-4">Durasi</th>

                        <th class="text-center p-4">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($prices as $item)
                        <tr class="border-b">

                            <td class="p-4">

                                {{ $loop->iteration }}

                            </td>

                            <td class="p-4">

                                {{ $item->service->name }}

                            </td>

                            <td class="p-4">

                                {{ $item->package_name }}

                            </td>

                            <td class="p-4 font-semibold text-green-600">

                                Rp {{ number_format($item->price, 0, ',', '.') }}

                            </td>

                            <td class="p-4">

                                {{ $item->duration }}

                            </td>

                            <td class="p-4">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('admin.prices.edit', $item) }}"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-lg">

                                        Edit

                                    </a>

                                    <form action="{{ route('admin.prices.destroy', $item) }}" method="POST"
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

                            <td colspan="6" class="text-center p-8 text-gray-400">

                                Belum ada data harga.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- <div>
    {{ $prices->links() }}
</div> --}}

    </div>
    @push('scripts')
        <script>
            document.querySelectorAll('.delete-form').forEach(form => {

                form.addEventListener('submit', function(e) {

                    e.preventDefault();

                    Swal.fire({
                        title: 'Hapus harga?',
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
@endsection
