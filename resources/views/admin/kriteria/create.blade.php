<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-900">Tambah Kriteria</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form method="POST" action="{{ route('admin.kriteria.store') }}" class="bg-white shadow rounded p-6">
            @csrf

            <div class="mb-4">
                <label class="block font-medium text-gray-700 mb-1">Nama Kriteria</label>
                <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('nama') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700 mb-1">Bobot (0 - 1)</label>
                <input type="number" step="0.01" name="bobot" value="{{ old('bobot') }}" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('bobot') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="mb-6">
                <label class="block font-medium text-gray-700 mb-1">Sifat</label>
                <select name="sifat" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="benefit" {{ old('sifat') == 'benefit' ? 'selected' : '' }}>Benefit</option>
                    <option value="cost" {{ old('sifat') == 'cost' ? 'selected' : '' }}>Cost</option>
                </select>
                @error('sifat') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">Simpan</button>
                <a href="{{ route('admin.kriteria.index') }}" class="text-gray-700 hover:underline">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
