<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Edit Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <!-- Kotak Form Putih Bersih -->
            <div class="bg-white overflow-hidden shadow-sm border border-gray-100 sm:rounded-xl p-8">

                <div class="mb-6 border-b border-gray-100 pb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Form Edit Barang</h3>
                    <p class="text-sm text-gray-500 mt-1">Perbarui informasi barang yang sudah tersimpan di sistem.</p>
                </div>

                <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Input Nama Barang -->
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Barang <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-colors" required>
                        @error('nama_barang') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                    </div>

                    <!-- Dropdown Kategori -->
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                        <select name="kategori_id" class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-colors bg-white" required>
                            <option value="" disabled>-- Pilih Kategori --</option>
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}" {{ old('kategori_id', $barang->kategori_id) == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                    </div>

                    <!-- Grid untuk Stok dan Satuan -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Stok <span class="text-red-500">*</span></label>
                            <input type="number" name="stock" min="0" value="{{ old('stock', $barang->stock) }}" class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-colors" required>
                            @error('stock') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Satuan</label>
                            <input type="text" name="satuan" value="{{ old('satuan', $barang->satuan) }}" class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-colors">
                            @error('satuan') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-end gap-4 mt-8 pt-4 border-t border-gray-50">
                        <a href="{{ route('barang.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
                            Batal
                        </a>
                        <!-- Tombol Update menggunakan warna kuning/oranye khas untuk fungsi Edit -->
                        <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-yellow-500 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                            Update Barang
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
