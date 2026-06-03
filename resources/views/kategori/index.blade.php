<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Kategori Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 shadow-sm flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.style.display='none'" class="text-green-700 font-bold hover:text-green-900">
                        &times;
                    </button>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm border border-gray-100 sm:rounded-xl">

                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-white">
                    <h3 class="text-lg font-semibold text-gray-800">Data Kategori</h3>
                    <a href="{{ route('kategori.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                        + Tambah Kategori
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-y border-gray-100">
                                <th class="py-3 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">No</th>
                                <th class="py-3 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Kategori</th>
                                <th class="py-3 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($kategori as $item)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="py-4 px-6 text-sm text-gray-600">{{ $loop->iteration }}</td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-800">{{ $item->nama_kategori }}</td>
                                    <td class="py-4 px-6 text-sm text-center flex justify-center gap-4">
                                        <a href="{{ route('kategori.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>

                                        <form id="delete-form-kategori-{{ $item->id }}" action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDeleteKategori('{{ $item->id }}')" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-8 text-center text-gray-400 text-sm">Belum ada data kategori.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDeleteKategori(id) {
            Swal.fire({
                title: 'Hapus Kategori?',
                text: "Data kategori ini akan dihapus. Pastikan tidak ada barang yang terkait dengan kategori ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4F46E5',
                cancelButtonColor: '#EF4444',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-xl shadow-sm border border-gray-100',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-kategori-' + id).submit();
                }
            })
        }
    </script>
</x-app-layout>
