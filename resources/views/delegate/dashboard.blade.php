@extends('layouts.delegate')

@section('title', 'لوحة المندوب')

@section('content')

<div class="box">

    <h1 style="
        margin-bottom:10px;
        color:#198754;
    ">
        مرحباً بك يا {{ auth()->user()->name }}
    </h1>

    <p style="
        font-size:20px;
        color:#555;
        margin-bottom:30px;
    ">
        في مخيم
        <strong>
            {{ auth()->user()->camp?->name }}
        </strong>

        @if(auth()->user()->is_verified_delegate)
        <span style="
            background:#0d6efd;
            color:white;
            border-radius:50%;
            padding:4px 8px;
            font-size:14px;
            margin-right:5px;
        ">
            ✓
        </span>
        @endif
    </p>

    <div class="stats">

        <div class="card">
            <h2>{{ $familiesCount }}</h2>
            <p>عدد العائلات</p>
        </div>

        <div class="card green">
            <h2>{{ $approvedCount }}</h2>
            <p>العائلات المقبولة</p>
        </div>

        <div class="card orange">
            <h2>{{ $pendingCount }}</h2>
            <p>العائلات المعلقة</p>
        </div>

    </div>

</div>

<style>
.stats {
    display: flex;
    gap: 20px;
    margin-top: 30px;
    flex-wrap: wrap;
}

.card {
    flex: 1;
    min-width: 220px;
    background: white;
    padding: 30px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.card h2 {
    font-size: 40px;
    margin-bottom: 10px;
    color: #198754;
}

.card p {
    font-size: 20px;
}

.green {
    border-top: 6px solid green;
}

.orange {
    border-top: 6px solid orange;
}
</style>

@endsection
