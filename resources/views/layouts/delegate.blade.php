<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة المندوب')</title>

    <style>
    * {
        box-sizing: border-box;
        font-family: Tahoma, Arial, sans-serif;
    }

    body {
        margin: 0;
        background:
            radial-gradient(circle at top right, rgba(25, 135, 84, .15), transparent 30%),
            linear-gradient(135deg, #f8fafc, #eef7f1);
        color: #0f172a;
        overflow-x: hidden;
    }

    .mobile-header {
        display: none;
    }

    .layout {
        min-height: 100vh;
    }

    .sidebar {
        width: 285px;
        height: 100vh;
        background: linear-gradient(180deg, #064e3b, #198754);
        position: fixed;
        top: 0;
        right: 0;
        padding: 24px 16px;
        overflow-y: auto;
        box-shadow: -12px 0 35px rgba(0, 0, 0, .15);
        z-index: 40;
    }

    .brand {
        color: white;
        text-align: center;
        font-size: 22px;
        font-weight: bold;
        line-height: 1.7;
        margin-bottom: 22px;
    }

    .verify-badge {
        width: 25px;
        height: 25px;
        background: #1d9bf0;
        border-radius: 50%;
        color: white;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        margin-right: 6px;
        box-shadow: 0 6px 15px rgba(29, 155, 240, .35);
    }

    .sidebar a,
    .sidebar button {
        width: 100%;
        display: block;
        color: white;
        text-decoration: none;
        padding: 14px 15px;
        border-radius: 16px;
        margin-bottom: 11px;
        transition: .25s;
        font-size: 16px;
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .12);
        cursor: pointer;
        text-align: right;
    }

    .sidebar a:hover,
    .sidebar button:hover {
        background: rgba(255, 255, 255, .18);
        transform: translateX(-4px);
    }

    .logout-btn {
        background: linear-gradient(135deg, #dc2626, #ef4444) !important;
        text-align: center !important;
        font-weight: bold;
        margin-top: 10px;
    }

    .count-badge {
        float: left;
        background: #ef4444;
        color: white;
        border-radius: 999px;
        padding: 2px 8px;
        font-size: 13px;
        font-weight: bold;
    }

    .social-title {
        background: transparent !important;
        border: none !important;
        font-weight: bold;
        color: #dcfce7 !important;
        cursor: default !important;
        transform: none !important;
    }

    .social-link {
        background: rgba(255, 255, 255, .12) !important;
    }

    .content {
        margin-right: 285px;
        padding: 30px;
        min-height: 100vh;
    }

    .box,
    .card {
        background: white;
        border-radius: 26px;
        padding: 26px;
        box-shadow: 0 18px 45px rgba(15, 23, 42, .08);
        border: 1px solid #e5e7eb;
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 18px;
        background: white;
        overflow: hidden;
        border-radius: 18px;
    }

    th,
    td {
        border: 1px solid #e5e7eb;
        padding: 14px;
        text-align: center;
    }

    th {
        background: #198754;
        color: white;
    }

    .btn {
        display: inline-block;
        padding: 10px 18px;
        border-radius: 12px;
        text-decoration: none;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
    }

    .green {
        background: #198754;
    }

    .blue {
        background: #0d6efd;
    }

    .orange {
        background: #fd7e14;
    }

    .red {
        background: #dc3545;
    }

    .overlay {
        display: none;
    }

    @media(max-width: 800px) {
        .mobile-header {
            display: flex;
            align-items: center;
            gap: 14px;
            position: sticky;
            top: 0;
            z-index: 50;
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
            right: -300px;
            transition: .3s ease;
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

        .content {
            margin-right: 0;
            padding: 18px;
        }

        .box,
        .card {
            padding: 18px;
            border-radius: 22px;
        }

        table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }

        h1 {
            font-size: 24px;
            text-align: center;
        }

        h2 {
            font-size: 22px;
            text-align: center;
        }

        input,
        select,
        textarea,
        button {
            max-width: 100%;
        }

        .btn,
        .button,
        a[style*="padding"] {
            width: 100%;
            display: block;
            text-align: center;
            margin-bottom: 10px;
        }

        div[style*="display:flex"] {
            flex-direction: column !important;
            align-items: stretch !important;
        }
    }
    </style>
</head>

<body>

    <div class="mobile-header">
        <button type="button" class="menu-btn" onclick="openMenu()">☰</button>
        <span>لوحة المندوب</span>
    </div>

    <div class="overlay" id="overlay" onclick="closeMenu()"></div>

    <div class="layout">

        <aside class="sidebar" id="sidebar">

            <div class="brand">
                نظام إدارة المخيمات والعائلات

                @if(auth()->user()->is_verified_delegate)
                <span class="verify-badge">✔</span>
                @endif
            </div>

            @php
            $socialLinks = \App\Models\SocialLink::where('is_active', true)
            ->whereIn('target', ['all', 'delegate'])
            ->get();

            $transferRequestsCount = \App\Models\CampTransferRequest::where('to_delegate_id', auth()->id())
            ->where('status', 'pending')
            ->count();
            @endphp

            <a href="/delegate/dashboard">الرئيسية</a>
            <a href="/delegate/family-requests">طلبات العائلات</a>

            <a href="/delegate/transfer-requests">
                طلبات نقل العائلات
                @if($transferRequestsCount > 0)
                <span class="count-badge">{{ $transferRequestsCount }}</span>
                @endif
            </a>

            <a href="/delegate/families">العائلات</a>
            <a href="/delegate/transferred-families">العائلات المنقولة</a>
            <a href="/delegate/reports">الكشوفات</a>
            <a href="/delegate/shelter-info">بيانات مركز الإيواء</a>
            <a href="/delegate/dynamic-reports">الكشوفات الديناميكية</a>
            <a href="{{ route('delegate.whatsapp-group') }}">مجموعة واتساب المخيم</a>
            <a href="/">الواجهة العامة</a>

            @if(isset($socialLinks) && $socialLinks->count() > 0)
            <hr style="margin:20px 0;border-color:rgba(255,255,255,.3);">

            <a class="social-title">روابط التواصل</a>

            @foreach($socialLinks as $link)
            <a href="{{ $link->url }}" target="_blank" class="social-link">
                {{ $link->name }}
            </a>
            @endforeach
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn">تسجيل الخروج</button>
            </form>

        </aside>

        <main class="content">
            @yield('content')
        </main>

    </div>

    <script>
    function openMenu() {
        document.getElementById('sidebar').classList.add('active');
        document.getElementById('overlay').classList.add('active');
    }

    function closeMenu() {
        document.getElementById('sidebar').classList.remove('active');
        document.getElementById('overlay').classList.remove('active');
    }
    </script>

</body>

</html>
