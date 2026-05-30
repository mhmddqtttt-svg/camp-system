<x-guest-layout>
    <style>
    body {
        min-height: 100vh;
        background:
            radial-gradient(circle at top right, rgba(34, 197, 94, .22), transparent 28%),
            radial-gradient(circle at bottom left, rgba(59, 130, 246, .18), transparent 32%),
            linear-gradient(135deg, #f8fafc, #ecfdf5) !important;
    }

    .auth-card {
        width: 100%;
        max-width: 460px;
        background: #ffffff;
        padding: 36px 30px;
        border-radius: 30px;
        box-shadow: 0 22px 55px rgba(15, 23, 42, .12);
        border: 1px solid #e5e7eb;
        position: relative;
        overflow: hidden;
    }

    .auth-card::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        height: 7px;
        background: linear-gradient(135deg, #16a34a, #22c55e);
    }

    .auth-icon {
        width: 82px;
        height: 82px;
        margin: 0 auto 18px;
        border-radius: 24px;
        background: linear-gradient(135deg, #16a34a, #198754);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 42px;
        box-shadow: 0 14px 30px rgba(22, 163, 74, .25);
    }

    .auth-title {
        text-align: center;
        color: #064e3b;
        font-size: 30px;
        font-weight: 900;
        margin-bottom: 8px;
    }

    .auth-subtitle {
        text-align: center;
        color: #64748b;
        font-size: 14px;
        line-height: 1.9;
        margin-bottom: 26px;
    }

    .auth-card label {
        color: #334155;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .auth-card input[type="email"],
    .auth-card input[type="password"] {
        border-radius: 16px !important;
        border: 1px solid #d1d5db !important;
        padding: 13px 15px !important;
        background: #f8fafc !important;
    }

    .auth-card input:focus {
        border-color: #22c55e !important;
        box-shadow: 0 0 0 3px rgba(34, 197, 94, .18) !important;
    }

    .remember-row {
        margin-top: 18px;
    }

    .actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 26px;
    }

    .auth-link {
        color: #64748b;
        font-size: 14px;
        text-decoration: none;
    }

    .auth-link:hover {
        color: #16a34a;
        text-decoration: underline;
    }

    .auth-btn {
        background: linear-gradient(135deg, #16a34a, #198754) !important;
        border-radius: 16px !important;
        padding: 13px 30px !important;
        font-weight: 800 !important;
        box-shadow: 0 12px 24px rgba(22, 163, 74, .25);
    }

    .back-home {
        display: block;
        margin-top: 22px;
        text-align: center;
        color: #64748b;
        text-decoration: none;
        font-size: 14px;
    }

    .back-home:hover {
        color: #16a34a;
    }

    @media(max-width: 520px) {
        .auth-card {
            padding: 30px 22px;
            border-radius: 24px;
        }

        .auth-title {
            font-size: 26px;
        }

        .actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .auth-btn {
            width: 100%;
            justify-content: center;
        }

        .auth-link {
            text-align: center;
        }
    }
    </style>

    <div class="auth-card">

        <div class="auth-icon">👨‍👩‍👧‍👦</div>

        <h1 class="auth-title">دخول عائلة مسجلة</h1>

        <div class="auth-subtitle">
            أدخل البريد الإلكتروني وكلمة المرور للوصول إلى حساب العائلة ومتابعة بيانات المخيم.
        </div>

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

            <div class="remember-row">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">تذكرني</span>
                </label>
            </div>

            <div class="actions">
                @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">
                    نسيت كلمة المرور؟
                </a>
                @endif

                <x-primary-button class="auth-btn">
                    دخول
                </x-primary-button>
            </div>
        </form>

        <a href="/" class="back-home">الرجوع إلى بوابة العائلات</a>

    </div>
</x-guest-layout>