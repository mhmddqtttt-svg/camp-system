@extends('layouts.delegate')

@section('title', 'طلبات العائلات')

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

.requests-wrapper {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 22px;
}

.request-card {
    background: white;
    border-radius: 28px;
    padding: 24px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 18px 40px rgba(15, 23, 42, .07);
    transition: .25s;
    position: relative;
    overflow: hidden;
}

.request-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 55px rgba(15, 23, 42, .12);
}

.request-card::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    height: 7px;
    background: linear-gradient(135deg, #198754, #22c55e);
}

.family-avatar {
    width: 75px;
    height: 75px;
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
    gap: 10px;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
}

.info-row:last-child {
    border-bottom: none;
}

.info-label {
    color: #64748b;
    font-weight: bold;
}

.info-value {
    color: #0f172a;
    font-weight: bold;
    text-align: left;
}

.status-badge {
    display: inline-block;
    padding: 8px 14px;
    border-radius: 999px;
    background: #fef3c7;
    color: #92400e;
    font-size: 14px;
    font-weight: bold;
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

    .request-card {
        border-radius: 24px;
        padding: 20px;
    }

    .family-name {
        font-size: 22px;
    }

    .actions {
        flex-direction: column;
    }
}
</style>

<div class="page-header">

    <div class="page-title">
        طلبات العائلات المعلقة
    </div>

    <div class="page-subtitle">
        مراجعة طلبات الانضمام الخاصة بالعائلات وقبولها أو رفضها بسهولة.
    </div>

</div>

@if($requests->count())

<div class="requests-wrapper">

    @foreach($requests as $request)

    <div class="request-card">

        <div class="family-avatar">
            👨‍👩‍👧‍👦
        </div>

        <div class="family-name">
            {{ $request->full_name }}
        </div>

        <div class="info-row">
            <div class="info-label">
                رقم الهوية
            </div>

            <div class="info-value">
                {{ $request->identity_number }}
            </div>
        </div>

        <div class="info-row">
            <div class="info-label">
                رقم الجوال
            </div>

            <div class="info-value">
                {{ $request->phone }}
            </div>
        </div>

        <div class="info-row">
            <div class="info-label">
                الحالة
            </div>

            <div class="info-value">
                <span class="status-badge">
                    {{ $request->status }}
                </span>
            </div>
        </div>

        <div class="actions">

            <a href="/delegate/families/{{ $request->id }}/approve" class="action-btn approve-btn">

                قبول الطلب

            </a>

            <a href="/delegate/families/{{ $request->id }}/reject" class="action-btn reject-btn">

                رفض الطلب

            </a>

        </div>

    </div>

    @endforeach

</div>

@else

<div class="empty-box">

    <div class="empty-icon">
        📭
    </div>

    <div class="empty-title">
        لا توجد طلبات حالياً
    </div>

    <div class="empty-text">
        جميع الطلبات تمت مراجعتها، وعند وصول طلبات جديدة ستظهر هنا مباشرة.
    </div>

</div>

@endif

@endsection
