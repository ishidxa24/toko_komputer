<aside class="w-64 bg-white flex flex-col h-screen sticky top-0 border-r border-gray-200 shadow-sm z-20">
    <!-- Logo -->
    <div class="h-16 flex items-center justify-center border-b border-gray-100">
        <h1 class="text-xl font-extrabold text-indigo-600 uppercase tracking-wider">Toko Komputer</h1>
    </div>

    <!-- Navigasi -->
    <nav class="flex-1 px-4 py-6 space-y-8 overflow-y-auto">

        <!-- Dashboard -->
        <div>
            <!-- Contoh menu aktif (warna latar indigo muda, teks indigo tua) -->
            <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 text-sm font-semibold text-indigo-700 bg-indigo-50 rounded-lg transition-colors">
                Dashboard
            </a>
        </div>

        <!-- Master Data -->
        <div>
            <h2 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3 px-4">Master Data</h2>
            <div class="space-y-1">
                <a href="{{ route('kategori.index') }}" class="block px-4 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 hover:text-indigo-600 transition-colors">Kategori Barang</a>
                <a href="{{ route('barang.index') }}" class="block px-4 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 hover:text-indigo-600 transition-colors">Daftar Barang</a>
                <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 hover:text-indigo-600 transition-colors">Manajemen Pengguna</a>
            </div>
        </div>

        <!-- Persediaan -->
        <div>
            <h2 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3 px-4">Persediaan Barang</h2>
            <div class="space-y-1">
                <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 hover:text-indigo-600 transition-colors">Barang Masuk</a>
                <a href="#" class="block px-4 py-2 text-sm font-medium text-gray-600 rounded-lg hover:bg-gray-50 hover:text-indigo-600 transition-colors">Barang Keluar</a>
            </div>
        </div>

        <!-- Laporan -->
        <div>
            <a href="{{ route('laporan.index') }}" class="block px-4 py-2.5 text-sm font-semibold text-gray-600 rounded-lg hover:bg-gray-50 hover:text-indigo-600 transition-colors">
                Laporan
            </a>
        </div>
    </nav>

    <!-- Footer Sidebar -->
    <div class="p-4 border-t border-gray-100 bg-gray-50/50">
        <div class="mb-4 px-4 text-sm text-gray-500">
            Admin: <br>
            <span class="font-bold text-gray-800">{{ Auth::user()->name }}</span>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-sm font-semibold text-red-600 bg-white border border-red-100 rounded-lg hover:bg-red-50 hover:border-red-200 transition-colors">
                Logout
            </button>
        </form>
    </div>
</aside>
