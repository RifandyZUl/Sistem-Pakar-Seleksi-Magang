<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Input Nilai Alternatif</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        @if (session('success'))
            <div class="mb-4 px-4 py-2 rounded bg-green-100 text-green-800 border border-green-300">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('hrd.nilai.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium text-gray-700 mb-1">Pilih Alternatif</label>
                <select name="alternatif_id" class="w-full border p-2 rounded">
                    <option value="">-- Pilih --</option>
                    @foreach ($alternatifs as $alt)
                        <option value="{{ $alt->id }}">{{ $alt->nama }}</option>
                    @endforeach
                </select>
                @error('alternatif_id') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            @foreach ($kriterias as $kriteria)
                <div>
                    <label class="block font-medium text-gray-700 mb-1">{{ $kriteria->nama }}</label>

                    @if (strtolower($kriteria->nama) === 'jarak rumah')
                        <div class="flex gap-2">
                            <input type="number" step="0.01" name="nilai[{{ $kriteria->id }}][value]"
                                   class="flex-1 border p-2 rounded" placeholder="Masukkan nilai">
                            <select name="nilai[{{ $kriteria->id }}][satuan]"
                                    class="w-28 border p-2 rounded">
                                <option value="km">km</option>
                                <option value="m">m</option>
                            </select>
                        </div>
                    @else
                        <input type="number" step="0.01" name="nilai[{{ $kriteria->id }}]"
                               class="w-full border p-2 rounded" placeholder="Masukkan nilai">
                    @endif

                    @error("nilai.{$kriteria->id}") <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                </div>
            @endforeach

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </form>
    </div>
</x-app-layout>
