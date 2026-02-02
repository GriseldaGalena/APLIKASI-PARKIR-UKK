<x-layouts.auth>
    <div class="flex flex-col gap-6 -mt-10">

        {{-- Branding TANPA LOGO --}}
        <div class="text-center mb-2">
            <h1 class="text-4xl font-extrabold tracking-wide text-blue-600">
                Si<span class="text-yellow-400">Parkir</span>
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Parking System
            </p>
        </div>

        {{-- Header --}}
        <div class="text-center">
            <h2 class="text-xl font-semibold text-gray-800">
                Masuk ke akun Anda
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Silakan login untuk mengakses sistem parkir
            </p>
        </div>

        {{-- Session Status --}}
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
            @csrf

            {{-- Email --}}
            <flux:input
                name="email"
                label="Email"
                :value="old('email')"
                type="email"
                required
                autofocus
                placeholder="email@example.com"
            />

            {{-- Password --}}
            <div class="relative">
                <flux:input
                    name="password"
                    label="Password"
                    type="password"
                    required
                    viewable
                    placeholder="••••••••"
                />

                @if (Route::has('password.request'))
                    <flux:link
                        class="absolute top-0 end-0 text-sm text-blue-600 hover:underline"
                        :href="route('password.request')"
                        wire:navigate
                    >
                        Lupa password?
                    </flux:link>
                @endif
            </div>

            {{-- Remember --}}
            <flux:checkbox name="remember" label="Ingat saya" />

            {{-- Button --}}
            <flux:button
                variant="primary"
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white"
            >
                Masuk
            </flux:button>
        </form>

        {{-- Register --}}
        @if (Route::has('register'))
            <p class="text-center text-sm text-gray-600">
                Belum punya akun?
                <flux:link
                    class="text-blue-600 hover:underline"
                    :href="route('register')"
                    wire:navigate
                >
                    Daftar
                </flux:link>
            </p>
        @endif
    </div>
</x-layouts.auth>
