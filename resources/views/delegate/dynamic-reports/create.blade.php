@extends('layouts.delegate')

@section('title', 'إنشاء كشف جديد')

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

.form-card {
    background: white;
    border-radius: 26px;
    padding: 26px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 15px 35px rgba(15, 23, 42, .06);
    position: relative;
    overflow: hidden;
}

.form-card::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    height: 7px;
    background: linear-gradient(135deg, #198754, #22c55e);
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

.section-title {
    margin: 30px 0 18px;
    padding-top: 25px;
    border-top: 1px solid #e5e7eb;
    color: #065f46;
    font-size: 28px;
    font-weight: bold;
}

.field-box {
    background: #f8fafc;
    padding: 20px;
    margin-bottom: 16px;
    border-radius: 20px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 10px 25px rgba(15, 23, 42, .04);
}

.field-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}

.age-limits {
    display: none;
    grid-column: 1 / -1;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
    margin-top: 16px;
}

.buttons-row {
    margin-top: 25px;
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.action-btn {
    border: 0;
    cursor: pointer;
    padding: 14px 24px;
    border-radius: 16px;
    color: white;
    font-weight: bold;
    font-size: 15px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: .25s;
}

.action-btn:hover {
    transform: translateY(-2px);
}

.green-btn {
    background: linear-gradient(135deg, #16a34a, #198754);
    box-shadow: 0 10px 25px rgba(25, 135, 84, .22);
}

.blue-btn {
    background: linear-gradient(135deg, #2563eb, #0d6efd);
    box-shadow: 0 10px 25px rgba(13, 110, 253, .18);
}

.orange-btn {
    background: linear-gradient(135deg, #f97316, #fd7e14);
    box-shadow: 0 10px 25px rgba(249, 115, 22, .18);
}

@media(max-width:700px) {
    .page-title {
        font-size: 28px;
        text-align: center;
    }

    .page-subtitle {
        text-align: center;
    }

    .form-card {
        padding: 20px;
        border-radius: 22px;
    }

    .form-grid,
    .field-grid,
    .age-limits {
        grid-template-columns: 1fr;
    }

    .action-btn {
        width: 100%;
    }
}
</style>

<div class="page-header">

    <div class="page-title">
        إنشاء كشف جديد
    </div>

    <div class="page-subtitle">
        أنشئ كشفاً ديناميكياً وحدد الحقول المطلوبة للعائلات.
    </div>

</div>

<div class="form-card">

    <form method="POST" action="/delegate/dynamic-reports">

        @csrf

        <div class="form-grid">

            <div class="form-group full">
                <label>وقت إغلاق الكشف</label>
                <input type="datetime-local" name="expire_at" class="form-control">
            </div>

            <div class="form-group full">
                <label>عنوان الكشف</label>
                <input type="text" name="title" required placeholder="مثال: كسوة العيد" class="form-control">
            </div>

            <div class="form-group full">
                <label>وصف الكشف</label>
                <textarea name="description" rows="4" placeholder="اكتب وصفاً مختصراً للكشف..."
                    class="form-control"></textarea>
            </div>

        </div>

        <div class="section-title">
            الحقول
        </div>

        <div id="fields-container">

            <div class="field-box">

                <div class="field-grid">

                    <div class="form-group">
                        <label>اسم الحقل</label>
                        <input type="text" name="fields[0][label]" required placeholder="مثال: اسم الطفل"
                            class="form-control">
                    </div>

                    <div class="form-group">
                        <label>نوع الحقل</label>
                        <select name="fields[0][type]" class="form-control field-type">
                            <option value="text">نص</option>
                            <option value="number">رقم</option>
                            <option value="date">تاريخ ميلاد</option>
                        </select>
                    </div>

                    <div class="age-limits">

                        <div class="form-group">
                            <label>أقل عمر</label>
                            <input type="number" name="fields[0][min_age]" placeholder="مثال: 5" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>أكبر عمر</label>
                            <input type="number" name="fields[0][max_age]" placeholder="مثال: 12" class="form-control">
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="buttons-row">

            <button type="button" id="add-field" class="action-btn blue-btn">
                + إضافة حقل جديد
            </button>

            <button type="submit" class="action-btn green-btn">
                إنشاء الكشف
            </button>

            <a href="/delegate/dynamic-reports" class="action-btn orange-btn">
                رجوع
            </a>

        </div>

    </form>

</div>

<script>
let fieldIndex = 1;

document.getElementById('add-field').addEventListener('click', function() {
    let html = `
    <div class="field-box">

        <div class="field-grid">

            <div class="form-group">
                <label>اسم الحقل</label>
                <input type="text"
                       name="fields[${fieldIndex}][label]"
                       required
                       placeholder="اسم الحقل"
                       class="form-control">
            </div>

            <div class="form-group">
                <label>نوع الحقل</label>
                <select name="fields[${fieldIndex}][type]"
                        class="form-control field-type">
                    <option value="text">نص</option>
                    <option value="number">رقم</option>
                    <option value="date">تاريخ ميلاد</option>
                </select>
            </div>

            <div class="age-limits">

                <div class="form-group">
                    <label>أقل عمر</label>
                    <input type="number"
                           name="fields[${fieldIndex}][min_age]"
                           placeholder="مثال: 5"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label>أكبر عمر</label>
                    <input type="number"
                           name="fields[${fieldIndex}][max_age]"
                           placeholder="مثال: 12"
                           class="form-control">
                </div>

            </div>

        </div>

    </div>
    `;

    document.getElementById('fields-container').insertAdjacentHTML('beforeend', html);

    fieldIndex++;

    setupFieldTypes();
});

function setupFieldTypes() {
    document.querySelectorAll('.field-type').forEach(function(select) {
        select.onchange = function() {
            let ageBox = this.closest('.field-grid').querySelector('.age-limits');

            if (this.value === 'date') {
                ageBox.style.display = 'grid';
            } else {
                ageBox.style.display = 'none';
            }
        };
    });
}

setupFieldTypes();
</script>

@endsection
