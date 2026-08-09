TEST123
@extends('admin.layouts.app')

@section('title', 'Testimoni')

@section('content')

    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-3xl font-bold">
                Testimoni
            </h1>

            <p class="text-gray-500">
                Kelola testimoni pelanggan
            </p>
        </div>

    </div>

    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <table id="testimonialTable" class="datatable min-w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-4">Foto</th>

                    <th class="p-4">Nama</th>

                    <th class="p-4">Rating</th>

                    <th class="p-4">Testimoni</th>

                    <th class="p-4">Status</th>

                    <th class="p-4 text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($testimonials as $testimonial)
                    <tr class="border-b">

                        <td class="py-3">
                            @if ($testimonial->photo)
                                <img src="{{ asset('storage/' . $testimonial->photo) }}"
                                    class="w-12 h-12 rounded-full object-cover border">
                            @else
                                <div
                                    class="w-12 h-12 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($testimonial->customer_name, 0, 1)) }}
                                </div>
                            @endif
                        </td>

                        <td class="p-4 font-semibold">

                            {{ $testimonial->customer_name }}

                        </td>

                        <td class="p-4">

                            ⭐ {{ $testimonial->rating }}/5

                        </td>

                        <td class="p-4">

                            {{ Str::limit($testimonial->message, 60) }}

                        </td>

                        <td class="p-4">

                            @if ($testimonial->is_active)
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                                    Aktif

                                </span>
                            @else
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">

                                    Nonaktif

                                </span>
                            @endif

                        </td>

                        <td class="p-4">

                            <div class="flex justify-center gap-2">

                                <form action="{{ route('admin.testimonials.toggle', $testimonial) }}" method="POST">

                                    @csrf
                                    @method('PATCH')

                                    @if ($testimonial->is_active)
                                        <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                                            Nonaktifkan
                                        </button>
                                    @else
                                        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                                            Aktifkan
                                        </button>
                                    @endif

                                </form>

                                <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST"
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

                            Belum ada testimoni.

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.delete-form').forEach(function(form) {

                form.addEventListener('submit', function(e) {

                    e.preventDefault();

                    Swal.fire({
                        title: 'Hapus testimoni?',
                        text: 'Data tidak bisa dikembalikan.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#6b7280'
                    }).then((result) => {

                        if (result.isConfirmed) {
                            form.submit();
                        }

                    });

                });

            });

        });
    </script>
@endpush
