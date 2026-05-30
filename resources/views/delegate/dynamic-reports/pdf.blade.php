<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style>
    @font-face {
        font-family: 'arabic';
        src: url("{{ public_path('fonts/DejaVuSans.ttf') }}") format('truetype');
    }

    body {
        font-family: 'arabic';
        direction: rtl;
        text-align: right;
    }

    .table-wrapper {
        width: 100%;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        direction: rtl;
    }

    th,
    td {
        border: 1px solid #000;
        padding: 10px;
        text-align: center;
        font-size: 14px;
    }

    th {
        background: #198754;
        color: white;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    </style>
</head>


<body>

    <h2>{{ $report->title }}</h2>

    <table>

        <thead>
            <tr>
                @foreach($report->fields as $field)
                <th>{{ $field->label }}</th>
                @endforeach

                <th>تاريخ الإرسال</th>
            </tr>
        </thead>

        <tbody>
            @foreach($report->responses as $response)

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

            @endforeach
        </tbody>

    </table>

</body>

</html>
