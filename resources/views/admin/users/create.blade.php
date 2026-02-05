<x-layouts.app :title="__('Tambah User')">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center py-6 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-blue-600">Tambah User</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Tambahkan user baru ke dalam aplikasi.
            </p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.users.index') }}"
                class="flex items-center gap-2 px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium rounded-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="mt-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-8">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Nama --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Nama <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name"
                    value="{{ old('name') }}" placeholder="Masukkan nama"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                @error('name')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" id="email"
                    value="{{ old('email') }}" placeholder="Masukkan email"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                @error('email')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Password <span class="text-red-500">*</span>
                </label>
                <input type="password" name="password" id="password"
                    placeholder="Masukkan password"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                @error('password')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Role --}}
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Role <span class="text-red-500">*</span>
                </label>
                <select name="role" id="role"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <option value="">Pilih Role</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                    <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                </select>
                @error('role')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.users.index') }}"
                    class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                    Batal
                </a>
                <button type="submit"
                    class="flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-md transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
