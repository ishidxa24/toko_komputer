<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Alert Pesan Sukses -->
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 shadow-sm flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.style.display='none'" class="text-green-700 font-bold hover:text-green-900">
                        &times;
                    </button>
                </div>
            @endif

            <!-- Kotak Putih Utama -->
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100 sm:rounded-xl">

                <!-- Bagian Atas: Judul & Tombol Tambah -->
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-white">
                    <h3 class="text-lg font-semibold text-gray-800">Data Barang</h3>
                    <a href="{{ route('barang.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                        + Tambah Barang
                    </a>
                </div>

                <!-- Tabel -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-y border-gray-100">
                                <th class="py-3 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">No</th>
                                <th class="py-3 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Barang</th>
                                <th class="py-3 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="py-3 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Stok</th>
                                <th class="py-3 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Satuan</th>
                                <th class="py-3 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($barang as $item)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="py-4 px-6 text-sm text-gray-600">{{ $loop->iteration }}</td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-800">{{ $item->nama_barang }}</td>

                                    <!-- Label Kategori dengan background kecil -->
                                    <td class="py-4 px-6 text-sm text-gray-600">
                                        <span class="px-2.5 py-1 bg-gray-100 text-gray-600 rounded-md text-xs font-semibold border border-gray-200">
                                            {{ $item->kategori->nama_kategori ?? '-' }}
                                        </span>
                                    </td>

                                    <!-- Stok (Bakal berwarna merah kalau 0) -->
                                    <td class="py-4 px-6 text-sm font-bold {{ $item->stock == 0 ? 'text-red-500' : 'text-gray-700' }}">
                                        {{ $item->stock }}
                                    </td>

                                    <td class="py-4 px-6 text-sm text-gray-600">{{ $item->satuan }}</td>
                                    <td class="py-4 px-6 text-sm text-center flex justify-center gap-4">
                                        <a href="{{ route('barang.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                                        <form action="{{ route('barang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-gray-400 text-sm">Belum ada data barang.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
