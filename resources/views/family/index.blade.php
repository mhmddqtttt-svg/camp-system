<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بوابة العائلات</title>

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
            radial-gradient(circle at top right, rgba(59, 130, 246, .25), transparent 30%),
            linear-gradient(135deg, #020617, #071739, #0d47a1);

        display: flex;
        justify-content: center;
        align-items: flex-start;

        padding: 30px 20px;

        overflow-x: hidden;
        overflow-y: auto;

        color: white;
    }

    body::before {
        content: "";
        position: fixed;
        inset: 0;

        background-image:
            linear-gradient(rgba(255, 255, 255, .04) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, .04) 1px, transparent 1px);

        background-size: 45px 45px;

        pointer-events: none;
    }

    .box {
        width: 100%;
        max-width: 560px;
        position: relative;
        z-index: 2;
    }

    .card {
        background: rgba(255, 255, 255, .1);
        border: 1px solid rgba(255, 255, 255, .15);

        backdrop-filter: blur(16px);

        border-radius: 35px;

        padding: 45px 35px;

        text-align: center;

        box-shadow: 0 25px 60px rgba(0, 0, 0, .35);
    }

    .icon {
        width: 110px;
        height: 110px;

        margin: auto;
        margin-bottom: 22px;

        border-radius: 30px;

        background: linear-gradient(135deg, #2563eb, #38bdf8);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 58px;

        box-shadow: 0 20px 45px rgba(56, 189, 248, .35);
    }

    h1 {
        font-size: 42px;
        margin-bottom: 12px;
        font-weight: 900;
    }

    .desc {
        color: #dbeafe;
        line-height: 2;
        margin-bottom: 35px;
        font-size: 16px;
    }

    .buttons {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .btn {
        border: none;
        border-radius: 18px;

        padding: 18px;

        color: white;

        font-size: 18px;
        font-weight: bold;

        cursor: pointer;

        transition: .25s;

        text-decoration: none;

        display: block;
    }

    .btn:hover {
        transform: translateY(-3px);
    }

    .login {
        background: linear-gradient(135deg, #2563eb, #0d6efd);

        box-shadow: 0 15px 30px rgba(37, 99, 235, .35);
    }

    .register {
        background: linear-gradient(135deg, #f97316, #fb923c);

        box-shadow: 0 15px 30px rgba(249, 115, 22, .35);
    }

    .features {
        margin-top: 28px;

        display: grid;
        grid-template-columns: repeat(3, 1fr);

        gap: 15px;
    }

    .feature {
        background: rgba(255, 255, 255, .08);

        border: 1px solid rgba(255, 255, 255, .12);

        border-radius: 20px;

        padding: 18px 10px;

        backdrop-filter: blur(10px);

        text-align: center;
    }

    .feature-icon {
        font-size: 28px;
        margin-bottom: 8px;
    }

    .feature h3 {
        font-size: 16px;
        margin-bottom: 5px;
    }

    .feature p {
        font-size: 12px;
        color: #dbeafe;
        line-height: 1.7;
    }

    .footer {
        margin-top: 25px;
        text-align: center;
        color: #cbd5e1;
        font-size: 14px;
    }

    @media(max-width:600px) {

        body {
            padding: 20px 15px;
        }

        .card {
            padding: 35px 22px;
            border-radius: 28px;
        }

        h1 {
            font-size: 32px;
        }

        .desc {
            font-size: 14px;
        }

        .btn {
            font-size: 16px;
            padding: 16px;
        }

        .features {
            grid-template-columns: 1fr;
        }

        .icon {
            width: 90px;
            height: 90px;
            font-size: 48px;
        }
    }
    </style>

</head>

<body>

    <div class="box">

        <div class="card">

            <div class="icon">
                👨‍👩‍👧‍👦
            </div>

            <h1>
                بوابة العائلات
            </h1>

            <div class="desc">
                يمكنك تسجيل الدخول للعائلة المسجلة أو تقديم
                طلب انضمام جديد للمخيم بطريقة سهلة وآمنة.
            </div>

            <div class="buttons">

                <a href="/go-login" class="btn login">
                    دخول عائلة مسجلة
                </a>

                <a href="/family-request" class="btn register">
                    طلب انضمام عائلة جديدة
                </a>
            </div>

        </div>

        <div class="features">

            <div class="feature">
                <div class="feature-icon">🔒</div>
                <h3>آمن</h3>
                <p>حماية كاملة للبيانات</p>
            </div>

            <div class="feature">
                <div class="feature-icon">⚡</div>
                <h3>سريع</h3>
                <p>سهولة الوصول والمتابعة</p>
            </div>

            <div class="feature">
                <div class="feature-icon">📋</div>
                <h3>تنظيم</h3>
                <p>إدارة الطلبات بوضوح</p>
            </div>

        </div>

        <div class="footer">
            نظام إدارة المخيمات © 2026
        </div>

    </div>

</body>

</html>