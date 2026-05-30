<table class="reports-table">

    <thead>
        <tr>

            <th>الاسم الكامل</th>

            <th>رقم الهوية</th>

            <th>العمر</th>

            <th>الجوال</th>

            <th>جوال احتياطي</th>

            <th>الحالة الاجتماعية</th>

            <th>عدد أفراد الأسرة</th>

            <th>اسم الزوجة</th>

            <th>هوية الزوجة</th>

            <th>عمر الزوجة</th>

        </tr>
    </thead>

    <tbody>

        @forelse($families as $family)

        @php
        $statuses = [
        'married' => 'متزوج',
        'widowed' => $family->gender == 'female' ? 'أرملة' : 'أرمل',
        'divorced' => $family->gender == 'female' ? 'مطلقة' : 'مطلق',
        'polygamous' => 'متعدد',
        'single' => $family->gender == 'female' ? 'عزباء' : 'أعزب',
        ];

        $fullName =
        ($family->first_name ?? '') . ' ' .
        ($family->father_name ?? '') . ' ' .
        ($family->grandfather_name ?? '') . ' ' .
        ($family->family_name ?? '');
        @endphp

        <tr>

            <td class="name-cell">
                {{ trim($fullName) ?: '-' }}
            </td>

            <td>
                {{ $family->identity_number ?? '-' }}
            </td>

            <td>
                {{ $family->age ?? '-' }}
            </td>

            <td>
                {{ $family->phone ?? '-' }}
            </td>

            <td>
                {{ $family->backup_phone ?? '-' }}
            </td>

            <td>
                <span class="status-badge">
                    {{ $statuses[$family->marital_status] ?? '-' }}
                </span>
            </td>

            <td>
                {{ $family->family_members_count ?? '-' }}
            </td>

            <td>

                @forelse($family->wives as $wife)

                <div class="wife-box">

                    {{ trim(
                            ($wife->first_name ?? '') . ' ' .
                            ($wife->father_name ?? '') . ' ' .
                            ($wife->grandfather_name ?? '') . ' ' .
                            ($wife->family_name ?? '')
                        ) }}

                </div>

                @empty

                <span class="empty-text">
                    لا يوجد
                </span>

                @endforelse

            </td>

            <td>

                @forelse($family->wives as $wife)

                <div class="wife-box">
                    {{ $wife->identity_number ?? '-' }}
                </div>

                @empty

                <span class="empty-text">
                    لا يوجد
                </span>

                @endforelse

            </td>

            <td>

                @forelse($family->wives as $wife)

                <div class="wife-box">
                    {{ $wife->age ?? '-' }}
                </div>

                @empty

                <span class="empty-text">
                    لا يوجد
                </span>

                @endforelse

            </td>

        </tr>

        @empty

        <tr>
            <td colspan="10" class="empty-table">
                لا توجد بيانات
            </td>
        </tr>

        @endforelse

    </tbody>

</table>

<style>
.reports-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 1100px;
}

.reports-table th {
    background: #198754;
    color: white;
    font-weight: bold;
    padding: 14px 10px;
    border: 1px solid #d1d5db;
    text-align: center;
    white-space: nowrap;
    font-size: 14px;
}

.reports-table td {
    padding: 14px 10px;
    border: 1px solid #e5e7eb;
    text-align: center;
    vertical-align: middle;
    line-height: 1.8;
    font-size: 14px;
    background: white;
}

.reports-table tbody tr:nth-child(even) td {
    background: #f8fafc;
}

.name-cell {
    font-weight: bold;
    color: #0f172a;
    min-width: 180px;
}

.status-badge {
    display: inline-block;
    padding: 7px 12px;
    border-radius: 999px;
    background: #ecfdf5;
    color: #065f46;
    font-size: 13px;
    font-weight: bold;
    border: 1px solid #bbf7d0;
}

.wife-box {
    background: #f1f5f9;
    border-radius: 10px;
    padding: 7px 10px;
    margin-bottom: 6px;
    border: 1px solid #e2e8f0;
    font-size: 13px;
}

.wife-box:last-child {
    margin-bottom: 0;
}

.empty-text {
    color: #94a3b8;
    font-size: 13px;
    font-weight: bold;
}

.empty-table {
    padding: 25px !important;
    font-weight: bold;
    color: #64748b;
    background: white !important;
}

@media(max-width:700px) {

    .reports-table {
        min-width: 1200px;
    }

    .reports-table th,
    .reports-table td {
        font-size: 13px;
        padding: 12px 8px;
    }

    .wife-box {
        font-size: 12px;
    }
}
</style>
