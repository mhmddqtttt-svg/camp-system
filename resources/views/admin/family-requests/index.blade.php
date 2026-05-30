<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلبات العائلات</title>

    <style>
    * {
        box-sizing: border-box;
    }

    body {
        font-family: Tahoma, Arial, sans-serif;
        margin: 0;
        min-height: 100vh;
        background: linear-gradient(135deg, #eef7f1, #f8fafc);
        color: #1f2937;
    }

    .page {
        padding: 30px;
    }

    .header-card {
        background: linear-gradient(135deg, #0f5132, #198754);
        color: white;
        padding: 28px;
        border-radius: 24px;
        margin-bottom: 25px;
        box-shadow: 0 15px 35px rgba(25, 135, 84, 0.25);
    }

    .header-card h2 {
        margin: 0 0 8px;
        font-size: 28px;
    }

    .header-card p {
        margin: 0;
        opacity: 0.9;
    }

    .content-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 24px;
        padding: 22px;
        box-shadow: 0 15px 35px rgba(15, 23, 42, 0.08);
        border: 1px solid rgba(226, 232, 240, 0.9);
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
        border-radius: 18px;
    }

    table {
        width: 100%;
        min-width: 1050px;
        border-collapse: collapse;
        background: white;
    }

    th {
        background: #0f5132;
        color: white;
        padding: 16px;
        font-size: 14px;
        white-space: nowrap;
    }

    td {
        padding: 14px;
        border-bottom: 1px solid #eef2f7;
        text-align: center;
        font-size: 14px;
        vertical-align: middle;
    }

    tr:hover td {
        background: #f8fafc;
    }

    .payment-img {
        width: 90px;
        height: 70px;
        object-fit: cover;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.08);
    }

    .badge {
        display: inline-block;
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: bold;
        white-space: nowrap;
    }

    .badge-warning {
        background: #fff7ed;
        color: #c2410c;
    }

    .badge-success {
        background: #ecfdf5;
        color: #047857;
    }

    .badge-danger {
        background: #fef2f2;
        color: #b91c1c;
    }

    .badge-info {
        background: #eff6ff;
        color: #1d4ed8;
    }

    .actions {
        display: flex;
        gap: 8px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn {
        padding: 9px 14px;
        color: white;
        text-decoration: none;
        border-radius: 12px;
        display: inline-block;
        font-size: 13px;
        font-weight: bold;
        transition: 0.2s;
    }

    .btn:hover {
        transform: translateY(-2px);
        opacity: 0.9;
    }

    .accept {
        background: #16a34a;
    }

    .reject {
        background: #dc2626;
    }

    .empty {
        padding: 35px;
        text-align: center;
        color: #6b7280;
    }

    @media (max-width: 768px) {
        .page {
            padding: 15px;
        }

        .header-card {
            padding: 22px;
            border-radius: 20px;
        }

        .header-card h2 {
            font-size: 22px;
        }

        .content-card {
            padding: 14px;
            border-radius: 20px;
        }

        th,
        td {
            padding: 12px 10px;
            font-size: 13px;
        }

        .btn {
            width: 80px;
            text-align: center;
        }
    }
    </style>
</head>

<body>

    <div class="page">

        <div class="header-card">
            <h2>طلبات العائلات</h2>
            <p>متابعة طلبات التسجيل، مراجعة الدفع، وقبول أو رفض الطلبات.</p>
        </div>

        <div class="content-card">

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>رقم الهوية</th>
                            <th>الجوال</th>
                            <th>المخيم</th>
                            <th>المبلغ</th>
                            <th>إشعار الدفع</th>
                            <th>حالة الدفع</th>
                            <th>الحالة</th>
                            <th>التحكم</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($requests as $request)
                        <tr>
                            <td>{{ $request->full_name }}</td>
                            <td>{{ $request->identity_number }}</td>
                            <td>{{ $request->phone }}</td>
                            <td>{{ $request->camp_id }}</td>
                            <td>{{ $request->amount }} شيكل</td>

                            <td>
                                @if($request->payment_image)
                                <a href="{{ asset('storage/' . $request->payment_image) }}" target="_blank">
                                    <img class="payment-img" src="{{ asset('storage/' . $request->payment_image) }}">
                                </a>
                                @else
                                <span class="badge badge-danger">لا يوجد</span>
                                @endif
                            </td>

                            <td>
                                @if($request->payment_status == 'pending')
                                <span class="badge badge-warning">بانتظار المراجعة</span>
                                @elseif($request->payment_status == 'paid')
                                <span class="badge badge-success">تم الدفع</span>
                                @else
                                <span class="badge badge-danger">مرفوض</span>
                                @endif
                            </td>

                            <td>
                                @if($request->status == 'pending_admin')
                                <span class="badge badge-warning">بانتظار الإدارة</span>
                                @elseif($request->status == 'pending_delegate')
                                <span class="badge badge-info">بانتظار المندوب</span>
                                @elseif($request->status == 'approved')
                                <span class="badge badge-success">مقبول</span>
                                @else
                                <span class="badge badge-danger">مرفوض</span>
                                @endif
                            </td>

                            <td>
                                <div class="actions">
                                    <a class="btn accept" href="/admin/family-requests/{{ $request->id }}/approve">
                                        قبول
                                    </a>

                                    <a class="btn reject" href="/admin/family-requests/{{ $request->id }}/reject">
                                        رفض
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="empty">
                                لا توجد طلبات حالياً
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</body>

</html>
