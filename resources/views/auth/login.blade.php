<x-guest-layout>

    <div class="text-center mb-8">

        <x-application-logo class="mx-auto w-40 h-40" />

        <h1 class="mt-5 text-4xl font-extrabold text-slate-800">

            Admin Panel

        </h1>

        <p class="mt-2 text-blue-600 font-semibold">

            Royal Clean Shoes

        </p>

        <p class="mt-2 text-gray-500 text-sm">

            Silakan login untuk mengelola website

        </p>

        <div class="w-16 h-1 bg-blue-600 rounded-full mx-auto mt-5 mb-8"></div>
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />

            <x-text-input id="email"
                class="block mt-1 w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">

            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password"
                class="block mt-1 w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                type="password" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />

        </div>

        <!-- Remember Me + Forgot Password -->
        <div class="flex items-center justify-between mt-5">

            <label for="remember_me" class="inline-flex items-center cursor-pointer">

                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">

                <span class="ml-2 text-sm text-gray-600">

                    Remember me

                </span>

            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800">

                    Lupa Password?

                </a>
            @endif

        </div>

        <!-- Tombol Login -->
        <div class="mt-6">

            <x-primary-button class="w-full justify-center rounded-xl bg-blue-600 hover:bg-blue-700 py-3">

                Login

            </x-primary-button>

        </div>
    </form>
</x-guest-layout>
<div class="mt-8 text-center text-sm text-gray-500">

    © {{ date('Y') }} Royal Clean Shoes

</div>
