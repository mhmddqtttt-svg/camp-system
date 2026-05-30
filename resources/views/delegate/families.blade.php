@extends('layouts.delegate')

@section('title', 'العائلات')

@section('content')

<style>
.page-header {
    margin-bottom: 25px;
}

.page-title {
    font-size: 38px;
    font-weight: bold;
    color: #065f46;
    margin-bottom: 10px;
}

.page-subtitle {
    color: #64748b;
    line-height: 2;
    font-size: 16px;
}

.top-panel {
    background: white;
    border-radius: 28px;
    padding: 24px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 18px 40px rgba(15, 23, 42, .07);
    margin-bottom: 24px;
}

.actions-bar {
    display: flex;
    gap: 12px;
    align-items: center;
    flex-wrap: wrap;
    margin-bottom: 18px;
}

.search-form {
    display: flex;
    gap: 12px;
    flex: 1;
    min-width: 280px;
}

.search-input {
    flex: 1;
    padding: 14px 16px;
    border: 2px solid #d1d5db;
    border-radius: 16px;
    outline: none;
    font-size: 15px;
    transition: .25s;
    background: #fff;
}

.search-input:focus {
    border-color: #198754;
    box-shadow: 0 0 0 4px rgba(25, 135, 84, .12);
}

.action-btn {
    color: white;
    padding: 14px 20px;
    border-radius: 16px;
    text-decoration: none;
    border: 0;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    font-weight: bold;
    font-size: 15px;
    transition: .25s;
    min-width: 115px;
}

.action-btn:hover {
    transform: translateY(-2px);
}

