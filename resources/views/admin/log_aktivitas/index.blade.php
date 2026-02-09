<x-layouts.app :title="__('Log Aktivitas')">

    {{-- Header --}}
    <div class="mb-6 rounded-2xl bg-gradient-to-r from-blue-500 to-blue-400 p-6 text-white shadow-md">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <flux:heading size="xl" class="text-white">
                Log Aktivitas
            </flux:heading>
            <p class="mt-1 text-sm text-blue-100">
                Riwayat aktivitas pengguna dalam sistem.
            </p>
        </div>
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
                        <th class="px-6 py-3 w-16 text-center text-xs font-medium text-neutral-500 uppercase">
                            No
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-neutral-500 uppercase">
                            User
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-neutral-500 uppercase">
                            Aktivitas
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-neutral-500 uppercase">
                            Waktu
                        </th>
                        <th class="px-6 py-3 w-32 text-center text-xs font-medium text-neutral-500 uppercase">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse($data as $index => $log)
                        <tr class="hover:bg-blue-50/40 dark:hover:bg-neutral-800/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-neutral-900 dark:text-neutral-100">
                                {{ $data->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium">
                                {{ $log->user->name }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                {{ $log->aktivitas }}
                            </td>
                            <td class="px-6 py-4 text-sm text-neutral-600 dark:text-neutral-400">
                                {{ $log->waktu_aktivitas }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <form action="{{ route('admin.log-aktivitas.destroy', $log) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus log ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="inline-flex items-center gap-1 px-3 py-1.5
                                               text-red-600 hover:text-red-700
                                               hover:bg-red-50 rounded-md transition-colors">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-14 h-14 text-neutral-400"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <p class="text-sm text-neutral-500">
                                        Belum ada data log aktivitas.
                                    </p>
                                </div>
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
