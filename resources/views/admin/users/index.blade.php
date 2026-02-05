<x-layouts.app :title="__('Data User')">

    {{-- Header --}}
    <div class="mb-6 rounded-2xl bg-gradient-to-r from-blue-500 to-blue-400 p-6 text-white shadow-md">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <flux:heading size="xl" class="text-white">
                    Data User
                </flux:heading>
                <p class="mt-1 text-sm text-blue-100">
                    Kelola data user aplikasi SiParkir.
                </p>
            </div>

            <a href="{{ route('admin.users.create') }}"
               wire:navigate.hover
               class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2 text-sm font-semibold text-blue-600
                      hover:bg-blue-50 transition">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah User
            </a>
        </div>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700
                    dark:border-green-800 dark:bg-green-900/20 dark:text-green-200">
            {{ session('success') }}
        </div>
    @endif

    {{-- Card Table --}}
    <div class="overflow-hidden rounded-2xl border border-neutral-200 bg-white shadow-sm
                dark:border-neutral-700 dark:bg-neutral-800">

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-neutral-50 dark:bg-neutral-900/60">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-neutral-500 w-16">
                            No
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-neutral-500">
                            Nama
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-neutral-500">
                            Email
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-neutral-500">
                            Role
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-neutral-500 w-48">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                @forelse($users as $index => $user)
                    <tr class="hover:bg-blue-50/40 dark:hover:bg-neutral-700/40 transition">
                        <td class="px-6 py-4 text-sm">
                            {{ $users->firstItem() + $index }}
                        </td>

                        <td class="px-6 py-4 font-medium text-neutral-800 dark:text-neutral-100">
                            {{ $user->name }}
                        </td>

                        <td class="px-6 py-4 text-sm text-neutral-600 dark:text-neutral-400">
                            {{ $user->email }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                                @if($user->role === 'admin')
                                    bg-blue-100 text-blue-700
                                @elseif($user->role === 'petugas')
                                    bg-yellow-100 text-yellow-700
                                @else
                                    bg-green-100 text-green-700
                                @endif
                            ">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}"
                                   wire:navigate.hover
                                   class="inline-flex items-center gap-1 rounded-lg px-3 py-1.5 text-sm font-medium
                                          text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900/30 transition">
                                    ✏️ Edit
                                </a>

                                <form action="{{ route('admin.users.destroy', $user) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1 rounded-lg px-3 py-1.5 text-sm font-medium
                                                   text-red-600 hover:bg-red-100 dark:hover:bg-red-900/30 transition">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="rounded-full bg-blue-100 p-4 text-blue-600">
                                    👤
                                </div>
                                <p class="text-sm text-neutral-500">
                                    Belum ada data user.
                                </p>
                                <a href="{{ route('admin.users.create') }}"
                                   class="mt-2 rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">
                                    Tambah User
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($users->hasPages())
            <div class="border-t border-neutral-200 px-6 py-4 dark:border-neutral-700">
                {{ $users->links() }}
            </div>
        @endif
    </div>

</x-layouts.app>
