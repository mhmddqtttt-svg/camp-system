@extends('layouts.delegate')

@section('title', 'الكشوفات الديناميكية')

@section('content')

<style>
.page-header {
    margin-bottom: 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
}

.page-title {
    font-size: 36px;
    font-weight: bold;
    color: #065f46;
    margin-bottom: 8px;
}

.page-subtitle {
    color: #64748b;
    line-height: 2;
    font-size: 15px;
}

.create-btn {
    color: white;
    background: linear-gradient(135deg, #16a34a, #198754);
    padding: 14px 22px;
    border-radius: 16px;
    text-decoration: none;
    font-weight: bold;
    box-shadow: 0 10px 25px rgba(25, 135, 84, .22);
    white-space: nowrap;
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

.reports-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 18px;
}

.report-card {
    background: white;
    border-radius: 22px;
    padding: 18px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 15px 35px rgba(15, 23, 42, .06);
    position: relative;
    overflow: hidden;
}

.report-card::before {
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
    align-items: flex-start;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 14px;
}

.report-main {
    display: flex;
    align-items: center;
    gap: 14px;
}

.report-icon {
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

.report-title {
    font-size: 20px;
    font-weight: bold;
    color: #0f172a;
    line-height: 1.8;
}

.report-desc {
    color: #64748b;
    font-size: 14px;
    line-height: 1.8;
    margin-top: 3px;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 8px 14px;
    border-radius: 999px;
    color: white;
    font-size: 13px;
    font-weight: bold;
    white-space: nowrap;
}

.status-open {
    background: #198754;
}

.status-closed {
    background: #dc3545;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    margin-top: 14px;
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

.countdown {
    color: #065f46;
    font-weight: bold;
}

.actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 16px;
}

.action-btn {
    color: white;
    padding: 11px 18px;
    border-radius: 14px;
    text-decoration: none;
    font-weight: bold;
    font-size: 14px;
    transition: .25s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.action-btn:hover {
    transform: translateY(-2px);
}

.blue-btn {
    background: linear-gradient(135deg, #2563eb, #0d6efd);
}

.green-btn {
    background: linear-gradient(135deg, #16a34a, #198754);
}

.orange-btn {
    background: linear-gradient(135deg, #f97316, #fd7e14);
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
    .page-header {
        flex-direction: column;
        align-items: stretch;
        text-align: center;
    }

    .page-title {
        font-size: 28px;
    }

    .create-btn {
        width: 100%;
        text-align: center;
    }

    .card-top {
        flex-direction: column;
        align-items: stretch;
    }

    .report-main {
        align-items: flex-start;
    }

    .report-title {
        font-size: 18px;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }

    .actions {
        flex-direction: column;
    }

    .action-btn {
        width: 100%;
    }
}
</style>

<div class="page-header">

    <div>
        <div class="page-title">
            الكشوفات الديناميكية
        </div>

        <div class="page-subtitle">
            إدارة الكشوفات المفتوحة والمغلقة ومتابعة الردود والوقت المتبقي.
        </div>
    </div>

    <a href="/delegate/dynamic-reports/create" class="create-btn">
        + إنشاء كشف جديد
    </a>

</div>

@if(session('success'))
<div class="success-alert">
    {{ session('success') }}
</div>
@endif

@if($reports->count())

<div class="reports-grid">

    @foreach($reports as $report)

    @php
    $endTime = null;

    if ($report->opened_at && $report->duration_minutes) {
    $endTime = \Carbon\Carbon::parse($report->opened_at)
    ->addMinutes($report->duration_minutes);
    }
    @endphp

    <div class="report-card">

        <div class="card-top">

            <div class="report-main">

                <div class="report-icon">
                    📋
                </div>

                <div>
                    <div class="report-title">
                        {{ $report->title }}
                    </div>

                    <div class="report-desc">
                        {{ $report->description ?? '-' }}
                    </div>
                </div>

            </div>

            @if($report->is_open)
            <span class="status-badge status-open">
                مفتوح
            </span>
            @else
            <span class="status-badge status-closed">
                مغلق
            </span>
            @endif

        </div>

        <div class="info-grid">

            <div class="info-box">
                <div class="info-label">
                    الوقت المتبقي
                </div>

                <div class="info-value">
                    @if($endTime)
                    <span class="countdown" data-time="{{ $endTime->timestamp * 1000 }}"></span>
                    @else
                    بدون مؤقت
                    @endif
                </div>
            </div>

            <div class="info-box">
                <div class="info-label">
                    عدد الردود
                </div>

                <div class="info-value">
                    {{ $report->responses_count }}
                </div>
            </div>

        </div>

        <div class="actions">

            <a href="/delegate/dynamic-reports/{{ $report->id }}" class="action-btn blue-btn">
                عرض
            </a>

            <a href="/delegate/dynamic-reports/{{ $report->id }}/edit-time" class="action-btn green-btn">
                تعديل الوقت
            </a>

            <a href="/delegate/dynamic-reports/{{ $report->id }}/toggle" class="action-btn orange-btn">
                @if($report->is_open)
                إغلاق
                @else
                فتح
                @endif
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
        لا توجد كشوفات
    </div>

    <div class="empty-text">
        لم يتم إنشاء أي كشف ديناميكي حتى الآن.
    </div>

</div>

@endif

<script>
document.querySelectorAll('.countdown').forEach(function(el) {

    let endTime = parseInt(el.dataset.time);

    function updateCountdown() {

        let now = new Date().getTime();
        let distance = endTime - now;

        if (distance <= 0) {
            el.innerHTML = 'انتهى الوقت';
            el.style.color = '#dc3545';
            el.style.fontWeight = 'bold';
            return;
        }

        let days = Math.floor(distance / (1000 * 60 * 60 * 24));
        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);

        el.innerHTML =
            days + ' يوم ' +
            hours + ' ساعة ' +
            minutes + ' دقيقة ' +
            seconds + ' ثانية';
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);

});
</script>

@endsection
