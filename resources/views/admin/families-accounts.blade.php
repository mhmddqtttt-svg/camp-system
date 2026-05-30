@extends('layouts.admin')

@section('title', 'حسابات العائلات')

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
    margin-bottom: 24px;
}

.search-form {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 25px;
}

.search-input {
    flex: 1;
    min-width: 280px;
    padding: 13px 15px;
    border: 2px solid #d1d5db;
    border-radius: 14px;
    outline: none;
    font-size: 15px;
}

.search-input:focus {
    border-color: #198754;
    box-shadow: 0 0 0 4px rgba(25, 135, 84, .12);
}

.search-btn {
    border: 0;
    background: linear-gradient(135deg, #16a34a, #198754);
    color: white;
    padding: 13px 25px;
    border-radius: 14px;
    font-weight: bold;
    cursor: pointer;
}

.camp-title {
    background: linear-gradient(135deg, #198754, #16a34a);
    color: white;
    padding: 14px 18px;
    border-radius: 16px;
    font-size: 20px;
    margin: 22px 0 16px;
    font-weight: bold;
}

.table-wrapper {
    width: 100%;
    overflow-x: auto;
    border-radius: 18px;
    border: 1px solid #e5e7eb;
}

.families-table {
    width: 100%;
    min-width: 1200px;
    border-collapse: collapse;
}

.families-table th {
    background: #2563eb;
    color: white;
    padding: 14px 10px;
    text-align: center;
    border: 1px solid #dbeafe;
    font-size: 14px;
    white-space: nowrap;
}

.families-table td {
    padding: 14px 10px;
    text-align: center;
    border: 1px solid #e5e7eb;
    font-size: 14px;
    vertical-align: middle;
    line-height: 1.8;
}

.families-table tr:nth-child(even) td {
    background: #f8fafc;
}

.name-cell {
    font-weight: bold;
    color: #0f172a;
    min-width: 170px;
}

.email-cell {
    direction: ltr;
    color: #334155;
    font-weight: bold;
    min-width: 210px;
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

.wife-box {
    margin-bottom: 8px;
    padding: 9px 10px;
    background: #f1f5f9;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    font-size: 13px;
    min-width: 180px;
}

.wife-box:last-child {
    margin-bottom: 0;
}

.wife-box small {
    color: #475569;
    font-weight: bold;
}

.empty-text {
    color: #94a3b8;
    font-weight: bold;
}

.alert-empty {
    background: #f8d7da;
    color: #842029;
    padding: 15px;
    border-radius: 14px;
    margin-top: 20px;
    font-weight: bold;
    border: 1px solid #f5c2c7;
}

.empty-box {
    background: white;
    padding: 35px 20px;
    border-radius: 18px;
    text-align: center;
    color: #64748b;
    font-weight: bold;
    border: 1px solid #e5e7eb;
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

    .search-form {
        flex-direction: column;
    }

    .search-input,
    .search-btn {
        width: 100%;
        min-width: 0;
    }

    .camp-title {
        font-size: 18px;
        text-align: center;
    }
}
</style>

<div class="page-header">
    <div class="page-title">
        حسابات العائلات حسب المخيم
    </div>

    <div class="page-subtitle">
        عرض حسابات العائلات وتصنيفها حسب المخيم مع إمكانية البحث بالهوية أو الاسم أو الإيميل.
    </div>
</div>

<div class="admin-card">

    <form method="GET" action="/admin/families-accounts" class="search-form">
        <input type="text" name="search" value="{{ $search }}" placeholder="ابحث بالهوية أو الاسم أو الإيميل"
            class="search-input">

        <button type="submit" class="search-btn">
            بحث
        </button>
    </form>

    @forelse($families as $campName => $campFamilies)

    <div class="camp-title">
        {{ $campName ?? 'بدون مخيم' }}
    </div>

    <div class="table-wrapper">

        <table class="families-table">

            <tr>
                <th>الاسم الكامل</th>
                <th>رقم الهوية</th>
                <th>المخيم</th>
                <th>الجوال</th>
                <th>جوال احتياطي</th>
                <th>العمر</th>
                <th>الحالة الاجتماعية</th>
                <th>عدد أفراد الأسرة</th>
                <th>الإيميل</th>
                <th>الزوجات</th>
            </tr>

            @foreach($campFamilies as $family)

            <tr>

                <td class="name-cell">
                    {{
                                trim(
                                    ($family->first_name ?? '') . ' ' .
                                    ($family->father_name ?? '') . ' ' .
                                    ($family->grandfather_name ?? '') . ' ' .
                                    ($family->family_name ?? '')
                                )
                            }}
                </td>

                <td>
                    {{ $family->identity_number }}
                </td>

                <td>
                    {{ $family->camp?->name ?? '-' }}
                </td>

                <td>
                    {{ $family->phone ?? '-' }}
                </td>

                <td>
                    {{ $family->backup_phone ?? '-' }}
                </td>

                <td>
                    {{ $family->age ?? '-' }}
                </td>

                <td>
                    <span class="status-badge">
                        {{ $family->marital_status ?? '-' }}
                    </span>
                </td>

                <td>
                    {{ $family->family_members_count ?? '-' }}
                </td>

                <td class="email-cell">
                    {{ $family->user?->email ?? '-' }}
                </td>

                <td>
                    @forelse($family->wives as $wife)

                    <div class="wife-box">

                        {{
                                        trim(
                                            ($wife->first_name ?? '') . ' ' .
                                            ($wife->father_name ?? '') . ' ' .
                                            ($wife->grandfather_name ?? '') . ' ' .
                                            ($wife->family_name ?? '')
                                        )
                                    }}

                        <br>

                        <small>
                            الهوية:
                            {{ $wife->identity_number }}
                        </small>

                        <br>

                        <small>
                            العمر:
                            {{ $wife->age }}
                        </small>

                    </div>

                    @empty

                    <span class="empty-text">
                        لا يوجد
                    </span>

                    @endforelse
                </td>

            </tr>

            @endforeach

        </table>

    </div>

    @empty

    @if($search)

    <div class="alert-empty">
        لا توجد نتائج مطابقة لعملية البحث.
    </div>

    @else

    <div class="empty-box">
        لا توجد عائلات.
    </div>

    @endif

    @endforelse

</div>

@endsection
