<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام إدارة المخيمات</title>

    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Tahoma, Arial, sans-serif;
    }

    body {
        min-height: 100vh;
        color: #fff;
        background:
            radial-gradient(circle at 20% 10%, rgba(56, 189, 248, .32), transparent 28%),
            radial-gradient(circle at 85% 20%, rgba(37, 99, 235, .35), transparent 30%),
            linear-gradient(135deg, #020617, #071a3f 50%, #0b4aa2);
        overflow-x: hidden;
    }

    body::before {
        content: "";
        position: fixed;
        inset: 0;
        background-image:
            linear-gradient(rgba(255, 255, 255, .04) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, .04) 1px, transparent 1px);
        background-size: 44px 44px;
        pointer-events: none;
    }

    .container {
        width: 92%;
        max-width: 1180px;
        margin: auto;
        padding: 28px 0 35px;
        position: relative;
        z-index: 2;
    }

    .brand {
        display: flex;
        justify-content: center;
        margin-bottom: 18px;
    }

    .brand-badge {
        padding: 12px 22px;
        border-radius: 999px;
        background: rgba(255, 255, 255, .11);
        border: 1px solid rgba(255, 255, 255, .18);
        box-shadow: 0 15px 35px rgba(0, 0, 0, .2);
        backdrop-filter: blur(14px);
        font-weight: bold;
    }

    .hero {
        text-align: center;
        padding: 18px 0 20px;
    }

    .hero-icon {
        width: 105px;
        height: 105px;
        margin: 0 auto 14px;
        border-radius: 32px;
        background: linear-gradient(135deg, #1d4ed8, #38bdf8);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 58px;
        box-shadow: 0 20px 45px rgba(56, 189, 248, .35);
    }

    .hero h1 {
        font-size: clamp(40px, 7vw, 72px);
        line-height: 1.25;
        font-weight: 900;
        letter-spacing: -1px;
        text-shadow: 0 12px 35px rgba(0, 0, 0, .35);
    }

    .hero h1 span {
        color: #38bdf8;
    }

    .hero p {
        max-width: 850px;
        margin: 18px auto 0;
        line-height: 2;
        font-size: clamp(16px, 2.7vw, 21px);
        color: #dbeafe;
    }

    .stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin: 28px 0;
    }

    .stat {
        padding: 18px;
        border-radius: 24px;
        background: rgba(255, 255, 255, .1);
        border: 1px solid rgba(255, 255, 255, .16);
        backdrop-filter: blur(16px);
        text-align: center;
        box-shadow: 0 18px 40px rgba(0, 0, 0, .18);
    }

    .stat .num {
        font-size: 30px;
        font-weight: 900;
        margin-top: 6px;
    }

    .stat .label {
        color: #cfe8ff;
        margin-top: 4px;
    }

    .cards {
        display: grid;
        gap: 22px;
    }

    .card {
        position: relative;
        overflow: hidden;
        display: grid;
        grid-template-columns: 155px 1fr;
        gap: 24px;
        align-items: center;
        padding: 28px;
        border-radius: 34px;
        background: linear-gradient(135deg, rgba(255, 255, 255, .98), rgba(239, 246, 255, .96));
        color: #0f172a;
        box-shadow: 0 25px 65px rgba(0, 0, 0, .35);
        border: 1px solid rgba(255, 255, 255, .8);
    }

    .card::after {
        content: "";
        position: absolute;
        width: 190px;
        height: 190px;
        left: -70px;
        top: -70px;
        border-radius: 50%;
        background: rgba(37, 99, 235, .12);
    }

    .card-icon {
        position: relative;
        z-index: 2;
        width: 135px;
        height: 135px;
        border-radius: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 68px;
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .7), 0 18px 35px rgba(37, 99, 235, .18);
    }

    .delegate .card-icon {
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    }

    .family .card-icon {
        background: linear-gradient(135deg, #ffedd5, #fed7aa);
    }

    .card-content {
        position: relative;
        z-index: 2;
    }

    .tag {
        display: inline-block;
        margin-bottom: 10px;
        padding: 7px 14px;
        border-radius: 999px;
        background: #eff6ff;
        color: #1d4ed8;
        font-weight: bold;
        font-size: 13px;
    }

    .delegate .tag {
        background: #ecfdf5;
        color: #047857;
    }

    .family .tag {
        background: #fff7ed;
        color: #c2410c;
    }

    .card h2 {
        font-size: clamp(27px, 4.8vw, 42px);
        font-weight: 900;
        margin-bottom: 10px;
    }

    .card p {
        color: #475569;
        line-height: 2;
        font-size: 17px;
        max-width: 680px;
    }

    .btn {
        margin-top: 18px;
        width: 100%;
        max-width: 340px;
        border: none;
        cursor: pointer;
        padding: 16px 24px;
        border-radius: 18px;
        color: white;
        font-size: 18px;
        font-weight: 900;
        background: linear-gradient(135deg, #2563eb, #0d6efd);
        box-shadow: 0 16px 30px rgba(37, 99, 235, .35);
        transition: .25s;
    }

    .delegate .btn {
        background: linear-gradient(135deg, #059669, #10b981);
        box-shadow: 0 16px 30px rgba(16, 185, 129, .35);
    }

    .family .btn {
        background: linear-gradient(135deg, #f97316, #fb923c);
        box-shadow: 0 16px 30px rgba(249, 115, 22, .35);
    }

    .btn:hover {
        transform: translateY(-3px);
        filter: brightness(1.05);
    }

    .features {
        margin-top: 24px;
        padding: 22px;
        border-radius: 30px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        background: rgba(255, 255, 255, .1);
        border: 1px solid rgba(255, 255, 255, .16);
        backdrop-filter: blur(15px);
    }

    .feature {
        text-align: center;
        padding: 15px 8px;
        border-left: 1px solid rgba(255, 255, 255, .14);
    }

    .feature:last-child {
        border-left: none;
    }

    .feature .i {
        font-size: 34px;
        margin-bottom: 8px;
    }

    .feature h4 {
        font-size: 17px;
        margin-bottom: 5px;
    }

    .feature p {
        color: #dbeafe;
        font-size: 13px;
    }

    .footer {
        text-align: center;
        margin-top: 24px;
        color: #cbd5e1;
    }

    @media (max-width: 800px) {
        .stats {
            grid-template-columns: 1fr;
        }

        .card {
            grid-template-columns: 1fr;
            text-align: center;
            padding: 26px 20px;
        }

        .card-icon {
            margin: auto;
            width: 118px;
            height: 118px;
            font-size: 58px;
        }

        .btn {
            max-width: 100%;
        }

        .features {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 520px) {
        .container {
            width: 90%;
            padding-top: 18px;
        }

        .hero-icon {
            width: 86px;
            height: 86px;
            font-size: 48px;
            border-radius: 26px;
        }

        .hero h1 {
            font-size: 38px;
        }

        .hero p {
            font-size: 15px;
        }

        .stat {
            padding: 14px;
        }

        .card {
            border-radius: 28px;
        }

        .card p {
            font-size: 15px;
        }

        .features {
            grid-template-columns: 1fr;
        }

        .feature {
            border-left: none;
            border-bottom: 1px solid rgba(255, 255, 255, .13);
        }

        .feature:last-child {
            border-bottom: none;
        }
    }
    </style>
</head>

<body>

    <div class="container">

        <div class="brand">
            <div class="brand-badge">🛡️ نظام إدارة المخيمات</div>
        </div>

        <section class="hero">
            <div class="hero-icon">🛡️</div>

            <h1>
                نظام إدارة المخيمات
                <br>
                <span>والعائلات</span>
            </h1>

            <p>
                منصة إلكترونية حديثة وآمنة لإدارة طلبات الانضمام، المندوبين،
                بيانات العائلات، الكشوفات، والتقارير بطريقة سهلة ومنظمة.
            </p>
        </section>

        <section class="stats">
            <div class="stat">
                ⚡
                <div class="num">24/7</div>
                <div class="label">متابعة مستمرة</div>
            </div>

            <div class="stat">
                🔒
                <div class="num">آمن</div>
                <div class="label">حماية للبيانات</div>
            </div>

            <div class="stat">
                📊
                <div class="num">دقيق</div>
                <div class="label">تقارير وكشوفات</div>
            </div>
        </section>

        <section class="cards">

            <div class="card admin">
                <div class="card-icon">🔐</div>

                <div class="card-content">
                    <span class="tag">للإدارة</span>

                    <h2>دخول المسؤول</h2>

                    <p>
                        مراجعة طلبات العائلات، قبول أو رفض الطلبات، إدارة المندوبين،
                        متابعة البيانات، والتحكم الكامل بالنظام.
                    </p>

                    <button onclick="window.location.href='/go-login'" class="btn">
                        دخول المسؤول
                    </button>
                </div>
            </div>

            <div class="card delegate">
                <div class="card-icon">👤</div>

                <div class="card-content">
                    <span class="tag">للمندوبين</span>

                    <h2>دخول المندوب</h2>

                    <p>
                        متابعة العائلات التابعة للمخيم، تحديث حالة الطلبات،
                        الاطلاع على البيانات والكشوفات الخاصة بالمندوب.
                    </p>

                    <button onclick="window.location.href='/delegate'" class="btn">
                        دخول المندوب
                    </button>
                </div>
            </div>

            <div class="card family">
                <div class="card-icon">👨‍👩‍👧‍👦</div>

                <div class="card-content">
                    <span class="tag">للعائلات</span>

                    <h2>دخول العائلات</h2>

                    <p>
                        تقديم طلب انضمام جديد، اختيار المخيم المناسب،
                        متابعة حالة الطلب، وتحديث بيانات العائلة والأفراد.
                    </p>

                    <button onclick="window.location.href='/family'" class="btn">
                        دخول العائلات
                    </button>
                </div>
            </div>

        </section>

        <section class="features">
            <div class="feature">
                <div class="i">🛡️</div>
                <h4>حماية البيانات</h4>
                <p>تنظيم آمن للمعلومات</p>
            </div>

            <div class="feature">
                <div class="i">☁️</div>
                <h4>نسخ احتياطي</h4>
                <p>حفظ ومتابعة مستمرة</p>
            </div>

            <div class="feature">
                <div class="i">⏱️</div>
                <h4>متابعة لحظية</h4>
                <p>إدارة الطلبات بسرعة</p>
            </div>

            <div class="feature">
                <div class="i">📈</div>
                <h4>تقارير شاملة</h4>
                <p>كشوفات وإحصائيات</p>
            </div>
        </section>

        <div class="footer">
            جميع الحقوق محفوظة © 2026
        </div>

    </div>

</body>

</html>
