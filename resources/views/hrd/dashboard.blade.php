<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-bold text-gray-900">Dashboard HRD</h2>
    </x-slot>

    <div class="py-8 px-6 max-w-6xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg p-8 space-y-8">
            <!-- Selamat Datang -->
            <div class="space-y-2">
                <h3 class="text-2xl font-semibold text-gray-800">
                    Selamat Datang, {{ auth()->user()->name }} <span class="text-sm font-normal text-gray-500">(HRD)</span>
                </h3>
                <p class="text-gray-600 text-base">
                    Sistem ini dirancang untuk membantu Anda dalam menyeleksi kandidat terbaik berdasarkan kriteria yang telah ditentukan secara objektif dan terukur.
                </p>
            </div>

            <!-- Deskripsi Sistem dan Peran -->
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h4 class="text-lg font-medium text-blue-800 mb-2">Tentang Sistem</h4>
                    <p class="text-gray-700 text-sm leading-relaxed">
                        Sistem Pendukung Keputusan ini menggunakan metode <strong>Weighted Product (WP)</strong> dan <strong>VIKOR</strong> untuk memberikan hasil seleksi kandidat yang objektif dan efisien.
                    </p>
                </div>
                <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                    <h4 class="text-lg font-medium text-green-800 mb-2">Peran Anda</h4>
                    <p class="text-gray-700 text-sm leading-relaxed">
                        Sebagai HRD, Anda dapat mengelola data alternatif (kandidat), menginput nilai dari setiap kriteria, serta melihat hasil seleksi dan rekomendasi terbaik.
                    </p>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex flex-col md:flex-row gap-4">
                <a href="{{ route('hrd.perhitungan') }}"
                   class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 text-center rounded-lg shadow transition">
                    🔍 Lihat Hasil Seleksi Kandidat
                </a>
                <a href="{{ route('hrd.alternatif.index') }}"
                   class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-3 text-center rounded-lg shadow transition">
                    👥 Kelola Data Alternatif
                </a>
                <a href="{{ route('hrd.nilai.index') }}"
                   class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-3 text-center rounded-lg shadow transition">
                    📝 Input Nilai Kandidat
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
