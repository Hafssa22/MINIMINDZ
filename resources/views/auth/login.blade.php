<x-guest-layout>
    <style>
        body {
            background: linear-gradient(135deg, #0cc0df, #f0f9ff);
            font-family: 'Comic Sans MS', cursive, sans-serif;
        }

        .login-card {
            background-color: white;
            border-radius: 20px;
            padding: 3rem;
            max-width: 480px;
            margin: 5rem auto;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .login-card h2 {
            font-size: 2rem;
            color: #0cc0df;
            font-weight: bold;
            margin-bottom: 2rem;
            text-align: center;
        }

        .btn-login {
            background-color: #0cc0df;
            border: none;
            font-weight: bold;
            padding: 0.6rem 2rem;
            border-radius: 1rem;
            transition: background 0.3s;
        }

        .btn-login:hover {
            background-color: #09a5be;
        }

        .logo {
            width: 80px;
            display: block;
            margin: 0 auto 1.5rem;
        }
    </style>

    <div class="login-card">
        <h2>Welcome to MiniMindz </h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full rounded-lg border-2 border-[#0cc0df]" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full rounded-lg border-2 border-[#0cc0df]" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#0cc0df] shadow-sm focus:ring-[#0cc0df]" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ms-3 btn-login">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
