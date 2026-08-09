@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="space-y-8">

        {{-- CARD --}}

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition duration-300">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500 text-sm font-medium">
                            Total Booking
                        </p>

                        <h2 class="text-4xl font-bold mt-2 text-gray-800">
                            {{ $booking }}
                        </h2>

                    </div>

                    <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center text-2xl">
                        📅
                    </div>

                </div>

            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition duration-300">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500 text-sm font-medium">
                            Booking Hari Ini
                        </p>

                        <h2 class="text-4xl font-bold mt-2 text-indigo-600">
                            {{ $todayBooking }}
                        </h2>

                    </div>

                    <div class="w-14 h-14 rounded-xl bg-indigo-100 flex items-center justify-center text-2xl">
                        🗓️
                    </div>

                </div>

            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition duration-300">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500 text-sm font-medium">
                            Total Layanan
                        </p>

                        <h2 class="text-4xl font-bold mt-2 text-gray-800">
                            {{ $service }}
                        </h2>

                    </div>

                    <div class="w-14 h-14 rounded-xl bg-cyan-100 flex items-center justify-center text-2xl">
                        🧽
                    </div>

                </div>

            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition duration-300">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500 text-sm font-medium">
                            Total Galeri
                        </p>

                        <h2 class="text-4xl font-bold mt-2 text-gray-800">
                            {{ $gallery }}
                        </h2>

                    </div>

                    <div class="w-14 h-14 rounded-xl bg-purple-100 flex items-center justify-center text-2xl">
                        🖼️
                    </div>

                </div>

            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition duration-300">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500 text-sm font-medium">
                            Total Testimoni
                        </p>

                        <h2 class="text-4xl font-bold mt-2 text-gray-800">
                            {{ $testimonial }}
                        </h2>

                    </div>

                    <div class="w-14 h-14 rounded-xl bg-yellow-100 flex items-center justify-center text-2xl">
                        ⭐
                    </div>

                </div>

            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition duration-300">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500 text-sm font-medium">
                            Total Pendapatan
                        </p>

                        <h2 class="text-3xl font-bold mt-2 text-green-600">
                            Rp {{ number_format($revenue, 0, ',', '.') }}
                        </h2>

                    </div>

                    <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center text-2xl">
                        💰
                    </div>

                </div>

            </div>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-yellow-100 rounded-xl p-5">
                <p class="text-yellow-700">Pending</p>
                <h2 class="text-3xl font-bold">{{ $pending }}</h2>
            </div>

            <div class="bg-blue-100 rounded-xl p-5">
                <p class="text-blue-700">Diproses</p>
                <h2 class="text-3xl font-bold">{{ $process }}</h2>
            </div>

            <div class="bg-green-100 rounded-xl p-5">
                <p class="text-green-700">Selesai</p>
                <h2 class="text-3xl font-bold">{{ $done }}</h2>
            </div>

        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

            <h2 class="text-xl font-bold mb-6">
                Grafik Booking Bulanan
            </h2>

            <div class="h-80">
                <canvas id="bookingChart"></canvas>
            </div>

        </div>


        {{-- TABEL BOOKING --}}

        <div class="bg-white rounded-2xl shadow">

            <div class="p-6 border-b">

                <h2 class="font-bold text-lg">
                    Booking Terbaru
                </h2>

            </div>

            <table id="bookingTable" class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="text-left p-4">
                            Nama
                        </th>

                        <th class="text-left p-4">
                            Layanan
                        </th>

                        <th class="text-left p-4">
                            Status
                        </th>

                        <th class="text-left p-4">
                            Total
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($latestBookings as $item)
                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="p-4">
                                {{ $item->customer_name }}
                            </td>

                            <td class="p-4">
                                {{ $item->service->name ?? '-' }}
                            </td>

                            <td class="p-4">

                                @if ($item->status == 'pending')
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">
                                        Pending
                                    </span>
                                @elseif($item->status == 'process')
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">
                                        Diproses
                                    </span>
                                @else
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                        Selesai
                                    </span>
                                @endif

                            </td>

                            <td class="p-4">
                                Rp {{ number_format($item->total_price, 0, ',', '.') }}
                            </td>
                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="p-8 text-center text-gray-400">

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
        const ctx = document.getElementById('bookingChart');

        new Chart(ctx, {

            type: 'line',

            data: {

                labels: [
                    'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                    'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'
                ],

                datasets: [{

                    label: 'Booking',

                    data: @json($chart),

                    borderColor: '#4F46E5',

                    backgroundColor: 'rgba(79,70,229,.15)',

                    fill: true,

                    borderWidth: 3,

                    tension: .4,

                    pointRadius: 5

                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                plugins: {

                    legend: {

                        display: false

                    }

                },

                scales: {

                    y: {

                        beginAtZero: true,

                        ticks: {

                            precision: 0

                        }

                    }

                }

            }

        });
        $(document).ready(function() {

            $('#bookingTable').DataTable({
                pageLength: 10,
                ordering: true,
                searching: true,
                info: true,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    zeroRecords: "Data tidak ditemukan",
                    paginate: {
                        previous: "←",
                        next: "→"
                    }
                }
            });

        });
    </script>
@endpush
