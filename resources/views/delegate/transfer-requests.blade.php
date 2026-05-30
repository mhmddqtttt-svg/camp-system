@extends('layouts.delegate')

@section('title', 'طلبات النقل')

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

.success-alert {
    background: #d1e7dd;
    color: #0f5132;
    padding: 15px 18px;
    border-radius: 18px;
    margin-bottom: 22px;
    font-weight: bold;
    border: 1px solid #badbcc;
}

.transfer-wrapper {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(330px, 1fr));
    gap: 22px;
}

.transfer-card {
    background: white;
    border-radius: 28px;
    padding: 24px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 18px 40px rgba(15, 23, 42, .07);
    transition: .25s;
    position: relative;
    overflow: hidden;
}

.transfer-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 55px rgba(15, 23, 42, .12);
}

.transfer-card::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    height: 7px;
    background: linear-gradient(135deg, #198754, #22c55e);
}

.transfer-icon {
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
    font-size: 24px;
    font-weight: bold;
    color: #0f172a;
    margin-bottom: 18px;
}

.info-row {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
}

.info-label {
    color: #64748b;
    font-weight: bold;
    min-width: 110px;
}

.info-value {
    color: #0f172a;
    font-weight: bold;
    text-align: left;
    line-height: 1.9;
}

.reason-box {
    margin-top: 14px;
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 18px;
    padding: 15px;
    line-height: 2;
}

.reason-title {
    color: #065f46;
    font-weight: bold;
    margin-bottom: 6px;
}

.status-badge {
    display: inline-block;
    padding: 8px 14px;
    border-radius: 999px;
    font-size: 14px;
    font-weight: bold;
}

.status-pending {
    background: #fef3c7;
    color: #92400e;
}

.status-approved {
    background: #dcfce7;
    color: #166534;
}

.status-rejected {
    background: #fee2e2;
    color: #991b1b;
}

.actions {
    display: flex;
    gap: 12px;
    margin-top: 22px;
}

.action-btn {
    flex: 1;
    text-align: center;
    padding: 13px;
    border-radius: 16px;
    text-decoration: none;
    color: white;
    font-weight: bold;
    transition: .25s;
}

.action-btn:hover {
    transform: translateY(-2px);
}

.approve-btn {
    background: linear-gradient(135deg, #16a34a, #198754);
    box-shadow: 0 10px 25px rgba(25, 135, 84, .22);
}

.reject-btn {
    background: linear-gradient(135deg, #dc2626, #ef4444);
    box-shadow: 0 10px 25px rgba(239, 68, 68, .22);
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

    .transfer-wrapper {
        grid-template-columns: 1fr;
    }

    .transfer-card {
        border-radius: 24px;
        padding: 20px;
    }

    .family-name {
        font-size: 22px;
    }

    .info-row {
        flex-direction: column;
        gap: 4px;
    }

    .info-value {
        text-align: right;
    }

    .actions {
        flex-direction: column;
    }
}
</style>

<div class="page-header">
    <div class="page-title">
        طلبات نقل العائلات
    </div>

    <div class="page-subtitle">
        مراجعة طلبات النقل بين المخيمات واتخاذ قرار القبول أو الرفض.
    </div>
</div>

@if(session('success'))
<div class="success-alert">
    {{ session('success') }}
</div>
@endif

@forelse($requests as $request)

@if($loop->first)
<div class="transfer-wrapper">
    @endif

    <div class="transfer-card">

        <div class="transfer-icon">
            🔁
        </div>

        <div class="family-name">
            {{ $request->user->name }}
        </div>

        <div class="info-row">
            <div class="info-label">المخيم الحالي</div>
            <div class="info-value">{{ $request->fromCamp->name }}</div>
        </div>

        <div class="info-row">
            <div class="info-label">المخيم المطلوب</div>
            <div class="info-value">{{ $request->toCamp->name }}</div>
        </div>

        <div class="info-row">
            <div class="info-label">الحالة</div>

            <div class="info-value">
                @if($request->status == 'pending')
                <span class="status-badge status-pending">بانتظار المراجعة</span>
                @elseif($request->status == 'approved')
                <span class="status-badge status-approved">مقبول</span>
                @else
                <span class="status-badge status-rejected">مرفوض</span>
                @endif
            </div>
        </div>

        <div class="reason-box">
            <div class="reason-title">سبب النقل</div>
            <div>{{ $request->reason ?? 'لا يوجد' }}</div>
        </div>

        @if($request->status == 'pending')
        <div class="actions">
            <a href="/delegate/transfer-requests/{{ $request->id }}/approve" class="action-btn approve-btn">
                قبول الطلب
            </a>

            <a href="/delegate/transfer-requests/{{ $request->id }}/reject" class="action-btn reject-btn">
                رفض الطلب
            </a>
        </div>
        @endif

    </div>

    @if($loop->last)
</div>
@endif

@empty

<div class="empty-box">
    <div class="empty-icon">📭</div>

    <div class="empty-title">
        لا توجد طلبات نقل
    </div>

    <div class="empty-text">
        لا توجد حالياً أي طلبات نقل عائلات بانتظار المراجعة.
    </div>
</div>

@endforelse

@endsection
