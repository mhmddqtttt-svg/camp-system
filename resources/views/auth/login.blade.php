<x-guest-layout>
    <style>
    body {
        background:
            radial-gradient(circle at top right, rgba(25, 135, 84, .18), transparent 30%),
            linear-gradient(135deg, #020617, #064e3b) !important;
    }

    .auth-card {
        background: rgba(255, 255, 255, .97);
        padding: 35px;
        border-radius: 32px;
        box-shadow: 0 25px 65px rgba(0, 0, 0, .28);
    }

    .auth-title {
        text-align: center;
        color: #064e3b;
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 25px;
    }

    .auth-btn {
        background: linear-gradient(135deg, #16a34a, #198754) !important;
        border-radius: 14px !important;
        padding: 12px 24px !important;
    }
    </style>

    <div class="auth-card">

        <h1 class="auth-title">تسجيل الدخول</h1>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-input-label for="email" value="البريد الإلكتروني" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" value="كلمة المرور" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">تذكرني</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-6">

                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    نسيت كلمة المرور؟
                </a>
                @endif

                <x-primary-button class="ms-3 auth-btn">
                    دخول
                </x-primary-button>

            </div>
        </form>

    </div>
</x-guest-layout>
