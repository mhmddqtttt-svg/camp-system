<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة التحكم')</title>

    <style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: Tahoma, Arial, sans-serif;
        background: #f4f7fb;
        color: #1f2937;
    }

    .topbar {
        height: 64px;
        background: linear-gradient(135deg, #2563eb, #0f766e);
        color: white;
        padding: 0 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 18px;
        font-weight: bold;
        box-shadow: 0 4px 15px rgba(0, 0, 0, .12);
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .menu-toggle {
        display: none;
        background: rgba(255, 255, 255, .18);
        color: white;
        border: 0;
        border-radius: 10px;
        width: 44px;
        height: 44px;
        font-size: 24px;
        cursor: pointer;
    }

    .layout {
        display: flex;
        min-height: calc(100vh - 64px);
    }

    .sidebar {
        width: 250px;
        background: #ffffff;
        border-left: 1px solid #e5e7eb;
        padding: 14px;
        box-shadow: -4px 0 20px rgba(0, 0, 0, .04);
    }

    .sidebar a {
        display: block;
        padding: 14px 16px;
        margin-bottom: 8px;
        color: #374151;
        text-decoration: none;
        border-radius: 12px;
        transition: .2s;
        font-size: 15px;
    }

    .sidebar a:hover {
        background: #eff6ff;
        color: #2563eb;
        transform: translateX(-3px);
    }

    .content {
        flex: 1;
        padding: 28px;
    }

    .card {
        background: white;
        border: 1px solid #e5e7eb;
        margin-bottom: 20px;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .06);
    }

    .card-header {
        background: #1f2937;
        color: white;
        padding: 14px 18px;
        font-weight: bold;
    }

    .card-body {
        padding: 22px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 12px;
        overflow: hidden;
    }

    th {
        background: #2563eb;
        color: white;
    }

    th,
    td {
        border: 1px solid #e5e7eb;
        padding: 12px;
        text-align: center;
    }

    .btn {
        display: inline-block;
        padding: 10px 15px;
        border-radius: 10px;
        color: white;
        text-decoration: none;
        border: 0;
    }

    .green {
        background: #16a34a;
    }

    .red {
        background: #dc2626;
    }

    .blue {
        background: #2563eb;
    }

    .overlay {
        display: none;
    }

    @media (max-width: 768px) {
        .topbar {
            padding: 0 14px;
            font-size: 15px;
        }

        .menu-toggle {
            display: block;
        }

        .layout {
            display: block;
        }

        .sidebar {
            position: fixed;
            top: 64px;
            right: -270px;
            width: 270px;
            height: calc(100vh - 64px);
            z-index: 1001;
            transition: .3s ease;
            overflow-y: auto;
        }

        .sidebar.active {
            right: 0;
        }

        .overlay.active {
            display: block;
            position: fixed;
            inset: 64px 0 0 0;
            background: rgba(0, 0, 0, .45);
            z-index: 1000;
        }

        .content {
            width: 100%;
            padding: 16px;
        }

        .card {
            border-radius: 14px;
        }

        table {
            min-width: 700px;
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }

        th,
        td {
            font-size: 13px;
            padding: 10px;
        }

        input,
        select,
        textarea,
        button {
            width: 100%;
            max-width: 100%;
        }

        .btn {
            width: 100%;
            display: block;
            text-align: center;
            margin-bottom: 10px;
        }
    }
    </style>
</head>

<body>

    <div class="topbar">
        <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
        <span>نظام إدارة المخيمات والعائلات</span>
    </div>

    <div class="overlay" onclick="toggleSidebar()"></div>

    <div class="layout">

        <div class="sidebar" id="sidebar">
            <a href="/admin/dashboard">الرئيسية</a>
            <a href="/admin/family-requests">طلبات العائلات</a>
            <a href="/admin/delegates">إدارة المندوبين</a>
            <a href="/admin/families-accounts">حسابات العائلات</a>
            <a href="/admin/delegates-accounts">حسابات المناديب</a>
            <a href="/admin/social-links">روابط التواصل</a>
            <a href="/">الواجهة العامة</a>
        </div>

        <div class="content">
            @yield('content')
        </div>

    </div>

    <script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('active');
        document.querySelector('.overlay').classList.toggle('active');
    }
    </script>

</body>

</html>
