@extends('layouts.admin')

@section('title', 'روابط التواصل')

@section('content')

<style>
.page-header {
    margin-bottom: 25px;
}

.page-title {
    font-size: 34px;
    font-weight: bold;
    color: #0f766e;
    margin-bottom: 8px;
}

.page-subtitle {
    color: #64748b;
    font-size: 15px;
    line-height: 2;
}

.admin-card {
    background: white;
    border-radius: 24px;
    padding: 22px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 15px 35px rgba(15, 23, 42, .08);
    overflow: hidden;
    margin-bottom: 24px;
}

.card-title {
    font-size: 22px;
    color: #0f172a;
    font-weight: bold;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid #e5e7eb;
}

.success-box {
    background: #dcfce7;
    color: #166534;
    padding: 15px 18px;
    border-radius: 16px;
    margin-bottom: 20px;
    font-weight: bold;
    border: 1px solid #86efac;
    animation: fadeIn .4s;
}

.social-grid {
    display: grid;
    grid-template-columns: 1.2fr 2fr 1fr 90px 120px;
    gap: 14px;
    align-items: end;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #065f46;
    font-size: 14px;
}

.form-control-custom {
    width: 100%;
    height: 46px;
    border: 2px solid #d1d5db;
    border-radius: 14px;
    padding: 9px 12px;
    font-size: 15px;
    box-sizing: border-box;
    outline: none;
    transition: .25s;
    background: white;
}

.form-control-custom:focus {
    border-color: #198754;
    box-shadow: 0 0 0 4px rgba(25, 135, 84, .12);
}

.check-box {
    width: 24px;
    height: 24px;
    accent-color: #198754;
}

.btn-custom {
    border: none;
    border-radius: 14px;
    padding: 12px 18px;
    cursor: pointer;
    font-weight: bold;
    color: white;
    font-size: 14px;
    transition: .25s;
    min-height: 46px;
}

.btn-custom:hover {
    transform: translateY(-2px);
}

.btn-blue {
    background: linear-gradient(135deg, #2563eb, #0d6efd);
}

.btn-green {
    background: linear-gradient(135deg, #16a34a, #198754);
}

.btn-red {
    background: linear-gradient(135deg, #dc2626, #ef4444);
}

.table-wrapper {
    width: 100%;
    overflow-x: auto;
    border-radius: 18px;
    border: 1px solid #e5e7eb;
}

.social-table {
    width: 100%;
    min-width: 950px;
    border-collapse: collapse;
    text-align: center;
}

.social-table th {
    background: #2563eb;
    color: white;
    padding: 14px 10px;
    border: 1px solid #dbeafe;
    font-size: 14px;
    white-space: nowrap;
}

.social-table td {
    padding: 12px 10px;
    border: 1px solid #e5e7eb;
    vertical-align: middle;
    background: white;
}

.social-table tr:nth-child(even) td {
    background: #f8fafc;
}

.actions {
    display: flex;
    gap: 8px;
    justify-content: center;
    flex-wrap: wrap;
}

.empty-box {
    padding: 35px 20px;
    color: #64748b;
    font-weight: bold;
}

@media(max-width:900px) {
    .social-grid {
        grid-template-columns: 1fr;
    }

    .btn-custom {
        width: 100%;
    }

    .admin-card {
        padding: 16px;
    }
}

@media(max-width:700px) {
    .page-title {
        font-size: 28px;
        text-align: center;
    }

    .page-subtitle {
        text-align: center;
    }

    .admin-card {
        border-radius: 20px;
    }

    .card-title {
        text-align: center;
        font-size: 20px;
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<div class="page-header">
    <div class="page-title">
        روابط التواصل
    </div>

    <div class="page-subtitle">
        إدارة روابط المنصات الاجتماعية وتحديد ظهورها للمندوبين أو العائلات أو الجميع.
    </div>
</div>

@if(session('success'))

<div id="success-alert" class="success-box">
    ✅ {{ session('success') }}
</div>

<script>
setTimeout(() => {
    let alert = document.getElementById('success-alert');

    if (alert) {
        alert.style.transition = "0.5s";
        alert.style.opacity = "0";
        setTimeout(() => {
            alert.remove();
        }, 500);
    }
}, 2500);
</script>

@endif

<div class="admin-card">

    <div class="card-title">
        إضافة منصة جديدة
    </div>

    <form method="POST" action="{{ route('admin.social-links.store') }}">
        @csrf

        <div class="social-grid">

            <div class="form-group">
                <label>اسم المنصة</label>
                <input type="text" name="name" class="form-control-custom" required>
            </div>

            <div class="form-group">
                <label>الرابط</label>
                <input type="url" name="url" class="form-control-custom" required>
            </div>

            <div class="form-group">
                <label>إظهار لمن</label>
                <select name="target" class="form-control-custom">
                    <option value="all">الجميع</option>
                    <option value="delegate">المندوب فقط</option>
                    <option value="family">العائلة فقط</option>
                </select>
            </div>

            <div class="form-group">
                <label>مفعل</label>
                <input type="checkbox" name="is_active" class="check-box" checked>
            </div>

            <button class="btn-custom btn-blue">
                إضافة
            </button>

        </div>
    </form>

</div>

<div class="admin-card">

    <div class="card-title">
        المنصات الحالية
    </div>

    <div class="table-wrapper">

        <table class="social-table">

            <thead>
                <tr>
                    <th>المنصة</th>
                    <th>الرابط</th>
                    <th>الظهور</th>
                    <th>الحالة</th>
                    <th>التحكم</th>
                </tr>
            </thead>

            <tbody>
                @forelse($links as $link)

                <tr>

                    <form method="POST" action="{{ route('admin.social-links.update', $link) }}">
                        @csrf
                        @method('PUT')

                        <td>
                            <input type="text" name="name" value="{{ $link->name }}" class="form-control-custom">
                        </td>

                        <td>
                            <input type="url" name="url" value="{{ $link->url }}" class="form-control-custom">
                        </td>

                        <td>
                            <select name="target" class="form-control-custom">
                                <option value="all" {{ $link->target == 'all' ? 'selected' : '' }}>
                                    الجميع
                                </option>

                                <option value="delegate" {{ $link->target == 'delegate' ? 'selected' : '' }}>
                                    المندوب
                                </option>

                                <option value="family" {{ $link->target == 'family' ? 'selected' : '' }}>
                                    العائلة
                                </option>
                            </select>
                        </td>

                        <td>
                            <input type="checkbox" name="is_active" class="check-box"
                                {{ $link->is_active ? 'checked' : '' }}>
                        </td>

                        <td>
                            <div class="actions">

                                <button class="btn-custom btn-green">
                                    حفظ
                                </button>
                    </form>

                    <form method="POST" action="{{ route('admin.social-links.destroy', $link) }}">
                        @csrf
                        @method('DELETE')

                        <button class="btn-custom btn-red" onclick="return confirm('حذف الرابط؟')">
                            حذف
                        </button>

                    </form>

    </div>
    </td>

    </tr>

    @empty

    <tr>
        <td colspan="5" class="empty-box">
            لا توجد روابط حالياً
        </td>
    </tr>

    @endforelse
    </tbody>

    </table>

</div>

</div>

@endsection
