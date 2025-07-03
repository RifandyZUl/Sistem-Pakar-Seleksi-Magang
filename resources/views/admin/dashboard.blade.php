<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800">Dashboard Admin</h2>
            <span class="text-sm text-gray-500">Last login: {{ now()->format('d M Y H:i') }}</span>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Card Selamat Datang --}}
                <div class="col-span-1 md:col-span-2 bg-white rounded-xl shadow p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Halo, {{ auth()->user()->name }} 👋</h3>
                    <p class="text-gray-600">
                        Selamat datang di halaman admin. Gunakan panel ini untuk mengelola data kriteria, alternatif, nilai, dan melakukan perhitungan.
                    </p>
                </div>

                {{-- Card Info --}}
                <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white rounded-xl shadow p-6 flex items-center justify-between">
                    <div>
                        <h4 class="text-lg font-semibold">Perhitungan WP</h4>
                        <p class="text-sm">Lihat hasil ranking terbaru</p>
                    </div>
                    <a href="{{ route('admin.perhitungan') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-4 py-2 rounded-lg text-sm font-medium">
                        Lihat
                    </a>
                </div>
            </div>

            {{-- Panel Aksi --}}
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="{{ route('admin.kriteria.index') }}" class="block bg-white shadow rounded-lg p-5 hover:shadow-md transition">
                    <h5 class="text-lg font-semibold text-gray-800">Kelola Kriteria</h5>
                    <p class="text-sm text-gray-500 mt-2">Tambah, ubah, atau hapus kriteria penilaian.</p>
                </a>


                <a href="{{ route('admin.perhitungan') }}" class="block bg-white shadow rounded-lg p-5 hover:shadow-md transition">
                    <h5 class="text-lg font-semibold text-gray-800">Lihat Hasil</h5>
                    <p class="text-sm text-gray-500 mt-2">Tampilkan hasil perhitungan WP.</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
