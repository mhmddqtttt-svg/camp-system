<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الملف الأساسي</title>

    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Tahoma, Arial, sans-serif;
    }

    body {
        min-height: 100vh;
        background:
            radial-gradient(circle at top right, rgba(25, 135, 84, .20), transparent 30%),
            linear-gradient(135deg, #f8fafc, #eef7f1);
        padding: 30px 15px;
        color: #0f172a;
    }

    .page {
        max-width: 980px;
        margin: auto;
    }

    .header {
        background: linear-gradient(135deg, #064e3b, #198754);
        color: white;
        border-radius: 30px;
        padding: 32px;
        margin-bottom: 22px;
        box-shadow: 0 22px 55px rgba(25, 135, 84, .25);
        position: relative;
        overflow: hidden;
    }

    .header::before {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .12);
        left: -70px;
        top: -90px;
    }

    .header h2 {
        font-size: 34px;
        margin-bottom: 10px;
        position: relative;
        z-index: 2;
    }

    .header p {
        color: #dcfce7;
        line-height: 2;
        position: relative;
        z-index: 2;
    }

    .card {
        background: rgba(255, 255, 255, .96);
        padding: 30px;
        border-radius: 30px;
        box-shadow: 0 18px 45px rgba(15, 23, 42, .08);
        border: 1px solid #e5e7eb;
    }

    .section-title {
        margin: 10px 0 22px;
        color: #047857;
        font-size: 22px;
        font-weight: 900;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .field {
        margin-bottom: 4px;
    }

    .field.full {
        grid-column: 1 / -1;
    }

    .field label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #064e3b;
        font-size: 14px;
    }

    input,
    select {
        width: 100%;
        padding: 15px 16px;
        border: 1px solid #d1d5db;
        border-radius: 16px;
        box-sizing: border-box;
        background: white;
        font-size: 15px;
        outline: none;
        transition: .25s;
    }

    input:focus,
    select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 4px rgba(25, 135, 84, .12);
    }

    input[readonly] {
        background: #f8fafc;
        color: #64748b;
    }

    .wife-box {
        background: #f0fdf4;
        padding: 24px;
        border-radius: 24px;
        margin-top: 22px;
        border: 1px solid #bbf7d0;
    }

    .wife-box h3 {
        color: #047857;
        margin-bottom: 18px;
        font-size: 21px;
    }

    .error {
        color: #991b1b;
        background: #fef2f2;
        border: 1px solid #fecaca;
        padding: 14px;
        border-radius: 16px;
        margin-bottom: 16px;
        line-height: 1.8;
    }

    .success {
        background: #d1e7dd;
        color: #0f5132;
        padding: 15px;
        margin-bottom: 16px;
        border-radius: 16px;
        border: 1px solid #badbcc;
    }

    .actions {
        display: flex;
        gap: 12px;
        margin-top: 26px;
        flex-wrap: wrap;
    }

    button,
    .back-btn {
        border: none;
        color: white;
        padding: 15px 28px;
        border-radius: 16px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
        transition: .25s;
        display: inline-block;
        text-align: center;
    }

    button:hover,
    .back-btn:hover {
        transform: translateY(-3px);
    }

    .save-btn {
        background: linear-gradient(135deg, #198754, #16a34a);
        box-shadow: 0 12px 25px rgba(25, 135, 84, .25);
        flex: 1;
    }

    .add-wife-btn {
        background: linear-gradient(135deg, #0d6efd, #2563eb);
        box-shadow: 0 12px 25px rgba(13, 110, 253, .25);
        margin-top: 20px;
    }

    .back-btn {
        background: linear-gradient(135deg, #64748b, #475569);
    }

    @media (max-width: 700px) {
        body {
            padding: 18px 10px;
        }

        .header {
            padding: 24px 20px;
            border-radius: 24px;
        }

        .header h2 {
            font-size: 28px;
        }

        .card {
            padding: 22px 15px;
            border-radius: 24px;
        }

        .grid {
            grid-template-columns: 1fr;
        }

        .actions {
            flex-direction: column;
        }

        button,
        .back-btn {
            width: 100%;
        }

        .wife-box {
            padding: 18px 14px;
        }
    }
    </style>
</head>

<body>

    <div class="page">

        <div class="header">
            <h2>الملف الأساسي</h2>
            <p>قم بتعبئة بيانات الأسرة الأساسية بدقة حتى يتم اعتماد ملفك داخل النظام.</p>
        </div>

        <div class="card">

            @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif

            @if(session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
            @endif

            @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="/family/profile">
                @csrf

                <h3 class="section-title">بيانات رب/ربة الأسرة</h3>

                <div class="grid">

                    <div class="field">
                        <label>رقم الهوية</label>
                        <input type="text" name="identity_number" placeholder="أدخل رقم الهوية - 9 أرقام" maxlength="9"
                            minlength="9" pattern="[0-9]{9}" inputmode="numeric"
                            value="{{ old('identity_number', $member->identity_number ?? '') }}" required>
                    </div>

                    <div class="field">
                        <label id="family-owner-label">
                            {{ old('gender', $member->gender ?? '') == 'female' ? 'اسم ربة الأسرة' : 'اسم رب الأسرة' }}
                        </label>

                        <input type="text" name="first_name" placeholder="أدخل الاسم"
                            value="{{ old('first_name', $member->first_name ?? '') }}" required>
                    </div>

                    <div class="field">
                        <label>اسم الأب</label>
                        <input type="text" name="father_name" placeholder="أدخل اسم الأب"
                            value="{{ old('father_name', $member->father_name ?? '') }}" required>
                    </div>

                    <div class="field">
                        <label>اسم الجد</label>
                        <input type="text" name="grandfather_name" placeholder="أدخل اسم الجد"
                            value="{{ old('grandfather_name', $member->grandfather_name ?? '') }}" required>
                    </div>

                    <div class="field">
                        <label>اسم العائلة</label>
                        <input type="text" name="family_name" placeholder="أدخل اسم العائلة"
                            value="{{ old('family_name', $member->family_name ?? '') }}" required>
                    </div>

                    <div class="field">
                        <label>تاريخ الميلاد</label>
                        <input type="date" name="birth_date" id="birth_date"
                            value="{{ old('birth_date', $member->birth_date ?? '') }}" onchange="calculateMainAge()">
                    </div>

                    <div class="field">
                        <label>العمر</label>
                        <input type="text" id="age" placeholder="العمر يظهر تلقائياً"
                            value="{{ old('age', $member->age ?? '') }}" readonly>
                    </div>

                    <div class="field">
                        <label>رقم الجوال</label>
                        <input type="text" name="phone" maxlength="10" minlength="10" pattern="05[0-9]{8}"
                            inputmode="numeric" placeholder="05xxxxxxxx"
                            value="{{ old('phone', $member->phone ?? '05') }}">
                    </div>

                    <div class="field">
                        <label>رقم جوال احتياطي</label>
                        <input type="text" name="backup_phone" maxlength="10" minlength="10" pattern="05[0-9]{8}"
                            inputmode="numeric" placeholder="05xxxxxxxx"
                            value="{{ old('backup_phone', $member->backup_phone ?? '05') }}">
                    </div>

                    <div class="field">
                        <label>الجنس</label>
                        <select name="gender" id="gender" required onchange="updateMaritalStatus()">
                            <option value="">اختر الجنس</option>

                            <option value="male" {{ old('gender', $member->gender ?? '') == 'male' ? 'selected' : '' }}>
                                ذكر
                            </option>

                            <option value="female"
                                {{ old('gender', $member->gender ?? '') == 'female' ? 'selected' : '' }}>
                                أنثى
                            </option>
                        </select>
                    </div>

                    <div class="field">
                        <label>الحالة الاجتماعية</label>
                        <select name="marital_status" id="marital_status" required onchange="handleMaritalStatus()">
                            <option value="">اختر الحالة الاجتماعية</option>
                        </select>
                    </div>

                    <div class="field full">
                        <label>عدد أفراد الأسرة</label>
                        <input type="number" name="family_members_count" placeholder="أدخل عدد أفراد الأسرة"
                            value="{{ old('family_members_count', $member->family_members_count ?? '') }}" required>
                    </div>

                </div>

                <div id="wives-container">
                    @if(
                    isset($member) &&
                    $member->gender == 'male' &&
                    in_array($member->marital_status, ['married', 'polygamous']) &&
                    $member->wives
                    )
                    @foreach($member->wives as $index => $wife)
                    <div class="wife-box">
                        <h3>بيانات الزوجة</h3>

                        <div class="grid">

                            <div class="field">
                                <label>رقم هوية الزوجة</label>
                                <input type="text" name="wives[{{ $index }}][identity_number]" maxlength="9"
                                    minlength="9" pattern="[0-9]{9}" inputmode="numeric"
                                    value="{{ old('wives.' . $index . '.identity_number', $wife->identity_number) }}"
                                    placeholder="أدخل رقم هوية الزوجة - 9 أرقام">
                            </div>

                            <div class="field">
                                <label>اسم الزوجة</label>
                                <input type="text" name="wives[{{ $index }}][first_name]"
                                    value="{{ old('wives.' . $index . '.first_name', $wife->first_name) }}"
                                    placeholder="أدخل اسم الزوجة">
                            </div>

                            <div class="field">
                                <label>اسم الأب للزوجة</label>
                                <input type="text" name="wives[{{ $index }}][father_name]"
                                    value="{{ old('wives.' . $index . '.father_name', $wife->father_name) }}"
                                    placeholder="أدخل اسم الأب للزوجة">
                            </div>

                            <div class="field">
                                <label>اسم الجد للزوجة</label>
                                <input type="text" name="wives[{{ $index }}][grandfather_name]"
                                    value="{{ old('wives.' . $index . '.grandfather_name', $wife->grandfather_name) }}"
                                    placeholder="أدخل اسم الجد للزوجة">
                            </div>

                            <div class="field">
                                <label>اسم عائلة الزوجة</label>
                                <input type="text" name="wives[{{ $index }}][family_name]"
                                    value="{{ old('wives.' . $index . '.family_name', $wife->family_name) }}"
                                    placeholder="أدخل اسم عائلة الزوجة">
                            </div>

                            <div class="field">
                                <label>تاريخ ميلاد الزوجة</label>
                                <input type="date" name="wives[{{ $index }}][birth_date]"
                                    value="{{ old('wives.' . $index . '.birth_date', $wife->birth_date) }}"
                                    onchange="calculateWifeAge(this)">
                            </div>

                            <div class="field full">
                                <label>عمر الزوجة</label>
                                <input type="text" class="wife-age" placeholder="عمر الزوجة يظهر تلقائياً"
                                    value="{{ old('wives.' . $index . '.age', $wife->age) }}" readonly>
                            </div>

                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>

                <button type="button" id="add-wife-btn" class="add-wife-btn" onclick="addWife()" style="display:none;">
                    إضافة زوجة
                </button>

                <div class="actions">
                    <button type="submit" class="save-btn">حفظ الملف</button>

                    <a href="/family/dashboard" class="back-btn">
                        رجوع
                    </a>
                </div>
            </form>

        </div>

    </div>

    <script>
    let wifeIndex = Number('{{ isset($member) && $member->wives ? $member->wives->count() : 0 }}');
    let savedMaritalStatus = "{{ old('marital_status', $member->marital_status ?? '') }}";

    function calculateAgeFromDate(dateValue) {
        if (!dateValue) {
            return '';
        }

        let today = new Date();
        let birth = new Date(dateValue);

        let age = today.getFullYear() - birth.getFullYear();
        let month = today.getMonth() - birth.getMonth();

        if (month < 0 || (month === 0 && today.getDate() < birth.getDate())) {
            age--;
        }

        return age;
    }

    function calculateMainAge() {
        let birthDate = document.getElementById('birth_date').value;
        document.getElementById('age').value = calculateAgeFromDate(birthDate);
    }

    function calculateWifeAge(input) {
        let wifeBox = input.closest('.wife-box');
        let ageInput = wifeBox.querySelector('.wife-age');
        ageInput.value = calculateAgeFromDate(input.value);
    }

    function forcePrefix05(input) {
        let value = input.value.replace(/\D/g, '');

        if (!value.startsWith('05')) {
            value = '05' + value.replace(/^0+/, '').replace(/^5/, '');
        }

        input.value = value.slice(0, 10);
    }

    function numbersOnlyMax(input, maxLength) {
        input.value = input.value.replace(/\D/g, '').slice(0, maxLength);
    }

    function updateMaritalStatus() {
        let gender = document.getElementById('gender').value;
        let marital = document.getElementById('marital_status');
        let ownerLabel = document.getElementById('family-owner-label');

        marital.innerHTML = '<option value="">اختر الحالة الاجتماعية</option>';

        if (gender === 'female') {
            ownerLabel.innerText = 'اسم ربة الأسرة';

            marital.innerHTML += `
                <option value="widowed">أرملة</option>
                <option value="divorced">مطلقة</option>
            `;
        }

        if (gender === 'male') {
            ownerLabel.innerText = 'اسم رب الأسرة';

            marital.innerHTML += `
                <option value="single">أعزب</option>
                <option value="married">متزوج</option>
                <option value="widowed">أرمل</option>
                <option value="divorced">مطلق</option>
                <option value="polygamous">متعدد</option>
            `;
        }

        if (savedMaritalStatus) {
            marital.value = savedMaritalStatus;
        }

        handleMaritalStatus();
    }

    function addWife() {
        let container = document.getElementById('wives-container');

        container.innerHTML += `
            <div class="wife-box">
                <h3>بيانات الزوجة</h3>

                <div class="grid">

                    <div class="field">
                        <label>رقم هوية الزوجة</label>
                        <input type="text"
                            name="wives[${wifeIndex}][identity_number]"
                            maxlength="9"
                            minlength="9"
                            pattern="[0-9]{9}"
                            inputmode="numeric"
                            placeholder="أدخل رقم هوية الزوجة - 9 أرقام"
                            oninput="numbersOnlyMax(this, 9)">
                    </div>

                    <div class="field">
                        <label>اسم الزوجة</label>
                        <input type="text" name="wives[${wifeIndex}][first_name]" placeholder="أدخل اسم الزوجة">
                    </div>

                    <div class="field">
                        <label>اسم الأب للزوجة</label>
                        <input type="text" name="wives[${wifeIndex}][father_name]" placeholder="أدخل اسم الأب للزوجة">
                    </div>

                    <div class="field">
                        <label>اسم الجد للزوجة</label>
                        <input type="text" name="wives[${wifeIndex}][grandfather_name]" placeholder="أدخل اسم الجد للزوجة">
                    </div>

                    <div class="field">
                        <label>اسم عائلة الزوجة</label>
                        <input type="text" name="wives[${wifeIndex}][family_name]" placeholder="أدخل اسم عائلة الزوجة">
                    </div>

                    <div class="field">
                        <label>تاريخ ميلاد الزوجة</label>
                        <input type="date" name="wives[${wifeIndex}][birth_date]" onchange="calculateWifeAge(this)">
                    </div>

                    <div class="field full">
                        <label>عمر الزوجة</label>
                        <input type="text" class="wife-age" placeholder="عمر الزوجة يظهر تلقائياً" readonly>
                    </div>

                </div>
            </div>
        `;

        wifeIndex++;
    }

    function handleMaritalStatus() {
        let gender = document.getElementById('gender').value;
        let status = document.getElementById('marital_status').value;
        let btn = document.getElementById('add-wife-btn');
        let container = document.getElementById('wives-container');

        if (gender === 'male' && status === 'married') {
            btn.style.display = 'none';

            if (container.children.length === 0) {
                addWife();
            }

            while (container.children.length > 1) {
                container.removeChild(container.lastElementChild);
                wifeIndex--;
            }

        } else if (gender === 'male' && status === 'polygamous') {
            btn.style.display = 'inline-block';

            if (container.children.length === 0) {
                addWife();
            }

        } else {
            btn.style.display = 'none';
            container.innerHTML = '';
            wifeIndex = 0;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateMaritalStatus();
        calculateMainAge();

        document.getElementById('gender').addEventListener('change', function() {
            savedMaritalStatus = '';
            updateMaritalStatus();
        });

        document.getElementById('marital_status').addEventListener('change', function() {
            savedMaritalStatus = this.value;
            handleMaritalStatus();
        });

        document.querySelectorAll('input[name="identity_number"]').forEach(function(input) {
            input.addEventListener('input', function() {
                numbersOnlyMax(this, 9);
            });
        });

        document.querySelectorAll('input[name$="[identity_number]"]').forEach(function(input) {
            input.addEventListener('input', function() {
                numbersOnlyMax(this, 9);
            });
        });

        document.querySelectorAll('input[name="phone"], input[name="backup_phone"]').forEach(function(input) {
            input.addEventListener('input', function() {
                forcePrefix05(this);
            });

            if (!input.value) {
                input.value = '05';
            }
        });

        document.querySelectorAll('.wife-box input[type="date"]').forEach(function(input) {
            calculateWifeAge(input);
        });
    });
    </script>

</body>

</html>
