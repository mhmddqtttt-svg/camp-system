<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الكشوفات المتاحة</title>

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
            radial-gradient(circle at top right, rgba(25, 135, 84, .15), transparent 30%),
            linear-gradient(135deg, #f5f7f8, #eef7f1);
        padding: 25px 12px;
        color: #0f172a;
    }

    .page {
        max-width: 950px;
        margin: auto;
    }

    .hero {
        background: linear-gradient(135deg, #065f46, #198754);
        border-radius: 30px;
        padding: 35px;
        color: white;
        margin-bottom: 25px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(25, 135, 84, .25);
    }

    .hero::before {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        background: rgba(255, 255, 255, .12);
        border-radius: 50%;
        top: -90px;
        right: -70px;
    }

    .hero h1 {
        font-size: 40px;
        margin-bottom: 12px;
        position: relative;
        z-index: 2;
    }

    .hero p {
        color: #dcfce7;
        line-height: 2;
        position: relative;
        z-index: 2;
    }

    .card {
        background: white;
        border-radius: 30px;
        padding: 35px;
        box-shadow: 0 18px 45px rgba(15, 23, 42, .08);
        border: 1px solid #e5e7eb;
    }

    .reports-grid {
        display: grid;
        gap: 20px;
    }

    .report-box {
        background: #fff;
        border: 2px solid #e5e7eb;
        border-radius: 24px;
        padding: 25px;
        transition: .25s;
        position: relative;
        overflow: hidden;
    }

    .report-box::before {
        content: "";
        position: absolute;
        width: 120px;
        height: 120px;
        background: rgba(25, 135, 84, .08);
        border-radius: 50%;
        top: -50px;
        left: -50px;
    }

    .report-box:hover {
        transform: translateY(-4px);
        border-color: #198754;
        box-shadow: 0 15px 35px rgba(25, 135, 84, .12);
    }

    .report-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 18px;
        position: relative;
        z-index: 2;
    }

    .report-icon {
        width: 58px;
        height: 58px;
        border-radius: 18px;
        background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        flex-shrink: 0;
    }

    .report-content {
        flex: 1;
    }

    .report-content h3 {
        font-size: 24px;
        color: #065f46;
        margin-bottom: 10px;
    }

    .report-content p {
        line-height: 2;
        color: #475569;
        font-size: 15px;
    }

    .report-footer {
        margin-top: 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .status {
        background: #ecfdf5;
        color: #198754;
        padding: 10px 16px;
        border-radius: 999px;
        font-size: 14px;
        font-weight: bold;
    }

    .fill-btn {
        background: linear-gradient(135deg, #16a34a, #198754);
        color: white;
        padding: 14px 24px;
        border-radius: 16px;
        text-decoration: none;
        font-weight: bold;
        transition: .25s;
        box-shadow: 0 12px 25px rgba(25, 135, 84, .22);
    }

    .fill-btn:hover {
        transform: translateY(-2px);
    }

    .empty-box {
        text-align: center;
        padding: 60px 20px;
        background: #f8fafc;
        border-radius: 24px;
        border: 2px dashed #cbd5e1;
    }

    .empty-box h3 {
        color: #64748b;
        margin-bottom: 10px;
    }

    .back-btn {
        display: inline-block;
        margin-top: 25px;
        background: linear-gradient(135deg, #64748b, #475569);
        color: white;
        padding: 14px 24px;
        border-radius: 16px;
        text-decoration: none;
        font-weight: bold;
        transition: .25s;
    }

    .back-btn:hover {
        transform: translateY(-2px);
    }

    @media(max-width:700px) {

        .hero {
            padding: 25px 20px;
            border-radius: 24px;
        }

        .hero h1 {
            font-size: 30px;
        }

        .card {
            padding: 22px 15px;
            border-radius: 24px;
        }

        .report-top {
            flex-direction: column;
            align-items: flex-start;
        }

        .report-content h3 {
            font-size: 20px;
        }

        .report-footer {
            flex-direction: column;
            align-items: stretch;
        }

        .fill-btn,
        .back-btn {
            width: 100%;
            text-align: center;
        }
    }
    </style>
</head>

<body>

    <div class="page">

        <div class="hero">
            <h1>الكشوفات المتاحة</h1>

            <p>
                يمكنك تعبئة الكشوفات المطلوبة منك بسهولة ومتابعة جميع الطلبات المتاحة داخل النظام.
            </p>
        </div>

        <div class="card">

            <div class="reports-grid">

                @forelse($reports as $report)

                <div class="report-box">

                    <div class="report-top">

                        <div class="report-content">

                            <h3>
                                {{ $report->title }}
                            </h3>

                            <p>
                                {{ $report->description ?? 'لا يوجد وصف لهذا الكشف حالياً.' }}
                            </p>

                        </div>

                        <div class="report-icon">
                            📋
                        </div>

                    </div>

                    <div class="report-footer">

                        <div class="status">
                            متاح للتعبئة
                        </div>

                        <a href="/family/dynamic-reports/{{ $report->id }}/fill" class="fill-btn">

                            تعبئة الكشف

                        </a>

                    </div>

                </div>

                @empty

                <div class="empty-box">

                    <h3>
                        لا توجد كشوفات متاحة حالياً
                    </h3>

                    <p style="color:#64748b;">
                        سيتم عرض الكشوفات الجديدة هنا عند إضافتها من قبل الإدارة.
                    </p>

                </div>

                @endforelse

            </div>

            <a href="/family/dashboard" class="back-btn">
                رجوع للوحة الرئيسية
            </a>

        </div>

    </div>

</body>

</html>
