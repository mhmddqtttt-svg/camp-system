@extends('layouts.delegate')

@section('title', 'ردود الكشف')

@section('content')

<style>
.page-header {
    margin-bottom: 25px;
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
    gap: 10px;
    flex-wrap: wrap;
    align-items: center;
}

.action-btn {
    color: white;
    padding: 12px 18px;
    border-radius: 14px;
    text-decoration: none;
    font-weight: bold;
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
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

.table-box {
    background: white;
    border-radius: 24px;
    padding: 18px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 15px 35px rgba(15, 23, 42, .06);
}

.table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.reports-table {
    width: 100%;
    min-width: 1000px;
    border-collapse: collapse;
}

.reports-table th {
    background: #198754;
    color: white;
    padding: 14px 10px;
    text-align: center;
    border: 1px solid #d1d5db;
    white-space: nowrap;
    font-size: 14px;
}

.reports-table td {
    padding: 14px 10px;
    text-align: center;
    border: 1px solid #e5e7eb;
    background: white;
    line-height: 1.8;
    font-size: 14px;
    vertical-align: middle;
}

.reports-table tr:nth-child(even) td {
    background: #f8fafc;
}

.empty-row {
    color: #64748b;
    font-weight: bold;
    padding: 25px !important;
}

.back-row {
    margin-top: 20px;
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
        border-radius: 20px;
    }

    .actions-bar {
        flex-direction: column;
        align-items: stretch;
    }

    .action-btn {
        width: 100%;
    }

    .table-box {
        padding: 12px;
    }
}
</style>

<div class="page-header">

    <div class="page-title">
        ردود الكشف
    </div>

    <div class="page-subtitle">
        {{ $report->title }}
    </div>

</div>

<div class="top-panel">

    <div class="actions-bar">

        <a href="/delegate/dynamic-reports/{{ $report->id }}/excel" class="action-btn green-btn">
            تنزيل Excel
        </a>

        <a href="/delegate/dynamic-reports/{{ $report->id }}/pdf" target="_blank" class="btn red">
            تنزيل PDF
        </a>
        <a href="/delegate/dynamic-reports/{{ $report->id }}/print" target="_blank" class="action-btn red-btn">
            تنزيل PDF
        </a>

    </div>

</div>

<div class="table-box">

    <div class="table-wrapper">

        <table class="reports-table">

            <tr>

                @foreach($report->fields as $field)
                <th>{{ $field->label }}</th>
                @endforeach

                <th>تاريخ الإرسال</th>

            </tr>

            @forelse($report->responses as $response)

            <tr>

                @foreach($report->fields as $field)

                @php
                $answer = $response->answers[$field->label] ?? '-';
                @endphp

                <td>

                    @if(is_array($answer))

                    {{ $answer['birth_date'] ?? '-' }}

                    <br>

                    العمر:
                    {{ $answer['age'] ?? '-' }}

                    @else

                    {{ $answer }}

                    @endif

                </td>

                @endforeach

                <td>
                    {{ $response->created_at->format('Y-m-d H:i') }}
                </td>

            </tr>

            @empty

            <tr>

                <td colspan="{{ count($report->fields) + 1 }}" class="empty-row">

                    لا توجد ردود حتى الآن

                </td>

            </tr>

            @endforelse

        </table>

    </div>

    <div class="back-row">

        <a href="/delegate/dynamic-reports" class="action-btn blue-btn">
            رجوع
        </a>

    </div>

</div>

@endsection
