<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Edit Pengguna</h2>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Form Edit Pengguna</h3>
                </div>

                <form action="{{ route('user.update', $user->id) }}" method="POST" class="px-6 py-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block mb-1.5 text-sm font-semibold text-gray-700">Nama</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-gray-800">
                        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-1.5 text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-gray-800">
                        @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-1.5 text-sm font-semibold text-gray-700">
                            Password <span class="font-normal text-gray-400">(kosongkan jika tidak diubah)</span>
                        </label>
                        <input type="password" name="password"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-gray-800">
                        @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition-colors">
                            Update
                        </button>
                        <a href="{{ route('user.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