.green-btn {
    background: linear-gradient(135deg, #16a34a, #198754);
    box-shadow: 0 10px 25px rgba(25, 135, 84, .22);
}

.gray-btn {
    background: linear-gradient(135deg, #64748b, #475569);
    box-shadow: 0 10px 25px rgba(71, 85, 105, .18);
}

.red-btn {
    background: linear-gradient(135deg, #dc2626, #ef4444);
    box-shadow: 0 10px 25px rgba(239, 68, 68, .22);
}

.families-count {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #ecfdf5;
    color: #065f46;
    padding: 12px 18px;
    border-radius: 999px;
    font-weight: bold;
    font-size: 17px;
    border: 1px solid #bbf7d0;
}

.families-count span {
    background: #198754;
    color: white;
    min-width: 32px;
    height: 32px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.families-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 22px;
}

.family-card {
    background: white;
    border-radius: 28px;
    padding: 24px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 18px 40px rgba(15, 23, 42, .07);
    transition: .25s;
    position: relative;
    overflow: hidden;
}

.family-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 55px rgba(15, 23, 42, .12);
}

.family-card::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    height: 7px;
    background: linear-gradient(135deg, #198754, #22c55e);
}

.family-icon {
    width: 76px;
    height: 76px;
    border-radius: 24px;
    background: linear-gradient(135deg, #dcfce7, #bbf7d0);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 34px;
    margin-bottom: 18px;
}

.family-name {
    font-size: 23px;
    font-weight: bold;
    color: #0f172a;
    margin-bottom: 18px;
    line-height: 1.8;
}

.info-row {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
}

.info-row:last-child {
    border-bottom: none;
}

.info-label {
    color: #64748b;
    font-weight: bold;
    min-width: 90px;
}

.info-value {
    color: #0f172a;
    font-weight: bold;
    text-align: left;
    line-height: 1.8;
}

.status-badge {
    display: inline-block;
    padding: 8px 14px;
    border-radius: 999px;
    background: #f1f5f9;
    color: #334155;
    font-size: 14px;
    font-weight: bold;
}

.empty-box {
    background: white;
    border-radius: 28px;
    padding: 60px 25px;
    text-align: center;
    border: 1px solid #e5e7eb;
    box-shadow: 0 18px 40px rgba(15, 23, 42, .06);
}

.empty-icon {
    font-size: 65px;
    margin-bottom: 18px;
}

.empty-title {
    font-size: 28px;
    color: #065f46;
    font-weight: bold;
    margin-bottom: 10px;
}

.empty-text {
    color: #64748b;
    line-height: 2;
}

@media(max-width:700px) {
    .page-title {
        font-size: 30px;
        text-align: center;
    }

    .page-subtitle {
        text-align: center;
    }

    .top-panel {
        padding: 18px;
        border-radius: 24px;
    }

    .actions-bar {
        flex-direction: column;
        align-items: stretch;
    }

    .search-form {
        flex-direction: column;
        width: 100%;
        min-width: 0;
    }

    .search-input,
    .action-btn {
        width: 100%;
    }

    .families-count {
        width: 100%;
        justify-content: center;
    }

    .families-grid {
        grid-template-columns: 1fr;
    }

    .family-card {
        border-radius: 24px;
        padding: 20px;
    }

    .family-name {
        font-size: 21px;
    }

    .info-row {
        flex-direction: column;
        gap: 4px;
    }

    .info-value {
        text-align: right;
    }
}
</style>

<div class="page-header">
    <div class="page-title">
        العائلات التابعة للمخيم
    </div>

    <div class="page-subtitle">
        عرض بيانات العائلات التابعة للمخيم مع إمكانية البحث والتصدير.
    </div>
</div>

<div class="top-panel">

    <div class="actions-bar">

        <form method="GET" action="/delegate/families" class="search-form">
            <input type="text" name="identity_number" value="{{ request('identity_number') }}"
                placeholder="ابحث برقم الهوية" class="search-input">

            <button type="submit" class="action-btn green-btn">
                بحث
            </button>
        </form>

        <a href="/delegate/families" class="action-btn gray-btn">
            عرض الكل
        </a>

        <a href="/delegate/families/export/excel?identity_number={{ request('identity_number') }}"
            class="action-btn green-btn">
            تنزيل Excel
        </a>

        <a href="/delegate/families/export/pdf?identity_number={{ request('identity_number') }}"
            class="action-btn red-btn">
            تنزيل PDF
        </a>

    </div>

    <div class="families-count">
        عدد العائلات
        <span>{{ $familiesCount }}</span>
    </div>

</div>

@if($families->count())

<div class="families-grid">

    @foreach($families as $index => $family)

    @php
    $fullName = trim(
    ($family->first_name ?? '') . ' ' .
    ($family->father_name ?? '') . ' ' .
    ($family->grandfather_name ?? '') . ' ' .
    ($family->family_name ?? '')
    );

    $statuses = [
    'single' => $family->gender === 'female' ? 'عزباء' : 'أعزب',
    'married' => $family->gender === 'female' ? 'متزوجة' : 'متزوج',
    'widowed' => $family->gender === 'female' ? 'أرملة' : 'أرمل',
    'divorced' => $family->gender === 'female' ? 'مطلقة' : 'مطلق',
    ];
    @endphp

    <div class="family-card">

        <div class="family-icon">
            👨‍👩‍👧‍👦
        </div>

        <div class="family-name">
            {{ $fullName ?: '-' }}
        </div>

        <div class="info-row">
            <div class="info-label">الرقم</div>
            <div class="info-value">{{ $index + 1 }}</div>
        </div>

        <div class="info-row">
            <div class="info-label">رقم الهوية</div>
            <div class="info-value">{{ $family->identity_number }}</div>
        </div>

        <div class="info-row">
            <div class="info-label">الجوال</div>
            <div class="info-value">{{ $family->phone }}</div>
        </div>

        <div class="info-row">
            <div class="info-label">الحالة</div>
            <div class="info-value">
                <span class="status-badge">
                    {{ $statuses[$family->marital_status] ?? '-' }}
                </span>
            </div>
        </div>

    </div>

    @endforeach

</div>

@else

<div class="empty-box">
    <div class="empty-icon">📭</div>

    <div class="empty-title">
        لا توجد عائلات
    </div>

    <div class="empty-text">
        لا توجد بيانات عائلات مطابقة للبحث الحالي.
    </div>
</div>

@endif

@endsection