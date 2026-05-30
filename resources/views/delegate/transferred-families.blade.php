@extends('layouts.delegate')

@section('title', 'العائلات المنقولة')

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

.transferred-count {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: #ecfdf5;
    color: #065f46;
    padding: 10px 16px;
    border-radius: 999px;
    font-weight: bold;
    font-size: 15px;
    border: 1px solid #bbf7d0;
}

.transferred-count span {
    background: #198754;
    color: white;
    min-width: 30px;
    height: 30px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.transferred-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 18px;
}

.transfer-card {
    background: white;
    border-radius: 22px;
    padding: 18px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 15px 35px rgba(15, 23, 42, .06);
    position: relative;
    overflow: hidden;
}

.transfer-card::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    height: 6px;
    background: linear-gradient(135deg, #198754, #22c55e);
}

.card-top {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 14px;
}

.transfer-icon {
    width: 60px;
    height: 60px;
    border-radius: 18px;
    background: linear-gradient(135deg, #dcfce7, #bbf7d0);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    flex-shrink: 0;
}

.family-name {
    font-size: 20px;
    font-weight: bold;
    color: #0f172a;
    line-height: 1.8;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    margin-top: 12px;
}

.info-box {
    background: #f8fafc;
    border-radius: 16px;
    padding: 14px;
    border: 1px solid #e5e7eb;
}

.info-label {
    color: #64748b;
    font-size: 13px;
    margin-bottom: 6px;
    font-weight: bold;
}

.info-value {
    color: #0f172a;
    font-size: 16px;
    font-weight: bold;
    line-height: 1.7;
}

.empty-box {
    background: white;
    border-radius: 24px;
    padding: 55px 25px;
    text-align: center;
    border: 1px solid #e5e7eb;
    box-shadow: 0 15px 35px rgba(15, 23, 42, .06);
}

.empty-icon {
    font-size: 60px;
    margin-bottom: 18px;
}

.empty-title {
    font-size: 26px;
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

    .transferred-count {
        width: 100%;
        justify-content: center;
    }

    .card-top {
        align-items: flex-start;
    }

    .family-name {
        font-size: 18px;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="page-header">

    <div class="page-title">
        العائلات المنقولة
    </div>

    <div class="page-subtitle">
        عرض سجل العائلات التي تم نقلها بين المخيمات.
    </div>

</div>

<div class="top-panel">

    <div class="transferred-count">
        عدد العائلات المنقولة
        <span>{{ $requests->count() }}</span>
    </div>

</div>

@if($requests->count())

<div class="transferred-grid">

    @foreach($requests as $index => $request)

    <div class="transfer-card">

        <div class="card-top">

            <div class="transfer-icon">
                🔁
            </div>

            <div class="family-name">
                {{ $request->user->name ?? '-' }}
            </div>

        </div>

        <div class="info-grid">

            <div class="info-box">
                <div class="info-label">
                    الرقم
                </div>

                <div class="info-value">
                    {{ $index + 1 }}
                </div>
            </div>

            <div class="info-box">
                <div class="info-label">
                    المخيم القديم
                </div>

                <div class="info-value">
                    {{ $request->fromCamp->name ?? '-' }}
                </div>
            </div>

            <div class="info-box">
                <div class="info-label">
                    المخيم الجديد
                </div>

                <div class="info-value">
                    {{ $request->toCamp->name ?? '-' }}
                </div>
            </div>

            <div class="info-box">
                <div class="info-label">
                    تاريخ النقل
                </div>

                <div class="info-value">
                    {{ $request->updated_at->format('Y-m-d H:i') }}
                </div>
            </div>

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
        لا توجد عمليات نقل
    </div>

    <div class="empty-text">
        لا توجد عائلات منقولة حالياً ضمن هذا المخيم.
    </div>

</div>

@endif

@endsection
