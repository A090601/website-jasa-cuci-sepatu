<section id="services" class="py-20 bg-slate-100">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-14">
            <h2 class="text-4xl font-bold">Layanan Kami</h2>
            <p class="text-gray-500 mt-2">
                Pilih layanan yang sesuai dengan kebutuhan sepatu Anda.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            {{-- STRUKTUR @FORELSE SAMA PERSIS SEPERTI PRICING --}}
            @forelse($services as $service)
                <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition">
                    
                    {{-- Ikon otomatis dari database, jika kosong otomatis memakai ikon sabun --}}
                    <i class="fa-solid {{ $service->icon ?? 'fa-soap' }} text-4xl text-blue-600"></i>
                    
                    {{-- Nama Layanan Dinamis dari Admin Panel --}}
                    <h3 class="text-2xl font-bold mt-4">
                        {{ $service->name }}
                    </h3>
                    
                    {{-- Deskripsi Layanan Dinamis dari Admin Panel --}}
                    <p class="mt-3 text-gray-500">
                        {{ $service->description }}
                    </p>

                </div>
            @empty
                {{-- Kondisi cadangan jika admin belum memasukkan data atau menonaktifkan layanan --}}
                <div class="col-span-3 text-center text-gray-500 py-10">
                    Belum ada daftar layanan aktif.
                </div>
            @endforelse

        </div>

    </div>
</section>
