<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm border border-gray-100 sm:rounded-xl p-8">

                <div class="mb-6 border-b border-gray-100 pb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Form Tambah Kategori</h3>
                    <p class="text-sm text-gray-500 mt-1">Masukkan nama kategori baru untuk mengelompokkan barang di tokomu.</p>
                </div>

                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label for="nama_kategori" class="block text-sm font-semibold text-gray-700 mb-2">Nama Kategori <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_kategori" name="nama_kategori"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-colors"
                            placeholder="Contoh: Laptop, Aksesoris, dll..." required autofocus>

                        @error('nama_kategori')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-4 mt-8 pt-4">
                        <a href="{{ route('kategori.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                            Simpan Kategori
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
