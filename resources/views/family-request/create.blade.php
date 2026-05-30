<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلب انضمام عائلة</title>

    <style>
    * {
        box-sizing: border-box;
        font-family: Tahoma, Arial, sans-serif;
    }

    body {
        margin: 0;
        min-height: 100vh;
        background:
            radial-gradient(circle at top right, rgba(25, 135, 84, .14), transparent 30%),
            linear-gradient(135deg, #f8fafc, #eef7f1);
        color: #0f172a;
        padding: 30px 15px;
    }

    .container {
        max-width: 620px;
        margin: auto;
        background: white;
        padding: 30px;
        border-radius: 28px;
        box-shadow: 0 18px 45px rgba(15, 23, 42, .08);
        border: 1px solid #e5e7eb;
        position: relative;
        overflow: hidden;
    }

    .container::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        height: 7px;
        background: linear-gradient(135deg, #198754, #22c55e);
    }

    h2 {
        margin: 10px 0 22px;
        color: #065f46;
        font-size: 30px;
        text-align: center;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 8px;
        color: #065f46;
        font-size: 15px;
    }

    input,
    select {
        width: 100%;
        padding: 14px 15px;
        margin-bottom: 18px;
        border: 2px solid #d1d5db;
        border-radius: 16px;
        outline: none;
        font-size: 15px;
        background: #fff;
        transition: .25s;
    }

    input:focus,
    select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 4px rgba(25, 135, 84, .12);
    }

    button {
        background: linear-gradient(135deg, #16a34a, #198754);
        color: white;
        border: none;
        padding: 15px 22px;
        cursor: pointer;
        width: 100%;
        border-radius: 16px;
        font-size: 17px;
        font-weight: bold;
        box-shadow: 0 10px 25px rgba(25, 135, 84, .22);
        transition: .25s;
    }

    button:hover {
        transform: translateY(-2px);
    }

    .success,
    .error,
    .payment-box {
        padding: 15px 18px;
        margin-bottom: 20px;
        border-radius: 18px;
        line-height: 2;
        font-weight: bold;
    }

    .success {
        background: #d1e7dd;
        color: #0f5132;
        border: 1px solid #badbcc;
    }

    .error {
        background: #f8d7da;
        color: #842029;
        border: 1px solid #f5c2c7;
    }

    .payment-box {
        background: #fff3cd;
        color: #664d03;
        border: 1px solid #ffec99;
        font-size: 14px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0;
    }

    .file-hint {
        font-size: 13px;
        color: #64748b;
        margin-top: -10px;
        margin-bottom: 16px;
        line-height: 1.8;
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 18px;
        color: #198754;
        font-weight: bold;
        text-decoration: none;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    @media(max-width:700px) {
        body {
            padding: 18px 12px;
        }

        .container {
            padding: 22px;
            border-radius: 24px;
        }

        h2 {
            font-size: 26px;
        }
    }
    </style>
</head>

<body>

    <div class="container">

        <h2>طلب انضمام عائلة</h2>

        @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
            @endforeach
        </div>
        @endif

        <div class="payment-box">
            <strong>رسوم التسجيل: 5 شيكل</strong>
            <br>
            الرجاء دفع رسوم التسجيل ثم رفع صورة إشعار الدفع.
            <br>
            بعد مراجعة الإدارة للدفع، سيتم تحويل طلبك للمندوب.
        </div>

        <form action="{{ route('family-request.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="form-grid">

                <label>الاسم الكامل</label>
                <input type="text" name="full_name" value="{{ old('full_name') }}" required>

                <label>رقم الهوية</label>
                <input type="text" name="identity_number" maxlength="9" minlength="9" pattern="[0-9]{9}"
                    inputmode="numeric" value="{{ old('identity_number') }}" placeholder="9 أرقام" required>

                <label>كلمة المرور</label>
                <input type="password" name="password" required>

                <label>رقم الجوال</label>
                <input type="text" name="phone" maxlength="10" minlength="10" pattern="05[0-9]{8}" inputmode="numeric"
                    value="{{ old('phone', '05') }}" placeholder="05xxxxxxxx" required>

                <label>البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email') }}" required>

                <label>اختر المخيم</label>
                <select name="camp_id" required>
                    <option value="">اختر المخيم</option>

                    @foreach($camps as $camp)
                    <option value="{{ $camp->id }}" {{ old('camp_id') == $camp->id ? 'selected' : '' }}>
                        {{ $camp->name }}
                        -
                        {{ $camp->users->first()?->name ?? 'بدون مندوب' }}
                    </option>
                    @endforeach
                </select>

                <label>إشعار الدفع</label>
                <input type="file" name="payment_image" accept="image/png,image/jpeg,image/jpg" required>

                <div class="file-hint">
                    الصيغ المسموحة: JPG أو PNG أو JPEG.
                </div>

                <button type="submit">
                    إرسال الطلب
                </button>

            </div>

        </form>

        <a href="/" class="back-link">
            العودة للواجهة العامة
        </a>

    </div>

    <script>
    function numbersOnlyMax(input, maxLength) {
        input.value = input.value.replace(/\D/g, '').slice(0, maxLength);
    }

    function forcePrefix05(input) {
        let value = input.value.replace(/\D/g, '');

        if (!value.startsWith('05')) {
            value = '05' + value.replace(/^0+/, '').replace(/^5/, '');
        }

        input.value = value.slice(0, 10);
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('input[name="identity_number"]').addEventListener('input', function() {
            numbersOnlyMax(this, 9);
        });

        document.querySelector('input[name="phone"]').addEventListener('input', function() {
            forcePrefix05(this);
        });
    });
    </script>

</body>

</html>
