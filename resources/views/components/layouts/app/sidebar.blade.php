<?php 
    use Illuminate\Support\Facades\Auth;
    use App\Models\AreaParkir;

    $user = Auth::user();
    $role = $user ? $user->role : null;

    $areaParkir = AreaParkir::all();
?>


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky collapsible="mobile" class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.header class="px-4 py-4">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/90">
    <svg xmlns="http://www.w3.org/2000/svg"
         viewBox="0 0 24 24"
         fill="none"
         stroke="currentColor"
         class="h-6 w-6 text-blue-700"
         stroke-width="2"
         stroke-linecap="round"
         stroke-linejoin="round">
        <path d="M4 7h16v4a2 2 0 0 0 0 4v4H4v-4a2 2 0 0 0 0-4z"/>
        <path d="M10 12h4"/>
    </svg>
</div>

        <div class="leading-tight">
            <div class="text-lg font-bold tracking-wide text-blue-600">
                Si<span class="text-yellow-400">Parkir</span>
            </div>
            <div class="text-xs text-gray-500">
                Parking System
            </div>
        </div>
    </a>

    <flux:sidebar.collapse class="lg:hidden text-white" />
</flux:sidebar.header>


            <flux:sidebar.nav>
                @if($role === 'admin')
                <flux:sidebar.group :heading="__('Platform')" class="grid">
                    <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="users" :href="route('admin.users.index')" :current="request()->routeIs('admin.users.*')" wire:navigate>
                        Users
                    </flux:sidebar.item>
                </flux:sidebar.group>

                <flux:sidebar.group expandable expanded="{{ request()->routeIs('admin.tarif-parkir.*') ? 'true' : 'false' }}" heading="Data Parkir" icon="truck" class="grid">
                    <flux:sidebar.item
                    icon="map-pin"
                    :href="route('admin.area-parkir.index')"
                    :current="request()->routeIs('admin.area-parkir.*')"
                    wire:navigate
                    >
                    {{ __('Area Parkir' ) }}
                </flux:sidebar.item>
                
                <flux:sidebar.item
                    icon="currency-dollar"
                    :href="route('admin.tarif-parkir.index')"
                    :current="request()->routeIs('admin.tarif-parkir.*')"
                    wire:navigate>
                    {{ __('Tarif Parkir' ) }}
                </flux:sidebar.item>

                </flux:sidebar.group>
                <flux:sidebar.item
                    icon="truck"
                    :href="route('admin.kendaraan.index')"
                    :current="request()->routeIs('admin.kendaraan.*')"
                    wire:navigate>
                    {{ __('Kendaraan') }}
                </flux:sidebar.item>

                <flux:sidebar.item 
                    icon="inbox"
                    :href="route('admin.log-aktivitas.index')"
                    :current="request()->routeIs('admin.log-aktivitas.*')"
                    wire:navigate>
                    {{ __('Log Aktivitas') }}
                </flux:sidebar.item>

                @endif

                @if($role === 'petugas')
                <flux:sidebar.group :heading="__('Platform')" class="grid">
                    <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </flux:sidebar.item>
                </flux:sidebar.group>

                <flux:sidebar.group expandable 
                    expanded heading="Area Parkir" 
                    icon="truck" class="grid">

                @forelse ( $areaParkir as $area )
                <flux:sidebar.item
                    icon="map-pin"
                    :href="route('petugas.transaksi.index', ['area' => $area->id])"
                    :current="request()->routeIs('petugas.transaksi.index') && request()->query('area') == $area->id"
                    wire:navigate>
                    {{ $area->nama_area }}
                </flux:sidebar.item>
                @empty
                    <p>Tidak tersedia area parkir.</p>
                @endforelse
                </flux:sidebar.group>
                @endif

                @if($role === 'owner')
                <flux:sidebar.group :heading="__('Platform')" class="grid">
                    <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </flux:sidebar.item>
                </flux:sidebar.group>
                @endif
            </flux:sidebar.nav>

            <flux:spacer />

            

            <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar
                                    :name="auth()->user()->name"
                                    :initials="auth()->user()->initials()"
                                />

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                            {{ __('Settings') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item
                            as="button"
                            type="submit"
                            icon="arrow-right-start-on-rectangle"
                            class="w-full cursor-pointer"
                            data-test="logout-button"
                        >
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
