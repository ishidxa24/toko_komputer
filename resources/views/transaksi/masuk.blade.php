<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Barang Masuk</h2>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 space-y-6">
        @if (session('success'))<div class="p-3 bg-green-100 text-green-800 rounded-lg">{{ session('success') }}</div>@endif
        @if (session('error'))<div class="p-3 bg-red-100 text-red-800 rounded-lg">{{ session('error') }}</div>@endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 max-w-2xl">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Catat Barang Masuk</h3>
            <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="jenis" value="masuk">
                <div>
                    <label class="block mb-1.5 text-sm font-semibold text-gray-700">Barang</label>
                    <select name="barang_id" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">-- Pilih Barang --</option>
                        @foreach ($barang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_barang }} (stok: {{ $b->stock }})</option>
                        @endforeach
                    </select>
                    @error('barang_id')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block mb-1.5 text-sm font-semibold text-gray-700">Jumlah</label>
                    <input type="number" name="jumlah" min="1" value="{{ old('jumlah') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('jumlah')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block mb-1.5 text-sm font-semibold text-gray-700">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('tanggal')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700">Simpan</button>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100"><h3 class="text-lg font-bold text-gray-800">Riwayat Barang Masuk</h3></div>
            <table class="w-full text-left">
                <thead><tr class="text-xs font-bold text-gray-400 uppercase border-b border-gray-100">
                    <th class="px-6 py-4">No</th><th class="px-6 py-4">Tanggal</th><th class="px-6 py-4">Barang</th><th class="px-6 py-4">Jumlah</th>
                </tr></thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($transaksi as $t)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $t->tanggal }}</td>
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $t->barang->nama_barang ?? '-' }}</td>
                            <td class="px-6 py-4 text-green-600 font-semibold">+{{ $t->jumlah }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-6 py-8 text-center text-gray-400">Belum ada barang masuk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
