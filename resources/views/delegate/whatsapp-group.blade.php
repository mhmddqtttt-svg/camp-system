@extends('layouts.delegate')

@section('title', 'مجموعة واتساب المخيم')

@section('content')

<style>
.page-header {
    margin-bottom: 25px;
}

.page-title {
    font-size: 36px;
    font-weight: bold;
    color: #065f46;
    margin-bottom: 10px;
}

.page-subtitle {
    color: #64748b;
    line-height: 2;
    font-size: 15px;
}

.whatsapp-card {
    background: white;
    border-radius: 26px;
    padding: 26px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 15px 35px rgba(15, 23, 42, .06);
    position: relative;
    overflow: hidden;
}

.whatsapp-card::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    height: 7px;
    background: linear-gradient(135deg, #198754, #22c55e);
}

.success-alert {
    background: #d1e7dd;
    color: #0f5132;
    padding: 15px 18px;
    border-radius: 18px;
    margin-bottom: 22px;
    font-weight: bold;
    border: 1px solid #badbcc;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

label {
    color: #065f46;
    font-weight: bold;
    font-size: 16px;
}

.form-control {
    width: 100%;
    padding: 15px 16px;
    border: 2px solid #d1d5db;
    border-radius: 16px;
    outline: none;
    font-size: 16px;
    transition: .25s;
    background: #fff;
}

.form-control:focus {
    border-color: #198754;
    box-shadow: 0 0 0 4px rgba(25, 135, 84, .12);
}

.submit-row {
    margin-top: 24px;
    display: flex;
    justify-content: flex-end;
}

.save-btn {
    border: 0;
    cursor: pointer;
    padding: 14px 34px;
    border-radius: 16px;
    color: white;
    font-weight: bold;
    font-size: 16px;
    background: linear-gradient(135deg, #16a34a, #198754);
    box-shadow: 0 10px 25px rgba(25, 135, 84, .22);
    transition: .25s;
}

.save-btn:hover {
    transform: translateY(-2px);
}

@media(max-width:700px) {
    .page-title {
        font-size: 28px;
        text-align: center;
    }

    .page-subtitle {
        text-align: center;
    }

    .whatsapp-card {
        padding: 20px;
        border-radius: 22px;
    }

    .submit-row {
        justify-content: stretch;
    }

    .save-btn {
        width: 100%;
    }
}
</style>

<div class="page-header">

    <div class="page-title">
        مجموعة واتساب المخيم
    </div>

    <div class="page-subtitle">
        يمكنك وضع رابط مجموعة الواتساب الخاصة بالمخيم حتى تتمكن العائلات من متابعة آخر التحديثات والإعلانات.
    </div>

</div>

<div class="whatsapp-card">

    @if(session('success'))
    <div class="success-alert">
        {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('delegate.whatsapp-group.update') }}">
        @csrf

        <div class="form-group">
            <label>رابط مجموعة الواتساب</label>

            <input type="url" name="whatsapp_group_link" value="{{ auth()->user()->whatsapp_group_link }}"
                placeholder="ضع رابط مجموعة الواتساب هنا" class="form-control">
        </div>

        <div class="submit-row">
            <button type="submit" class="save-btn">
                حفظ الرابط
            </button>
        </div>

    </form>

</div>

@endsection
