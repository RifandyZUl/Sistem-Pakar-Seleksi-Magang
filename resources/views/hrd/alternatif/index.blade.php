<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Data Alternatif</h2>
    </x-slot>

    <div class="py-6 px-6 max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-700">Daftar Alternatif</h3>
            <a href="{{ route('hrd.alternatif.create') }}"
               class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Alternatif
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
                        <th class="p-3 text-center w-16">No</th>
                        <th class="p-3 text-left">Nama Alternatif</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-gray-800">
                    @forelse ($alternatifs as $index => $alternatif)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-3 text-center">{{ $index + 1 }}</td>
                            <td class="p-3">{{ $alternatif->nama }}</td>
                            <td class="p-3 text-center">
                                <a href="{{ route('hrd.alternatif.edit', $alternatif) }}"
                                   class="text-indigo-600 hover:underline mr-2">Edit</a>
                                <form action="{{ route('hrd.alternatif.destroy', $alternatif) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus?')"
                                            class="text-red-600 hover:underline">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-500">
                                Belum ada alternatif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
