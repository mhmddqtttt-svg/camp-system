@extends('layouts.delegate')

@section('title', 'الكشوفات')

@section('content')

<style>
.page-header {
    margin-bottom: 25px;
}

.page-title {
    font-size: 36px;
    font-weight: bold;
    color: #065f46;
    margin-bottom: 10px;
}

.page-subtitle {
    color: #64748b;
    line-height: 2;
    font-size: 15px;
}

.top-panel {
    background: white;
    border-radius: 26px;
    padding: 22px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 15px 35px rgba(15, 23, 42, .06);
    margin-bottom: 22px;
}

.actions-bar {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    align-items: center;
}

.action-btn {
    color: white;
    padding: 13px 20px;
    border-radius: 15px;
    text-decoration: none;
    border: 0;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    font-weight: bold;
    font-size: 14px;
    transition: .25s;
    min-width: 120px;
}

.action-btn:hover {
    transform: translateY(-2px);
}

.green-btn {
    background: linear-gradient(135deg, #16a34a, #198754);
    box-shadow: 0 10px 22px rgba(25, 135, 84, .18);
}

.red-btn {
    background: linear-gradient(135deg, #dc2626, #ef4444);
    box-shadow: 0 10px 22px rgba(239, 68, 68, .18);
}

.blue-btn {
    background: linear-gradient(135deg, #2563eb, #0d6efd);
    box-shadow: 0 10px 22px rgba(13, 110, 253, .18);
}

.reports-box {
    background: white;
    border-radius: 24px;
    padding: 18px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 15px 35px rgba(15, 23, 42, .06);
    overflow-x: auto;
}

.reports-box table {
    width: 100%;
    border-collapse: collapse;
    min-width: 900px;
}

.reports-box th {
    background: #198754;
    color: white;
    font-weight: bold;
    padding: 13px 10px;
    border: 1px solid #e5e7eb;
    font-size: 14px;
    text-align: center;
    white-space: nowrap;
}

.reports-box td {
    padding: 13px 10px;
    border: 1px solid #e5e7eb;
    text-align: center;
    font-size: 14px;
    line-height: 1.7;
    vertical-align: middle;
}

.reports-box tr:nth-child(even) td {
    background: #f8fafc;
}

@media(max-width:700px) {

    .page-title {
        font-size: 28px;
        text-align: center;
    }

    .page-subtitle {
        text-align: center;
    }

    .top-panel {
        padding: 18px;
        border-radius: 22px;
    }

    .actions-bar {
        flex-direction: column;
        align-items: stretch;
    }

    .action-btn {
        width: 100%;
    }

    .reports-box {
        padding: 12px;
        border-radius: 20px;
    }
}
</style>

<div class="page-header">

    <div class="page-title">
        الكشوفات
    </div>

    <div class="page-subtitle">
        عرض كشف العائلات مع إمكانية التصدير إلى Excel أو PDF والطباعة.
    </div>

</div>

<div class="top-panel">

    <div class="actions-bar">

        <a href="/delegate/reports/export/excel" class="action-btn green-btn">
            تنزيل Excel
        </a>

        <a href="/delegate/reports/export/pdf" class="action-btn red-btn">
            تنزيل PDF
        </a>

        <a href="/delegate/reports/print" target="_blank" class="action-btn blue-btn">
            طباعة
        </a>

    </div>

</div>

<div class="reports-box">
    @include('delegate.reports-table')
</div>

@endsection
