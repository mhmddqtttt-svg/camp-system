<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة العائلة</title>

    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Tahoma, Arial, sans-serif;
    }

    body {
        background:
            radial-gradient(circle at top right, rgba(16, 185, 129, .18), transparent 30%),
            linear-gradient(135deg, #f8fafc, #eef7f1);
        color: #0f172a;
    }

    .mobile-header {
        display: none;
    }

    .sidebar {
        width: 280px;
        height: 100vh;
        background: linear-gradient(180deg, #064e3b, #198754);
        position: fixed;
        top: 0;
        right: 0;
        padding: 26px 18px;
        overflow-y: auto;
        box-shadow: -12px 0 35px rgba(0, 0, 0, .15);
        z-index: 10;
    }

    .sidebar h2 {
        color: white;
        text-align: center;
        margin-bottom: 10px;
        font-size: 22px;
        line-height: 1.6;
    }

    .camp-name {
        color: #dcfce7;
        font-size: 15px;
        margin-bottom: 24px;
        text-align: center;
        line-height: 1.8;
    }

    .sidebar a {
        display: block;
        color: white;
        text-decoration: none;
        padding: 14px 15px;
        border-radius: 16px;
        margin-bottom: 12px;
        transition: 0.25s;
        font-size: 16px;
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .08);
    }

    .sidebar a:hover {
        background: rgba(255, 255, 255, .2);
        transform: translateX(-4px);
    }

    .logout {
        background: linear-gradient(135deg, #ef4444, #dc2626) !important;
        text-align: center;
        font-weight: bold;
    }

    .social-title {
        background: #ffffff !important;
        color: #198754 !important;
        font-weight: bold;
        cursor: default;
        text-align: center;
    }

    .social-link {
        background: rgba(255, 255, 255, 0.15) !important;
        color: white !important;
        font-weight: bold;
    }

    .whatsapp-sidebar-link {
        background: linear-gradient(135deg, #22c55e, #16a34a) !important;
        color: white !important;
        font-weight: bold;
        text-align: center;
    }

    .main {
        margin-right: 280px;
        padding: 32px;
        min-height: 100vh;
    }

    .hero-card {
        background: linear-gradient(135deg, #064e3b, #198754);
        color: white;
        border-radius: 30px;
        padding: 34px;
        margin-bottom: 24px;
        box-shadow: 0 22px 55px rgba(25, 135, 84, .25);
        position: relative;
        overflow: hidden;
    }

    .hero-card::before {
        content: "";
        position: absolute;
        width: 240px;
        height: 240px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .12);
        left: -80px;
        top: -80px;
    }

    .hero-card h1 {
        font-size: 34px;
        margin-bottom: 12px;
        position: relative;
        z-index: 2;
    }

    .info {
        line-height: 2.1;
        color: #ecfdf5;
        font-size: 16px;
        position: relative;
        z-index: 2;
    }

    .stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat {
        background: white;
        border-radius: 22px;
        padding: 20px;
        box-shadow: 0 14px 35px rgba(15, 23, 42, .08);
        border: 1px solid #e5e7eb;
        text-align: center;
    }

    .stat-icon {
        font-size: 32px;
        margin-bottom: 8px;
    }

    .stat h3 {
        color: #198754;
        font-size: 18px;
        margin-bottom: 5px;
    }

    .stat p {
        color: #64748b;
        font-size: 14px;
    }

    .cards {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
    }

    .card {
        background: rgba(255, 255, 255, .95);
        padding: 28px;
        border-radius: 28px;
        box-shadow: 0 18px 45px rgba(15, 23, 42, .08);
        border: 1px solid #e5e7eb;
        position: relative;
        overflow: hidden;
    }

    .card::before {
        content: "";
        position: absolute;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: rgba(25, 135, 84, .10);
        left: -45px;
        top: -45px;
    }

    .card h3 {
        margin-bottom: 14px;
        color: #047857;
        font-size: 22px;
        position: relative;
    }

    .card p {
        line-height: 2;
        color: #475569;
        margin-bottom: 22px;
        position: relative;
    }

    .btn {
        display: inline-block;
        padding: 13px 24px;
        border-radius: 14px;
        text-decoration: none;
        color: white;
        transition: 0.25s;
        font-weight: bold;
        position: relative;
    }

    .btn:hover {
        transform: translateY(-3px);
    }

    .green {
        background: linear-gradient(135deg, #198754, #16a34a);
        box-shadow: 0 12px 25px rgba(25, 135, 84, .25);
    }

    .blue {
        background: linear-gradient(135deg, #0d6efd, #2563eb);
        box-shadow: 0 12px 25px rgba(13, 110, 253, .25);
    }

    @media (max-width: 900px) {
        .mobile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 30;
            background: linear-gradient(135deg, #064e3b, #198754);
            color: white;
            padding: 14px 16px;
            font-weight: bold;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .18);
        }

        .menu-btn {
            background: rgba(255, 255, 255, .18);
            color: white;
            border: 1px solid rgba(255, 255, 255, .25);
            border-radius: 12px;
            padding: 8px 12px;
            font-size: 22px;
            cursor: pointer;
        }

        .sidebar {
            position: fixed;
            top: 0;
            right: -290px;
            width: 280px;
            height: 100vh;
            transition: .3s;
            z-index: 40;
            border-radius: 0;
        }

        .sidebar.active {
            right: 0;
        }

        .overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .45);
            z-index: 35;
        }

        .overlay.active {
            display: block;
        }

        .main {
            margin-right: 0;
            padding: 18px;
        }

        .stats,
        .cards {
            grid-template-columns: 1fr;
        }

        .btn {
            width: 100%;
            text-align: center;
        }
    }
    </style>
</head>

<body>

    @php
    $socialLinks = \App\Models\SocialLink::where('is_active', true)
    ->whereIn('target', ['all', 'family'])
    ->get();

    $delegate = \App\Models\User::where('camp_id', auth()->user()->camp_id)
    ->where('role', 'delegate')
    ->first();
    @endphp

    <div class="mobile-header">
        <button type="button" class="menu-btn" onclick="openMenu()">☰</button>
        <span>لوحة العائلة</span>
    </div>

    <div class="overlay" onclick="closeMenu()"></div>
    <div class="sidebar">

        <h2>
            مرحباً بك يا {{ auth()->user()->name }}
        </h2>

        <p class="camp-name">
            في مخيم
            <strong>{{ auth()->user()->camp?->name }}</strong>
        </p>

        <a href="/family/dashboard">الرئيسية</a>
        <a href="/family/profile">الملف الأساسي</a>
        <a href="/family/transfer-request">طلب نقل مخيم</a>
        <a href="/family/dynamic-reports">الكشوفات المتاحة</a>

        @if($delegate && $delegate->whatsapp_group_link)
        <a href="{{ $delegate->whatsapp_group_link }}" target="_blank" class="whatsapp-sidebar-link">
            مجموعة واتساب المخيم
        </a>
        @endif

        @if(isset($socialLinks) && $socialLinks->count() > 0)

        <hr style="margin:20px 0;border-color:rgba(255,255,255,0.3);">

        <a class="social-title">روابط التواصل</a>

        @foreach($socialLinks as $link)
        <a href="{{ $link->url }}" target="_blank" class="social-link">
            {{ $link->name }}
        </a>
        @endforeach

        @endif

        <a href="/go-login" class="logout">تسجيل الخروج</a>

    </div>

    <div class="main">

        <div class="hero-card">

            <h1>
                مرحباً {{ auth()->user()->name }}
            </h1>

            <div class="info">
                <div><strong>الإيميل:</strong> {{ auth()->user()->email }}</div>
                <div><strong>نوع الحساب:</strong> عائلة</div>
                <div><strong>الحالة:</strong> نشط</div>
            </div>

        </div>

        <div class="stats">
            <div class="stat">
                <div class="stat-icon">👨‍👩‍👧‍👦</div>
                <h3>حساب عائلة</h3>
                <p>ملف خاص للأسرة</p>
            </div>

            <div class="stat">
                <div class="stat-icon">📋</div>
                <h3>بيانات منظمة</h3>
                <p>تحديث ومتابعة بسهولة</p>
            </div>

            <div class="stat">
                <div class="stat-icon">🛡️</div>
                <h3>آمن</h3>
                <p>حماية كاملة للبيانات</p>
            </div>
        </div>

        <div class="cards">

            <div class="card">
                <h3>الملف الأساسي</h3>

                <p>
                    قم بتعبئة بيانات الأسرة الأساسية حتى يتم اعتماد ملفك داخل النظام.
                </p>

                <a href="/family/profile" class="btn green">
                    تعبئة الملف الأساسي
                </a>
            </div>

            <div class="card">
                <h3>طلب نقل مخيم</h3>

                <p>
                    يمكنك إرسال طلب نقل إلى مخيم آخر وسيتم مراجعته من قبل المندوب الجديد.
                </p>

                <a href="/family/transfer-request" class="btn blue">
                    تقديم طلب نقل
                </a>
            </div>

        </div>

    </div>
    <script>
    function openMenu() {
        document.querySelector('.sidebar').classList.add('active');
        document.querySelector('.overlay').classList.add('active');
    }

    function closeMenu() {
        document.querySelector('.sidebar').classList.remove('active');
        document.querySelector('.overlay').classList.remove('active');
    }
    </script>

</body>

</html>