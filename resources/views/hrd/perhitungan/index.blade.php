<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Hasil Seleksi Kandidat</h2>
    </x-slot>

    <div class="py-6 px-6 max-w-5xl mx-auto">
        <form method="GET" action="{{ route('hrd.perhitungan') }}" class="mb-6">
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
        <div>
            <label for="metode" class="block text-sm font-medium text-gray-700 mb-1">Pilih Metode Perhitungan</label>
            <select name="metode" id="metode" onchange="this.form.submit()"
                    class="block w-60 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="wp" {{ $metode === 'wp' ? 'selected' : '' }}>Weighted Product</option>
                <option value="vikor" {{ $metode === 'vikor' ? 'selected' : '' }}>VIKOR</option>
            </select>
        </div>

        @if (!collect($hasil)->isEmpty())
            <div>
                <label class="block text-sm font-medium text-transparent mb-1">.</label> {{-- spasi agar rata --}}
                <a href="{{ route('hrd.perhitungan.pdf', ['metode' => $metode]) }}"
                   class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow transition">
                    ⬇️ Unduh PDF
                </a>
            </div>
        @endif
    </div>
</form>


        @if (collect($hasil)->isEmpty())
            <div class="text-gray-500 text-center bg-yellow-50 border border-yellow-300 rounded p-4">
                Belum ada data yang bisa dihitung. Pastikan semua alternatif memiliki nilai lengkap untuk setiap kriteria.
            </div>
        @else
            <div class="overflow-x-auto bg-white rounded shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">#</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Alternatif</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                {{ $metode === 'vikor' ? 'Nilai Q (VIKOR)' : 'Skor WP' }}
                            </th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($hasil as $i => $row)
                            <tr class="{{ $i === 0 ? 'bg-green-50 font-semibold' : '' }}">
                                <td class="px-4 py-2 whitespace-nowrap">{{ $i + 1 }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">{{ $row['nama'] }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    {{ number_format($row[$metode === 'vikor' ? 'nilai_q' : 'nilai_v'], 5) }}
                                </td>
                                <td class="px-4 py-2">
                                    @if ($i === 0)
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                            Rekomendasi
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
