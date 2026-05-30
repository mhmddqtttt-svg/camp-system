@extends('layouts.admin')

@section('title', 'إدارة المندوبين')

@section('content')

<style>
.page-header {
    margin-bottom: 25px;
}

.page-title {
    font-size: 34px;
    font-weight: bold;
    color: #0f766e;
    margin-bottom: 8px;
}

.page-subtitle {
    color: #64748b;
    font-size: 15px;
    line-height: 2;
}

.admin-card {
    background: white;
    border-radius: 24px;
    padding: 22px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 15px 35px rgba(15, 23, 42, .08);
    overflow: hidden;
}

.table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.delegates-table {
    width: 100%;
    min-width: 850px;
    border-collapse: collapse;
}

.delegates-table th {
    background: #2563eb;
    color: white;
    padding: 14px 12px;
    text-align: center;
    border: 1px solid #dbeafe;
    font-size: 15px;
    white-space: nowrap;
}

.delegates-table td {
    padding: 15px 12px;
    text-align: center;
    border: 1px solid #e5e7eb;
    font-size: 15px;
    vertical-align: middle;
    line-height: 1.8;
}

.delegates-table tr:nth-child(even) td {
    background: #f8fafc;
}

.name-cell {
    font-weight: bold;
    color: #0f172a;
}

.email-cell {
    direction: ltr;
    color: #334155;
    font-weight: bold;
}

.status-badge {
    display: inline-block;
    padding: 7px 13px;
    border-radius: 999px;
    background: #ecfdf5;
    color: #065f46;
    font-weight: bold;
    font-size: 13px;
    border: 1px solid #bbf7d0;
}

.verified-badge {
    display: inline-block;
    background: #0d6efd;
    color: white;
    padding: 7px 13px;
    border-radius: 999px;
    font-weight: bold;
    font-size: 13px;
    margin-bottom: 8px;
}

.verify-link {
    display: inline-block;
    color: #2563eb;
    font-weight: bold;
    text-decoration: none;
    margin-top: 6px;
}

.verify-link:hover {
    text-decoration: underline;
}

.actions {
    display: flex;
    gap: 8px;
    justify-content: center;
    flex-wrap: wrap;
}

.admin-btn {
    color: white;
    padding: 10px 17px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: bold;
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: .25s;
}

.admin-btn:hover {
    transform: translateY(-2px);
}

.green-btn {
    background: linear-gradient(135deg, #16a34a, #198754);
}

.red-btn {
    background: linear-gradient(135deg, #dc2626, #ef4444);
}

.empty-box {
    padding: 40px 20px;
    text-align: center;
    color: #64748b;
    font-weight: bold;
}

@media(max-width:700px) {
    .page-title {
        font-size: 28px;
        text-align: center;
    }

    .page-subtitle {
        text-align: center;
    }

    .admin-card {
        padding: 14px;
        border-radius: 20px;
    }

    .delegates-table {
        min-width: 850px;
    }
}
</style>

<div class="page-header">
    <div class="page-title">
        إدارة المندوبين
    </div>

    <div class="page-subtitle">
        متابعة حسابات المندوبين، حالة الحساب، والتوثيق.
    </div>
</div>

<div class="admin-card">

    <div class="table-wrapper">

        <table class="delegates-table">

            <tr>
                <th>الاسم</th>
                <th>الإيميل</th>
                <th>الحالة</th>
                <th>التوثيق</th>
                <th>التحكم</th>
            </tr>

            @forelse($delegates as $delegate)

            <tr>

                <td class="name-cell">
                    {{ $delegate->name }}
                </td>

                <td class="email-cell">
                    {{ $delegate->email }}
                </td>

                <td>
                    <span class="status-badge">
                        {{ $delegate->status }}
                    </span>
                </td>

                <td>
                    @if($delegate->is_verified_delegate)

                    <span class="verified-badge">
                        موثق ✓
                    </span>

                    <br>

                    <a href="/admin/delegates/{{ $delegate->id }}/unverify" class="verify-link">
                        إزالة التوثيق
                    </a>

                    @else

                    <a href="/admin/delegates/{{ $delegate->id }}/verify" class="verify-link">
                        توثيق المندوب
                    </a>

                    @endif
                </td>

                <td>
                    <div class="actions">

                        <a class="admin-btn green-btn" href="/admin/delegates/{{ $delegate->id }}/approve">
                            قبول
                        </a>

                        <a class="admin-btn red-btn" href="/admin/delegates/{{ $delegate->id }}/reject">
                            رفض
                        </a>

                    </div>
                </td>

            </tr>

            @empty

            <tr>
                <td colspan="5" class="empty-box">
                    لا يوجد مندوبين حالياً
                </td>
            </tr>

            @endforelse

        </table>

    </div>

</div>

@endsection
