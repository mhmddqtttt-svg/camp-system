@extends('layouts.admin')

@section('title', 'لوحة المسؤول')

@section('content')

<div class="card">

    <div class="card-header">
        لوحة تحكم المسؤول
    </div>

    <div class="card-body">

        <h2>مرحباً بك داخل لوحة الإدارة</h2>

        <p>
            يمكنك إدارة طلبات العائلات والمندوبين من القائمة الجانبية.
        </p>

        <br>

        <a class="btn blue" href="/admin/family-requests">
            عرض طلبات العائلات
        </a>

        <a class="btn green" href="/admin/delegates">
            إدارة المندوبين
        </a>

    </div>

</div>

@endsection
