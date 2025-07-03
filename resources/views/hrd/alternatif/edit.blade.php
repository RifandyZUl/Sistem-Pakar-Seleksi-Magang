<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Edit Alternatif</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto px-4">
        <form method="POST" action="{{ route('hrd.alternatif.update', $alternatif) }}" class="bg-white p-6 shadow rounded-lg space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Alternatif</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $alternatif->nama) }}"
                       class="w-full border-gray-300 rounded px-3 py-2 shadow-sm focus:ring focus:ring-blue-200 focus:outline-none">
                @error('nama') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">
                    Update
                </button>
                <a href="{{ route('hrd.alternatif.index') }}" class="text-gray-600 hover:underline">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
