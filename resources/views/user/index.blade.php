<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Manajemen Pengguna</h2>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8" x-data="{ konfirmHapus: false, hapusAksi: '', hapusNama: '' }">
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg border border-green-200">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">Data Pengguna</h3>
                <a href="{{ route('user.create') }}" class="px-5 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition-colors uppercase tracking-wide">
                    + Tambah Pengguna
                </a>
            </div>

            <table class="w-full text-left">
                <thead>
                    <tr class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-gray-100">
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($users as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $item->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $item->email }}</td>
                            <td class="px-6 py-4 text-right space-x-3">
                                <a href="{{ route('user.edit', $item->id) }}" class="text-indigo-600 font-medium hover:underline">Edit</a>
                                @if (auth()->id() !== $item->id)
                                    <button type="button"
                                        @click="konfirmHapus = true; hapusAksi = '{{ route('user.destroy', $item->id) }}'; hapusNama = '{{ $item->name }}'"
                                        class="text-red-600 font-medium hover:underline">Hapus</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-400">Belum ada pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Modal Konfirmasi Hapus -->
        <div x-show="konfirmHapus" x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
            @keydown.escape.window="konfirmHapus = false">
            <div class="bg-white rounded-2xl shadow-xl max-w-sm w-full p-6"
                @click.away="konfirmHapus = false"
                x-transition>
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-red-100 rounded-full">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800 text-center mb-2">Hapus Pengguna?</h3>
                <p class="text-sm text-gray-500 text-center mb-6">
                    Yakin ingin menghapus <span class="font-semibold text-gray-700" x-text="hapusNama"></span>? Tindakan ini tidak bisa dibatalkan.
                </p>
                <div class="flex gap-3">
                    <button type="button" @click="konfirmHapus = false"
                        class="flex-1 px-4 py-2.5 text-sm font-semibold text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                        Batal
                    </button>
                    <form :action="hapusAksi" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full px-4 py-2.5 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
