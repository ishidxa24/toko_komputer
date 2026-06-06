<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-indigo-600 rounded-xl shadow-sm mb-8 overflow-hidden">
                <div class="px-8 py-10 text-white flex flex-col md:flex-row justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-bold mb-2"></h3>
                        <p class="text-indigo-100 text-sm">Ini adalah ringkasan sistem informasi persediaan barang toko komputermu hari ini.</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <p class="text-sm font-medium text-indigo-200">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
                    </div>
                </div>
            </div>

            @php
                $totalMasuk = \App\Models\Transaksi::where('jenis', 'masuk')->sum('jumlah');
                $totalKeluar = \App\Models\Transaksi::where('jenis', 'keluar')->sum('jumlah');
                $stokTerendah = \App\Models\Barang::orderBy('stock', 'asc')->first();
                $stokTertinggi = \App\Models\Barang::orderBy('stock', 'desc')->first();
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-14 h-14 bg-blue-50 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-500">Total Kategori</p>
                        <h4 class="text-2xl font-bold text-gray-800">{{ \App\Models\Kategori::count() }}</h4>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-14 h-14 bg-green-50 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-500">Jenis Barang</p>
                        <h4 class="text-2xl font-bold text-gray-800">{{ \App\Models\Barang::count() }}</h4>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-14 h-14 bg-yellow-50 rounded-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-500">Total Stok Fisik</p>
                        <h4 class="text-2xl font-bold text-gray-800">{{ \App\Models\Barang::sum('stock') }}</h4>
                    </div>
                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <p class="text-sm font-semibold text-gray-500 mb-1">Total Stok Masuk</p>
                    <h4 class="text-2xl font-bold text-green-600">{{ $totalMasuk }}</h4>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <p class="text-sm font-semibold text-gray-500 mb-1">Total Stok Keluar</p>
                    <h4 class="text-2xl font-bold text-red-600">{{ $totalKeluar }}</h4>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <p class="text-sm font-semibold text-gray-500 mb-1">Stok Terendah</p>
                    <h4 class="text-lg font-bold text-gray-800">{{ $stokTerendah->nama_barang ?? '-' }}</h4>
                    <p class="text-sm text-gray-500">Stok: {{ $stokTerendah->stock ?? 0 }}</p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <p class="text-sm font-semibold text-gray-500 mb-1">Stok Tertinggi</p>
                    <h4 class="text-lg font-bold text-gray-800">{{ $stokTertinggi->nama_barang ?? '-' }}</h4>
                    <p class="text-sm text-gray-500">Stok: {{ $stokTertinggi->stock ?? 0 }}</p>
                </div>

            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Akses Cepat</h3>
                <div class="flex gap-4">
                    <a href="{{ route('barang.create') }}" class="px-5 py-2.5 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 font-semibold text-sm rounded-lg transition-colors">
                        + Tambah Barang Baru
                    </a>
                    <a href="{{ route('laporan.index') }}" class="px-5 py-2.5 bg-gray-50 text-gray-700 hover:bg-gray-100 font-semibold text-sm rounded-lg transition-colors border border-gray-200">
                        Cetak Laporan
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
