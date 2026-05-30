<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <style>
    body {
        font-family: DejaVu Sans, sans-serif;
        direction: rtl;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
    }

    th,
    td {
        border: 1px solid #333;
        padding: 6px;
        text-align: center;
    }

    th {
        background: #eee;
    }
    </style>
</head>

<body>

    <h2>كشف العائلات</h2>

    @include('delegate.reports-table')

</body>

</html>
