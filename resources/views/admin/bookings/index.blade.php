@extends('admin.layouts.app')

@section('title', 'Booking')

@section('content')

    <div class="space-y-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

            <div>

                <h1 class="text-3xl font-bold text-gray-800">
                    Booking
                </h1>

                <p class="text-gray-500 mt-1">
                    Kelola seluruh booking pelanggan
                </p>

            </div>

            <div class="flex flex-wrap gap-3">

                <a href="{{ route('admin.bookings.pdf') }}"
                    class="bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-xl shadow">

                    Export PDF

                </a>

                <a href="{{ route('admin.bookings.excel') }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl shadow">

                    Export Excel

                </a>

                <a href="{{ route('admin.bookings.create') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl shadow">

                    + Booking Baru

                </a>

            </div>

        </div>

        {{-- SEARCH --}}
        <form method="GET" action="{{ route('admin.bookings.index') }}" class="bg-white rounded-2xl shadow p-6">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama pelanggan atau nomor HP..." class="border rounded-xl px-4 py-3">

                <select name="status" class="border rounded-xl px-4 py-3">

                    <option value="">Semua Status</option>

                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>

                        Pending

                    </option>

                    <option value="process" {{ request('status') == 'process' ? 'selected' : '' }}>

                        Diproses

                    </option>

                    <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>

                        Selesai

                    </option>

                </select>

                <button class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl">

                    Cari

                </button>

                <a href="{{ route('admin.bookings.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 rounded-xl flex items-center justify-center">

                    Reset

                </a>

            </div>

        </form>

        <div class="bg-white rounded-2xl shadow overflow-x-auto">

            <table id="bookingTable" class="datatable min-w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-4 text-left font-semibold">
                            Pelanggan
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Layanan
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Tanggal
                        </th>

                        <th class="px-6 py-4 text-center font-semibold">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center font-semibold">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($bookings as $booking)
                        <tr class="border-b hover:bg-gray-50 transition">

                            {{-- Pelanggan --}}
                            <td class="px-6 py-5 align-middle">

                                <div class="text-xs text-indigo-600 font-semibold">
                                    {{ $booking->booking_code }}
                                </div>

                                <div class="font-semibold text-gray-800">

                                    {{ $booking->customer_name }}

                                </div>

                                <div class="text-sm text-gray-500">

                                    {{ $booking->phone }}

                                </div>

                            </td>

                            {{-- Layanan --}}
                            <td class="px-6 py-5 align-middle">

                                <div class="font-medium text-gray-700">

                                    {{ $booking->service->name ?? '-' }}

                                </div>

                            </td>

                            {{-- Tanggal --}}
                            <td class="px-6 py-5 align-middle">

                                <div class="text-gray-700">

                                    {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d M Y') }}

                                </div>

                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-5 align-middle text-center">

                                @if ($booking->status == 'pending')
                                    <span
                                        class="inline-flex items-center rounded-full bg-yellow-100 text-yellow-700 px-4 py-2 text-sm font-medium">

                                        Pending

                                    </span>
                                @elseif($booking->status == 'process')
                                    <span
                                        class="inline-flex items-center rounded-full bg-blue-100 text-blue-700 px-4 py-2 text-sm font-medium">

                                        Diproses

                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center rounded-full bg-green-100 text-green-700 px-4 py-2 text-sm font-medium">

                                        Selesai

                                    </span>
                                @endif

                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-5 align-middle">

                                <div class="flex justify-center items-center gap-2">

                                    <a href="{{ route('admin.bookings.show', $booking) }}"
                                        class="bg-sky-500 hover:bg-sky-600 text-white px-4 py-2 rounded-lg text-sm">

                                        Detail

                                    </a>

                                    <a href="{{ route('admin.bookings.edit', $booking) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm">

                                        Edit

                                    </a>

                                    <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST"
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

                            <td colspan="5" class="py-12 text-center text-gray-400">

                                Belum ada booking

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

@endsection

@push('scripts')
    <script>
        $(function() {

            // Sembunyikan search bawaan DataTables
            $('#bookingTable_filter').hide();

            // Hapus event lama jika ada
            $(document).off('submit', '.delete-form');

            // Pasang event baru
            $(document).on('submit', '.delete-form', function(e) {

                e.preventDefault();

                const form = this;

                Swal.fire({
                    title: 'Hapus booking?',
                    text: 'Data tidak bisa dikembalikan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {

                    if (result.isConfirmed) {
                        HTMLFormElement.prototype.submit.call(form);
                    }

                });

            });

        });
    </script>
@endpush
