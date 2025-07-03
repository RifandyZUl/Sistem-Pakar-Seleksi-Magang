<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Edit Kriteria</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
       <form method="POST" action="{{ route('admin.kriteria.update', $kriteria->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Nama Kriteria</label>
                <input type="text" name="nama" value="{{ old('nama', $kriteria->nama) }}" class="w-full border rounded p-2">
                @error('nama') <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label>Bobot</label>
                <input type="number" step="0.01" name="bobot" value="{{ old('bobot', $kriteria->bobot) }}" class="w-full border rounded p-2">
                @error('bobot') <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label>Sifat</label>
                <select name="sifat" class="w-full border rounded p-2">
                    <option value="benefit" {{ $kriteria->sifat === 'benefit' ? 'selected' : '' }}>Benefit</option>
                    <option value="cost" {{ $kriteria->sifat === 'cost' ? 'selected' : '' }}>Cost</option>
                </select>
                @error('sifat') <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('admin.kriteria.index') }}" class="ml-2 text-gray-600">Batal</a>
        </form>
    </div>
</x-app-layout>
