<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Data Kriteria</h2>
    </x-slot>

    <div class="py-6 px-6 max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-700">Daftar Kriteria</h3>
            <a href="{{ route('admin.kriteria.create') }}"
               class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Kriteria
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 px-4 py-2 rounded bg-green-100 text-green-800 border border-green-300">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded shadow-sm">
            <table class="w-full border border-gray-300 text-sm">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="p-3 text-center">No</th>
                        <th class="p-3 text-left">Nama</th>
                        <th class="p-3 text-left">Bobot</th>
                        <th class="p-3 text-left">Sifat</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-gray-800">
                    @forelse ($kriterias as $index => $kriteria)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-3 text-center">{{ $index + 1 }}</td>
                            <td class="p-3">{{ $kriteria->nama }}</td>
                            <td class="p-3">{{ number_format($kriteria->bobot, 2) }}</td>
                            <td class="p-3 capitalize">{{ $kriteria->sifat }}</td>
                            <td class="p-3 text-center">
                                <a href="{{ route('admin.kriteria.edit', $kriteria) }}"
                                   class="text-indigo-600 hover:underline mr-2">Edit</a>

                                <form action="{{ route('admin.kriteria.destroy', $kriteria) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Yakin ingin hapus?')"
                                            class="text-red-600 hover:underline">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 py-4">Belum ada kriteria</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
