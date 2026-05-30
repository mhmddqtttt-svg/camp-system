<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">

    <title>طباعة الكشف</title>

    <style>
    body {
        font-family: Arial, Tahoma, sans-serif;
        direction: rtl;
        padding: 20px;
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    table {
        width: 100%;
        min-width: 800px;
        border-collapse: collapse;
    }

    th {
        background: #198754;
        color: white;
    }

    th,
    td {
        border: 1px solid #333;
        padding: 10px;
        text-align: center;
        white-space: nowrap;
    }

    @media(max-width:700px) {
        body {
            padding: 10px;
        }

        h1 {
            font-size: 24px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            min-width: 800px;
        }

        th,
        td {
            font-size: 13px;
            padding: 8px;
        }

        .print-btn {
            width: 100%;
            margin-bottom: 15px;
        }
    }

    @media print {

        .print-btn {
            display: none;
        }

        body {
            padding: 0;
            margin: 0;
        }

        .table-wrapper {
            overflow: visible !important;
            width: 100% !important;
        }

        table {
            width: 100% !important;
            min-width: 0 !important;
            table-layout: fixed;
        }

        th,
        td {
            font-size: 12px;
            padding: 6px;
            white-space: normal !important;
            word-break: break-word;
        }
    }
    </style>

</head>

<body>

    <button onclick="window.print()">
        طباعة
    </button>

    <h2>
        {{ $report->title }}
    </h2>

    <div class="table-wrapper">

        <table>

            <tr>
                @foreach($report->fields as $field)
                <th>{{ $field->label }}</th>
                @endforeach

                <th>تاريخ الإرسال</th>

            </tr>

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

        </table>

</body>

</html>
