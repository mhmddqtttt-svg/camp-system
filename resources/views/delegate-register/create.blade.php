@if ($errors->any())
<div
    style="background:#fee2e2;color:#991b1b;padding:15px;margin-bottom:15px;border-radius:16px;max-width:600px;margin:auto auto 20px;">
    @foreach ($errors->all() as $error)
    <p style="margin-bottom:6px;">{{ $error }}</p>
    @endforeach
</div>
@endif

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل مندوب جديد</title>

    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Tahoma, Arial, sans-serif;
    }

    body {
        min-height: 100vh;
        background:
            radial-gradient(circle at top right, rgba(25, 135, 84, .18), transparent 30%),
            linear-gradient(135deg, #020617, #064e3b);
        padding: 25px 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .box {
        width: 100%;
        max-width: 620px;
        background: rgba(255, 255, 255, .97);
        padding: 38px;
        border-radius: 34px;
        box-shadow: 0 25px 65px rgba(0, 0, 0, .28);
        border: 1px solid rgba(255, 255, 255, .55);
    }

    .icon {
        width: 95px;
        height: 95px;
        border-radius: 28px;
        margin: 0 auto 22px;
        background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
    }

    h1 {
        text-align: center;
        margin-bottom: 12px;
        color: #064e3b;
        font-size: 36px;
    }

    .desc {
        text-align: center;
        color: #64748b;
        line-height: 2;
        margin-bottom: 30px;
    }

    .field {
        margin-bottom: 18px;
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
        color: #065f46;
    }

    input {
        width: 100%;
        padding: 16px;
        border: 2px solid #d1d5db;
        border-radius: 18px;
        font-size: 16px;
        outline: none;
        transition: .25s;
        background: white;
    }

    input:focus {
        border-color: #198754;
        box-shadow: 0 0 0 4px rgba(25, 135, 84, .12);
    }

    button {
        width: 100%;
        padding: 17px;
        background: linear-gradient(135deg, #16a34a, #198754);
        color: white;
        border: none;
        border-radius: 18px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        transition: .25s;
        margin-top: 8px;
        box-shadow: 0 15px 30px rgba(25, 135, 84, .25);
    }

    button:hover {
        transform: translateY(-3px);
    }

    .back {
        display: block;
        text-align: center;
        margin-top: 18px;
        text-decoration: none;
        color: #475569;
        font-weight: bold;
    }

    @media(max-width:600px) {

        .box {
            padding: 30px 20px;
            border-radius: 26px;
        }

        h1 {
            font-size: 30px;
        }

        input {
            padding: 15px;
        }
    }
    </style>

</head>

<body>

    <div class="box">

        <div class="icon">🧑‍💼</div>

        <h1>تسجيل مندوب جديد</h1>

        <p class="desc">
            قم بتعبئة البيانات التالية لإرسال طلب تسجيل مندوب جديد داخل النظام.
        </p>

        <form method="POST" action="/delegate-register">

            @csrf

            <div class="field">
                <label>اسم المندوب</label>
                <input type="text" name="name" placeholder="أدخل اسم المندوب" required>
            </div>

            <div class="field">
                <label>البريد الإلكتروني</label>
                <input type="email" name="email" placeholder="example@gmail.com" required>
            </div>

            <div class="field">
                <label>رقم الجوال</label>
                <input type="text" name="phone" placeholder="05xxxxxxxx" required>
            </div>

            <div class="field">
                <label>كلمة المرور</label>
                <input type="password" name="password" placeholder="********" required>
            </div>

            <div class="field">
                <label>اسم المخيم</label>
                <input type="text" name="camp_name" placeholder="أدخل اسم المخيم" required>
            </div>

            <button type="submit">
                إرسال طلب المندوب
            </button>

        </form>

        <a href="/delegate" class="back">
            رجوع
        </a>

    </div>

</body>

</html>
