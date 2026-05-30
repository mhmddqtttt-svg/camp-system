<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style>
    @page {
        margin: 25px;
    }

    body {
        font-family: "DejaVu Sans", sans-serif;
        direction: rtl;
        unicode-bidi: embed;
        text-align: right;
        font-size: 13px;
        color: #111827;
    }

    h1 {
        text-align: center;
        margin-bottom: 25px;
        font-size: 28px;
        font-weight: bold;
    }

    .info {
        margin-bottom: 25px;
        text-align: right;
        line-height: 1.9;
    }

    .info p {
        margin: 5px 0;
        font-size: 13px;
    }

    .info strong {
        font-weight: bold;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        direction: rtl;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #222;
        padding: 8px 6px;
        text-align: center;
        font-size: 11px;
        line-height: 1.6;
        vertical-align: middle;
    }

    th {
        background-color: #198754;
        color: #ffffff;
        font-weight: bold;
    }

    td {
        background-color: #ffffff;
    }
    </style>
</head>

<body>

    <h1>كشف العائلات</h1>

    <div class="info">

        <p>
            <strong>اسم المخيم:</strong>
            {{ $delegate->shelter_camp_name ?? '-' }}
        </p>

        <p>
            <strong>مدير مركز الإيواء:</strong>
            {{ $delegate->shelter_manager ?? '-' }}
        </p>

        <p>
            <strong>رقم التواصل:</strong>
            {{ $delegate->shelter_phone ?? '-' }}
        </p>

        <p>
            <strong>رقم التواصل البديل:</strong>
            {{ $delegate->shelter_alt_phone ?? '-' }}
        </p>

        <p>
            <strong>عنوان مركز الإيواء:</strong>
            {{ $delegate->shelter_address ?? '-' }}
        </p>

        <p>
            <strong>إحداثيات GPS:</strong>
            {{ $delegate->shelter_gps ?? '-' }}
        </p>

        <p>
            <strong>عدد العائلات:</strong>
            {{ $families->count() }}
        </p>

    </div>

    <table>

        <thead>
            <tr>
                <th>م</th>
                <th>الاسم</th>
                <th>رقم الهوية</th>
                <th>الجنس</th>
                <th>العمر</th>
                <th>الجوال</th>
                <th>الحالة الاجتماعية</th>
                <th>عدد أفراد الأسرة</th>
            </tr>
        </thead>

        <tbody>
            @foreach($families as $index => $family)

            @php
            $fullName = trim(
            ($family->first_name ?? '') . ' ' .
            ($family->father_name ?? '') . ' ' .
            ($family->grandfather_name ?? '') . ' ' .
            ($family->family_name ?? '')
            );

            $gender = $family->gender === 'female' ? 'أنثى' : 'ذكر';

            $statuses = [
            'single' => $family->gender === 'female' ? 'عزباء' : 'أعزب',
            'married' => $family->gender === 'female' ? 'متزوجة' : 'متزوج',
            'widowed' => $family->gender === 'female' ? 'أرملة' : 'أرمل',
            'divorced' => $family->gender === 'female' ? 'مطلقة' : 'مطلق',
            'polygamous' => 'متعدد الزوجات',
            ];
            @endphp

            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $fullName ?: '-' }}</td>
                <td>{{ $family->identity_number }}</td>
                <td>{{ $gender }}</td>
                <td>{{ $family->age }}</td>
                <td>{{ $family->phone }}</td>
                <td>{{ $statuses[$family->marital_status] ?? '-' }}</td>
                <td>{{ $family->family_members_count }}</td>
            </tr>

            @endforeach
        </tbody>

    </table>

</body>

</html>
