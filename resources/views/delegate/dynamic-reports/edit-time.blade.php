@extends('layouts.delegate')

@section('title', 'تعديل وقت الكشف')

@section('content')

<div class="box">

    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:35px;
        flex-wrap:wrap;
        gap:15px;
    ">

        <div>
            <h1 style="
                margin:0;
                color:#0b6b45;
                font-size:38px;
                font-weight:bold;
            ">
                تعديل وقت الكشف
            </h1>

            <p style="
                margin-top:10px;
                color:#777;
                font-size:16px;
            ">
                يمكنك تعديل مدة فتح الكشف بالدقائق
            </p>
        </div>

    </div>

    @if(session('success'))

    <div style="
        background:#d1e7dd;
        color:#0f5132;
        padding:15px;
        border-radius:12px;
        margin-bottom:25px;
        font-weight:bold;
    ">
        {{ session('success') }}
    </div>

    @endif

    <form method="POST" action="/delegate/dynamic-reports/{{ $report->id }}/update-time">
        @csrf
        @method('PUT')

        <div style="margin-bottom:30px;">

            <label style="
                display:block;
                margin-bottom:12px;
                font-weight:bold;
                color:#333;
                font-size:18px;
            ">
                مدة الكشف بالدقائق
            </label>

            <input type="number" name="duration_minutes" value="{{ $report->duration_minutes }}"
                placeholder="أدخل المدة بالدقائق" style="
                    width:100%;
                    padding:18px;
                    border:1px solid #dcdcdc;
                    border-radius:14px;
                    background:#f8f9fa;
                    font-size:18px;
                    outline:none;
                    transition:0.3s;
                ">

        </div>

        <div style="
            display:flex;
            gap:15px;
            flex-wrap:wrap;
        ">

            <button type="submit" style="
                        background:#198754;
                        color:white;
                        border:none;
                        padding:14px 28px;
                        border-radius:12px;
                        font-size:17px;
                        font-weight:bold;
                        cursor:pointer;
                    ">
                حفظ الوقت
            </button>

            <a href="/delegate/dynamic-reports" style="
                    background:#fd7e14;
                    color:white;
                    text-decoration:none;
                    padding:14px 28px;
                    border-radius:12px;
                    font-size:17px;
                    font-weight:bold;
               ">
                رجوع
            </a>

        </div>

    </form>

</div>

@endsection