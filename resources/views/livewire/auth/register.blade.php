<x-layouts.auth>
    <div class="flex flex-col gap-6 -mt-12">

        {{-- Branding --}}
        <div class="text-center mb-0">
            <h1 class="text-3xl font-bold text-blue-600">
                Si<span class="text-yellow-400">Parkir</span>
            </h1>
            <p class="text-sm text-zinc-500">
                Parking System
            </p>
        </div>

        {{-- Header --}}
        <x-auth-header
            :title="__('Buat akun baru')"
            :description="__('Silakan daftar untuk mengakses sistem parkir')"
        />

        {{-- Session Status --}}
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-4">
            @csrf

            {{-- Nama --}}
            <flux:input
                name="name"
                label="Nama"
                :value="old('name')"
                type="text"
                required
                autofocus
                autocomplete="name"
                placeholder="Nama lengkap"
            />

            {{-- Email --}}
            <flux:input
                name="email"
                label="Email"
                :value="old('email')"
                type="email"
                required
                autocomplete="email"
                placeholder="email@example.com"
            />

            {{-- Password --}}
            <flux:input
                name="password"
                label="Password"
                type="password"
                required
                autocomplete="new-password"
                placeholder="Password"
                viewable
            />

            {{-- Konfirmasi Password --}}
            <flux:input
                name="password_confirmation"
                label="Konfirmasi password"
                type="password"
                required
                autocomplete="new-password"
                placeholder="Konfirmasi password"
                viewable
            />

            {{-- Button --}}
            <flux:button
                type="submit"
                variant="primary"
                class="w-full bg-blue-600 hover:bg-blue-700"
            >
                Buat Akun
            </flux:button>
        </form>

        {{-- Footer --}}
        <p class="text-center text-sm text-zinc-600">
            Sudah punya akun?
            <flux:link
                class="text-blue-600 hover:underline"
                :href="route('login')"
                wire:navigate
            >
                Masuk
            </flux:link>
        </p>

    </div>
</x-layouts.auth>
