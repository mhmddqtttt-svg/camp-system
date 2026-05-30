@extends('layouts.admin')

@section('title', 'حسابات المناديب')

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
    border-radius: 18px;
    border: 1px solid #e5e7eb;
}

.delegates-table {
    width: 100%;
    min-width: 900px;
    border-collapse: collapse;
}

.delegates-table th {
    background: #2563eb;
    color: white;
    padding: 15px 12px;
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
    min-width: 170px;
}

.camp-badge {
    display: inline-block;
    padding: 8px 14px;
    border-radius: 999px;
    background: #ecfdf5;
    color: #065f46;
    border: 1px solid #bbf7d0;
    font-size: 13px;
    font-weight: bold;
}

.email-cell {
    direction: ltr;
    color: #334155;
    font-weight: bold;
    min-width: 220px;
}

.password-box {
    background: #f8fafc;
    color: #64748b;
    border: 1px solid #e2e8f0;
    padding: 10px 14px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: bold;
    display: inline-block;
}

.verified-badge {
    display: inline-block;
    padding: 8px 14px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: bold;
}

.verified {
    background: #dbeafe;
    color: #1d4ed8;
    border: 1px solid #bfdbfe;
}

.not-verified {
    background: #fee2e2;
    color: #b91c1c;
    border: 1px solid #fecaca;
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
        min-width: 900px;
    }
}
</style>

<div class="page-header">

    <div class="page-title">
        حسابات المناديب
    </div>

    <div class="page-subtitle">
        عرض جميع حسابات المناديب المرتبطة بالمخيمات مع حالة التوثيق.
    </div>

</div>

<div class="admin-card">

    <div class="table-wrapper">

        <table class="delegates-table">

            <tr>
                <th>اسم المندوب</th>
                <th>المخيم</th>
                <th>الإيميل</th>
                <th>كلمة المرور</th>
                <th>التوثيق</th>
            </tr>

            @forelse($delegates as $delegate)

            <tr>

                <td class="name-cell">
                    {{ $delegate->name }}
                </td>

                <td>
                    <span class="camp-badge">
                        {{ $delegate->camp?->name ?? '-' }}
                    </span>
                </td>

                <td class="email-cell">
                    {{ $delegate->email }}
                </td>

                <td>
                    <span class="password-box">
                        لا يمكن عرض كلمة المرور المشفرة
                    </span>
                </td>

                <td>

                    @if($delegate->is_verified_delegate)

                    <span class="verified-badge verified">
                        موثق ✓
                    </span>

                    @else

                    <span class="verified-badge not-verified">
                        غير موثق
                    </span>

                    @endif

                </td>

            </tr>

            @empty

            <tr>
                <td colspan="5" class="empty-box">
                    لا توجد حسابات حالياً
                </td>
            </tr>

            @endforelse

        </table>

    </div>

</div>

@endsection
