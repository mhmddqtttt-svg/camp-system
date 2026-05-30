<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بوابة المندوب</title>

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
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .box {
        width: 100%;
        max-width: 560px;
        background: rgba(255, 255, 255, .96);
        color: #0f172a;
        padding: 38px;
        border-radius: 32px;
        text-align: center;
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
        font-size: 36px;
        margin-bottom: 12px;
        color: #064e3b;
    }

    p {
        color: #64748b;
        line-height: 2;
        margin-bottom: 28px;
    }

    a {
        display: block;
        margin: 16px 0;
        padding: 16px;
        color: white;
        text-decoration: none;
        border-radius: 18px;
        font-size: 18px;
        font-weight: bold;
        transition: .25s;
    }

    a:hover {
        transform: translateY(-3px);
    }

    .login {
        background: linear-gradient(135deg, #2563eb, #0d6efd);
        box-shadow: 0 14px 28px rgba(37, 99, 235, .3);
    }

    .register {
        background: linear-gradient(135deg, #16a34a, #198754);
        box-shadow: 0 14px 28px rgba(25, 135, 84, .3);
    }

    .back {
        margin-top: 20px;
        background: linear-gradient(135deg, #64748b, #475569);
        font-size: 15px;
    }

    @media(max-width:600px) {
        .box {
            padding: 30px 20px;
            border-radius: 26px;
        }

        h1 {
            font-size: 30px;
        }

        a {
            font-size: 16px;
        }
    }
    </style>

</head>

<body>

    <div class="box">

        <div class="icon">👤</div>

        <h1>بوابة المندوب</h1>

        <p>
            يمكنك الدخول كمندوب مسجل أو تقديم طلب تسجيل مندوب جديد داخل النظام.
        </p>

        <a class="login" href="/go-login">
            مندوب مسجل
        </a>

        <a class="register" href="/delegate-register">
            مندوب جديد
        </a>

        <a class="back" href="/">
            رجوع للرئيسية
        </a>

    </div>

</body>

</html>
