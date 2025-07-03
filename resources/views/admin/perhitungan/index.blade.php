<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Hasil Perhitungan {{ strtoupper($metode) === 'VIKOR' ? 'VIKOR' : 'Weighted Product (WP)' }}
        </h2>
    </x-slot>

    <div class="py-6 px-6 max-w-5xl mx-auto">
        @if (collect($hasil)->isEmpty())
            <div class="text-center text-gray-600 text-lg">
                Belum ada data nilai yang bisa dihitung.
            </div>
        @else

        <!-- Pilihan Metode -->
        <form action="{{ route('admin.perhitungan') }}" method="GET" class="mb-6">
            <div class="flex items-center gap-3">
                <label for="metode" class="font-semibold text-gray-700">Pilih Metode:</label>
                <select id="metode" name="metode"
                    onchange="this.form.submit()"
                    class="w-64 border border-gray-300 rounded px-3 py-2 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="wp" {{ request('metode') === 'wp' ? 'selected' : '' }}>
                        Weighted Product (WP)
                    </option>
                    <option value="vikor" {{ request('metode') === 'vikor' ? 'selected' : '' }}>
                        VIKOR
                    </option>
                </select>
            </div>
        </form>


        <!-- Informasi Rekomendasi -->
        <div class="mb-6 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div class="text-green-800 bg-green-100 border border-green-300 rounded px-4 py-3 text-sm shadow-sm">
                ✅ <strong>Rekomendasi Terbaik:</strong>
                <span class="font-semibold text-blue-600">{{ $hasil->first()['nama'] }}</span>
                (Skor: 
                {{ $metode === 'vikor' 
                    ? number_format($hasil->first()['nilai_q'], 5) 
                    : number_format($hasil->first()['nilai_v'], 5) }}
                )
            </div>

                <a href="{{ route('admin.perhitungan.pdf', ['metode' => $metode]) }}" target="_blank"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                ⬇️ Cetak PDF
                </a>

        </div>

        <!-- Tabel Hasil -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-2 text-center w-12">#</th>
                        <th class="border p-2 text-left">Nama Alternatif</th>
                        <th class="border p-2 text-left">
                            Skor {{ $metode === 'vikor' ? 'VIKOR (Q)' : 'WP' }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hasil as $i => $row)
                        <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="border p-2 text-center">{{ $i + 1 }}</td>
                            <td class="border p-2">{{ $row['nama'] }}</td>
                            <td class="border p-2">
                                {{ $metode === 'vikor'
                                    ? number_format($row['nilai_q'], 5)
                                    : number_format($row['nilai_v'], 5) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</x-app-layout>
