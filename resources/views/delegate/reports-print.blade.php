<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>كشف العائلات</title>

    <style>
    @page {
        margin: 20px;
    }

    body {
        font-family: dejavusans;
        direction: rtl;
        text-align: right;
        padding: 15px;
        color: #111827;
        font-size: 13px;
    }

    h1 {
        text-align: center;
        margin-bottom: 18px;
        font-size: 28px;
        font-weight: bold;
    }

    .print-btn {
        margin-bottom: 20px;
        background: #198754;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
    }

    .shelter-box {
        border: 2px solid #198754;
        border-radius: 12px;
        padding: 18px;
        margin-bottom: 25px;
        background: #f8fff9;
        direction: rtl;
        text-align: right;
    }

    .shelter-box h3 {
        margin-top: 0;
        margin-bottom: 16px;
        color: #198754;
        font-size: 20px;
    }

    .shelter-item {
        margin-bottom: 9px;
        font-size: 14px;
        line-height: 1.8;
    }

    .shelter-item strong {
        font-weight: bold;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        direction: rtl;
        margin-top: 15px;
    }

    th {
        background-color: #198754;
        color: white;
        font-weight: bold;
    }

    th,
    td {
        border: 1px solid #333;
        padding: 8px 6px;
        text-align: center;
        vertical-align: middle;
        font-size: 11px;
        line-height: 1.6;
    }

    hr {
        border: none;
        border-top: 1px solid #ccc;
        margin: 5px 0;
    }

    @media print {
        .print-btn {
            display: none;
        }
    }
    </style>
</head>

<body>

    @if(!request()->is('delegate/reports/export/pdf'))
    <button onclick="window.print()" class="print-btn">
        طباعة / PDF
    </button>
    @endif

    <h1>كشف العائلات</h1>

    <div class="shelter-box">

        <h3>بيانات مركز الإيواء</h3>

        <div class="shelter-item">
            <strong>مدير مركز الإيواء:</strong>
            {{ auth()->user()->shelter_manager ?? '-' }}
        </div>

        <div class="shelter-item">
            <strong>رقم التواصل:</strong>
            {{ auth()->user()->shelter_phone ?? '-' }}
        </div>

        <div class="shelter-item">
            <strong>رقم التواصل البديل:</strong>
            {{ auth()->user()->shelter_alt_phone ?? '-' }}
        </div>

        <div class="shelter-item">
            <strong>عنوان مركز الإيواء:</strong>
            {{ auth()->user()->shelter_address ?? '-' }}
        </div>

        <div class="shelter-item">
            <strong>إحداثيات GPS:</strong>
            {{ auth()->user()->shelter_gps ?? '-' }}
        </div>

    </div>

    @include('delegate.reports-table')

</body>

</html>
