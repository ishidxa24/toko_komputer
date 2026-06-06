<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight print:hidden">
            {{ __('Laporan Persediaan Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="bg-white overflow-hidden shadow-sm border border-gray-100 sm:rounded-xl p-8">

                <div class="hidden print:block text-center mb-8 border-b-2 border-gray-800 pb-4">
                    <h1 class="text-2xl font-bold uppercase tracking-wider">Toko Komputer</h1>
                    <p class="text-gray-600">Laporan Persediaan Stok Barang</p>
                    <p class="text-sm text-gray-500 mt-1">Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y - H:i') }}</p>
                </div>

                <div class="flex justify-between items-center mb-6 print:hidden border-b border-gray-100 pb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Data Stok Terkini</h3>
                        <p class="text-sm text-gray-500 mt-1">Rekapitulasi seluruh barang yang ada di sistem.</p>
                    </div>

                    <a href="{{ route('laporan.cetak', ['dari' => request('dari'), 'sampai' => request('sampai')]) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 shadow-sm transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Cetak Laporan
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 border-b border-gray-200">
                                <th class="py-3 px-4 text-sm font-bold text-gray-700 uppercase border-r border-gray-200">No</th>
                                <th class="py-3 px-4 text-sm font-bold text-gray-700 uppercase border-r border-gray-200">Kategori</th>
                                <th class="py-3 px-4 text-sm font-bold text-gray-700 uppercase border-r border-gray-200">Nama Barang</th>
                                <th class="py-3 px-4 text-sm font-bold text-gray-700 uppercase text-center border-r border-gray-200">Stok</th>
                                <th class="py-3 px-4 text-sm font-bold text-gray-700 uppercase text-center">Satuan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($barang as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4 text-sm text-gray-800 border-r border-gray-200">{{ $loop->iteration }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-800 border-r border-gray-200">{{ $item->kategori->nama_kategori ?? '-' }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-800 font-medium border-r border-gray-200">{{ $item->nama_barang }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-800 text-center font-bold border-r border-gray-200">{{ $item->stock }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-800 text-center">{{ $item->satuan }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-gray-500 text-sm">Tidak ada data stok barang.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="bg-white overflow-hidden shadow-sm border border-gray-100 sm:rounded-xl p-8">

                <div class="mb-6 border-b border-gray-100 pb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Riwayat Keluar Masuk Barang</h3>

                    <form method="GET" action="{{ route('laporan.index') }}" class="flex flex-wrap items-end gap-3">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Dari Tanggal</label>
                            <input type="date" name="dari" value="{{ request('dari') }}" class="rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Sampai Tanggal</label>
                            <input type="date" name="sampai" value="{{ request('sampai') }}" class="rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        </div>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700">Filter</button>
                        <a href="{{ route('laporan.index') }}" class="px-4 py-2 text-gray-600 text-sm font-semibold rounded-lg hover:bg-gray-100">Reset</a>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 border-b border-gray-200">
                                <th class="py-3 px-4 text-sm font-bold text-gray-700 uppercase border-r border-gray-200">No</th>
                                <th class="py-3 px-4 text-sm font-bold text-gray-700 uppercase border-r border-gray-200">Tanggal</th>
                                <th class="py-3 px-4 text-sm font-bold text-gray-700 uppercase border-r border-gray-200">Nama Barang</th>
                                <th class="py-3 px-4 text-sm font-bold text-gray-700 uppercase text-center border-r border-gray-200">Jenis</th>
                                <th class="py-3 px-4 text-sm font-bold text-gray-700 uppercase text-center">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($transaksi as $t)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4 text-sm text-gray-800 border-r border-gray-200">{{ $loop->iteration }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-800 border-r border-gray-200">{{ \Carbon\Carbon::parse($t->tanggal)->format('d-m-Y') }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-800 font-medium border-r border-gray-200">{{ $t->barang->nama_barang ?? '-' }}</td>
                                    <td class="py-3 px-4 text-sm text-center border-r border-gray-200">
                                        @if ($t->jenis == 'masuk')
                                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-semibold">Masuk</span>
                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs font-semibold">Keluar</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-sm text-gray-800 text-center font-bold">{{ $t->jumlah }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-gray-500 text-sm">Tidak ada riwayat transaksi pada periode ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
