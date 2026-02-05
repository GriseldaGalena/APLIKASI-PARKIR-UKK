<x-layouts.app :title="__('Tambah Kendaraan')">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center py-6 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-blue-600">Tambah Kendaraan</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Tambahkan data kendaraan baru.
            </p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.kendaraan.index') }}" 
               class="flex items-center gap-2 px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium rounded-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="mt-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-8">
        <form action="{{ route('admin.kendaraan.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Plat Nomor --}}
            <div>
                <label for="plat_nomor" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Plat Nomor <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="plat_nomor"
                       id="plat_nomor"
                       value="{{ old('plat_nomor') }}"
                       placeholder="Masukkan Plat Nomor"
                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                @error('plat_nomor')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jenis Kendaraan --}}
            <div>
                <label for="jenis_kendaraan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Jenis Kendaraan <span class="text-red-500">*</span>
                </label>
                <select name="jenis_kendaraan" id="jenis_kendaraan"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <option value="">Pilih Jenis Kendaraan</option>
                    <option value="mobil" {{ old('jenis_kendaraan') == 'mobil' ? 'selected' : '' }}>Mobil</option>
                    <option value="motor" {{ old('jenis_kendaraan') == 'motor' ? 'selected' : '' }}>Motor</option>
                    <option value="lainnya" {{ old('jenis_kendaraan') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('jenis_kendaraan')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Warna --}}
            <div>
                <label for="warna" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Warna <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="warna"
                       id="warna"
                       value="{{ old('warna') }}"
                       placeholder="Masukkan Warna Kendaraan"
                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                @error('warna')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pemilik --}}
            <div>
                <label for="pemilik" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Pemilik <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="pemilik"
                       id="pemilik"
                       value="{{ old('pemilik') }}"
                       placeholder="Masukkan Nama Pemilik"
                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                @error('pemilik')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <input type="hidden" name="id_user" value="{{ Illuminate\Support\Facades\Auth::user()->id }}">

            {{-- Tombol --}}
            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.kendaraan.index') }}"
                   class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition">
                    Batal
                </a>
                <button type="submit"
                        class="flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-md transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Kendaraan
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
