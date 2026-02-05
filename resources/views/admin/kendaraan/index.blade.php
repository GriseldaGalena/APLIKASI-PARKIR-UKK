<x-layouts.app :title="__('Kendaraan')">

<!-- {{-- Header --}}
    <div class="mb-6 rounded-2xl bg-gradient-to-r from-blue-500 to-blue-400 p-6 text-white shadow-md">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <flux:heading size="xl" class="text-white">
                    Area Parkir
                </flux:heading>
                <p class="mt-1 text-sm text-blue-100">
                    Kelola area parkir untuk berbagai jenis kendaraan.
                </p>
            </div>

            <a href="{{ route('admin.area-parkir.create') }}"
               class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2 text-sm font-semibold text-blue-600
                      hover:bg-blue-50 transition">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Area
            </a>
        </div>
    </div> -->


    {{-- Header --}}
    <div class="mb-6 rounded-2xl bg-gradient-to-r from-blue-500 to-blue-400 p-6 text-white shadow-md">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <flux:heading size="xl" class="text-white">
                Kendaraan
            </flux:heading>
            <p class="mt-1 text-sm text-blue-100">
                Kelola data kendaraan.
            </p>
        </div>

        <a href="{{ route('admin.kendaraan.create') }}"
           wire:navigate.hover
           class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2 text-sm font-semibold text-blue-600
                      hover:bg-blue-50 transition">
                      <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            Tambah Kendaraan
        </a>
    </div>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/20
                    border border-green-200 dark:border-green-800 rounded-xl">
            <p class="text-sm text-green-800 dark:text-green-200">
                {{ session('success') }}
            </p>
        </div>
    @endif

    {{-- Table Card --}}
    <div class="mt-4 bg-white dark:bg-neutral-800 rounded-2xl
                shadow-sm border border-neutral-200 dark:border-neutral-700">

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-neutral-50 dark:bg-neutral-900/40
                              border-b border-neutral-200 dark:border-neutral-700">
                    <tr>
                        <th class="px-6 py-3 w-16 text-left text-xs font-medium text-neutral-500 uppercase">
                            No
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">
                            Plat Nomor
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">
                            Jenis
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">
                            Warna
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase">
                            Pemilik
                        </th>
                        <th class="px-6 py-3 w-48 text-left text-xs font-medium text-neutral-500 uppercase">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse($data as $index => $kendaraan)
                        <tr class="hover:bg-blue-50/40 dark:hover:bg-neutral-800/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-neutral-900 dark:text-neutral-100">
                                {{ $data->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium">
                                {{ $kendaraan->plat_nomor }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                {{ $kendaraan->jenis_kendaraan }}
                            </td>
                            <td class="px-6 py-4 text-sm text-neutral-600 dark:text-neutral-400">
                                {{ $kendaraan->warna }}
                            </td>
                            <td class="px-6 py-4 text-sm text-neutral-600 dark:text-neutral-400">
                                {{ $kendaraan->pemilik }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.kendaraan.edit', $kendaraan) }}"
                                       wire:navigate.hover
                                       class="inline-flex items-center gap-1 px-3 py-1.5
                                              text-blue-600 hover:text-blue-700
                                              hover:bg-blue-50 rounded-md transition-colors">
                                        ✏️ Edit
                                    </a>

                                    <form action="{{ route('admin.kendaraan.destroy', $kendaraan) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="inline-flex items-center gap-1 px-3 py-1.5
                                                   text-red-600 hover:text-red-700
                                                   hover:bg-red-50 rounded-md transition-colors">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-14 text-center">
                                <p class="text-sm text-neutral-500">
                                    Belum ada data kendaraan.
                                </p>
                                <a href="{{ route('admin.kendaraan.create') }}"
                                   class="mt-4 inline-flex items-center gap-2 px-4 py-2
                                          bg-blue-500 hover:bg-blue-600
                                          text-white text-sm font-medium rounded-lg transition-colors">
                                    Tambah Kendaraan
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($data->hasPages())
            <div class="px-6 py-4 border-t border-neutral-200 dark:border-neutral-700">
                {{ $data->links() }}
            </div>
        @endif
    </div>
</x-layouts.app>
