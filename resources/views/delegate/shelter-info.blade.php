@extends('layouts.delegate')

@section('title', 'بيانات مركز الإيواء')

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

.shelter-card {
    background: white;
    border-radius: 26px;
    padding: 26px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 15px 35px rgba(15, 23, 42, .06);
    position: relative;
    overflow: hidden;
}

.shelter-card::before {
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

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 9px;
}

.form-group.full {
    grid-column: 1 / -1;
}

label {
    color: #065f46;
    font-weight: bold;
    font-size: 15px;
}

.form-control {
    width: 100%;
    padding: 14px 16px;
    border: 2px solid #d1d5db;
    border-radius: 16px;
    outline: none;
    font-size: 15px;
    transition: .25s;
    background: #fff;
}

.form-control:focus {
    border-color: #198754;
    box-shadow: 0 0 0 4px rgba(25, 135, 84, .12);
}

textarea.form-control {
    min-height: 120px;
    resize: vertical;
    line-height: 2;
}

.submit-row {
    margin-top: 24px;
    display: flex;
    justify-content: flex-end;
}

.save-btn {
    border: 0;
    cursor: pointer;
    padding: 14px 32px;
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

    .shelter-card {
        padding: 20px;
        border-radius: 22px;
    }

    .form-grid {
        grid-template-columns: 1fr;
        gap: 16px;
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
        بيانات مركز الإيواء
    </div>

    <div class="page-subtitle">
        تحديث بيانات المخيم ومعلومات التواصل والعنوان لاستخدامها في الكشوفات والتقارير.
    </div>

</div>

<div class="shelter-card">

    @if(session('success'))
    <div class="success-alert">
        {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="/delegate/shelter-info">
        @csrf

        <div class="form-grid">

            <div class="form-group">
                <label>اسم المخيم</label>
                <input type="text" name="shelter_camp_name" value="{{ auth()->user()->shelter_camp_name }}"
                    class="form-control">
            </div>

            <div class="form-group">
                <label>مدير مركز الإيواء</label>
                <input type="text" name="shelter_manager" value="{{ auth()->user()->shelter_manager }}"
                    class="form-control">
            </div>

            <div class="form-group">
                <label>رقم التواصل</label>
                <input type="text" name="shelter_phone" value="{{ auth()->user()->shelter_phone }}"
                    class="form-control">
            </div>

            <div class="form-group">
                <label>رقم التواصل البديل</label>
                <input type="text" name="shelter_alt_phone" value="{{ auth()->user()->shelter_alt_phone }}"
                    class="form-control">
            </div>

            <div class="form-group full">
                <label>عنوان مركز الإيواء بالتفصيل</label>
                <textarea name="shelter_address" class="form-control">{{ auth()->user()->shelter_address }}</textarea>
            </div>

            <div class="form-group full">
                <label>إحداثيات GPS</label>
                <input type="text" name="shelter_gps" value="{{ auth()->user()->shelter_gps }}" class="form-control">
            </div>

        </div>

        <div class="submit-row">
            <button type="submit" class="save-btn">
                حفظ البيانات
            </button>
        </div>

    </form>

</div>

@endsection
