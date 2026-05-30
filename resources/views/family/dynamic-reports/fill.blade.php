<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $report->title }}</title>

    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Tahoma, Arial, sans-serif
    }

    body {
        min-height: 100vh;
        background: radial-gradient(circle at top right, rgba(25, 135, 84, .15), transparent 30%), linear-gradient(135deg, #f5f7f8, #eef7f1);
        padding: 25px 12px;
        color: #0f172a;
    }

    .page {
        max-width: 900px;
        margin: auto
    }

    .hero {
        background: linear-gradient(135deg, #065f46, #198754);
        border-radius: 30px;
        padding: 35px;
        color: white;
        margin-bottom: 25px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(25, 135, 84, .25);
    }

    .hero::before {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        background: rgba(255, 255, 255, .12);
        border-radius: 50%;
        top: -90px;
        right: -70px;
    }

    .hero h1 {
        font-size: 38px;
        margin-bottom: 12px;
        position: relative;
        z-index: 2
    }

    .hero p {
        color: #dcfce7;
        line-height: 2;
        position: relative;
        z-index: 2
    }

    .card {
        background: white;
        border-radius: 30px;
        padding: 35px;
        box-shadow: 0 18px 45px rgba(15, 23, 42, .08);
        border: 1px solid #e5e7eb;
    }

    .error {
        background: #fee2e2;
        color: #991b1b;
        padding: 15px;
        border-radius: 16px;
        margin-bottom: 20px;
        border: 1px solid #fecaca;
    }

    .timer {
        background: #fff7ed;
        color: #9a3412;
        padding: 16px;
        border-radius: 18px;
        margin-bottom: 25px;
        font-weight: bold;
        text-align: center;
        border: 1px solid #fed7aa;
    }

    .field-box {
        background: #ffffff;
        border: 2px solid #e5e7eb;
        border-radius: 24px;
        padding: 22px;
        margin-bottom: 22px;
        transition: .25s;
    }

    .field-box:hover {
        border-color: #198754;
        box-shadow: 0 12px 30px rgba(25, 135, 84, .08);
    }

    label {
        display: block;
        margin-bottom: 12px;
        color: #065f46;
        font-weight: bold;
        font-size: 17px;
    }

    input,
    select {
        width: 100%;
        padding: 15px;
        border: 2px solid #d1d5db;
        border-radius: 16px;
        outline: none;
        font-size: 16px;
        transition: .25s;
        background: white;
    }

    input:focus,
    select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 4px rgba(25, 135, 84, .12);
    }

    .date-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .age-result {
        margin-top: 12px;
        color: #198754;
        font-weight: bold;
        background: #ecfdf5;
        padding: 10px 14px;
        border-radius: 14px;
        display: none;
    }

    .age-error {
        margin-top: 12px;
        color: #991b1b;
        font-weight: bold;
        background: #fef2f2;
        padding: 10px 14px;
        border-radius: 14px;
        display: none;
    }

    .actions {
        display: flex;
        gap: 14px;
        margin-top: 28px;
    }

    .btn {
        flex: 1;
        border: none;
        border-radius: 18px;
        padding: 16px;
        font-size: 17px;
        font-weight: bold;
        cursor: pointer;
        transition: .25s;
        text-decoration: none;
        text-align: center;
    }

    .btn:hover {
        transform: translateY(-3px)
    }

    .submit-btn {
        background: linear-gradient(135deg, #16a34a, #198754);
        color: white;
        box-shadow: 0 15px 30px rgba(25, 135, 84, .22);
    }

    .back-btn {
        background: linear-gradient(135deg, #64748b, #475569);
        color: white;
        max-width: 170px;
    }

    @media(max-width:700px) {
        .hero {
            padding: 25px 20px;
            border-radius: 24px
        }

        .hero h1 {
            font-size: 30px
        }

        .card {
            padding: 22px 15px;
            border-radius: 24px
        }

        .date-grid {
            grid-template-columns: 1fr
        }

        .actions {
            flex-direction: column
        }

        .back-btn {
            max-width: 100%
        }
    }
    </style>
</head>

<body>

    @php
    $endTime = null;

    if ($report->opened_at && $report->duration_minutes) {
    $endTime = \Carbon\Carbon::parse($report->opened_at)
    ->addMinutes($report->duration_minutes);
    }
    @endphp

    <div class="page">

        <div class="hero">
            <h1>{{ $report->title }}</h1>
            <p>{{ $report->description ?? 'قم بتعبئة بيانات الكشف المطلوبة بدقة ثم اضغط إرسال.' }}</p>
        </div>

        <div class="card">

            @if(session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
            @endif

            @if($endTime)
            <div class="timer">
                الوقت المتبقي:
                <span id="family-countdown" data-time="{{ $endTime->timestamp * 1000 }}"></span>
            </div>
            @endif

            <form method="POST" action="/family/dynamic-reports/{{ $report->id }}/submit" id="report-form">
                @csrf

                @foreach($report->fields as $field)

                <div class="field-box">

                    <label>{{ $field->label }}</label>

                    @if($field->type == 'text')

                    <input type="text" name="answers[{{ $field->id }}]" required>

                    @elseif($field->type == 'number')

                    <input type="number" name="answers[{{ $field->id }}]" required>

                    @elseif($field->type == 'date')

                    <div class="date-grid">

                        <select class="birth-year" data-min="{{ $field->min_age }}" data-max="{{ $field->max_age }}">
                            <option value="">السنة</option>

                            @for($y = date('Y'); $y >= 1950; $y--)
                            <option value="{{ $y }}">{{ $y }}</option>
                            @endfor
                        </select>

                        <select class="birth-month">
                            <option value="">الشهر</option>

                            @for($m = 1; $m <= 12; $m++) <option value="{{ $m }}">{{ $m }}</option>
                                @endfor
                        </select>

                        <select class="birth-day">
                            <option value="">اليوم</option>

                            @for($d = 1; $d <= 31; $d++) <option value="{{ $d }}">{{ $d }}</option>
                                @endfor
                        </select>

                    </div>

                    <input type="hidden" name="answers[{{ $field->id }}]" class="birth-hidden" required>

                    <div class="age-result"></div>
                    <div class="age-error"></div>

                    @endif

                </div>

                @endforeach

                <div class="actions">
                    <button type="submit" id="submit-btn" class="btn submit-btn">
                        إرسال الكشف
                    </button>

                    <a href="/family/dynamic-reports" class="btn back-btn">
                        رجوع
                    </a>
                </div>

            </form>

        </div>

    </div>

    <script>
    window.onload = function() {
        let familyCountdown = document.getElementById('family-countdown');

        if (familyCountdown) {
            let endTime = parseInt(familyCountdown.getAttribute('data-time'));

            function updateFamilyTimer() {
                let now = new Date().getTime();
                let distance = endTime - now;

                if (distance <= 0) {
                    familyCountdown.innerHTML = 'انتهى الوقت';

                    let submitBtn = document.getElementById('submit-btn');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.style.opacity = '0.5';
                    }

                    setTimeout(function() {
                        window.location.href = '/family/dynamic-reports';
                    }, 1500);

                    return;
                }

                let hours = Math.floor(distance / (1000 * 60 * 60));
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                familyCountdown.innerHTML =
                    hours + ' ساعة ' +
                    minutes + ' دقيقة ' +
                    seconds + ' ثانية';
            }

            updateFamilyTimer();
            setInterval(updateFamilyTimer, 1000);
        }

        function calculateAge(birthDate) {
            let today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            let month = today.getMonth() - birthDate.getMonth();

            if (month < 0 || (month === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            return age;
        }

        document.querySelectorAll('.birth-year').forEach(function(yearSelect) {
            function updateBirth() {
                let parent = yearSelect.parentElement;

                let year = parent.querySelector('.birth-year').value;
                let month = parent.querySelector('.birth-month').value;
                let day = parent.querySelector('.birth-day').value;

                let hiddenInput = parent.parentElement.querySelector('.birth-hidden');
                let resultBox = parent.parentElement.querySelector('.age-result');
                let errorBox = parent.parentElement.querySelector('.age-error');
                let submitBtn = document.getElementById('submit-btn');

                if (!year || !month || !day) {
                    hiddenInput.value = '';
                    resultBox.innerHTML = '';
                    resultBox.style.display = 'none';
                    errorBox.innerHTML = '';
                    errorBox.style.display = 'none';
                    return;
                }

                month = month.toString().padStart(2, '0');
                day = day.toString().padStart(2, '0');

                let fullDate = year + '-' + month + '-' + day;
                hiddenInput.value = fullDate;

                let birthDate = new Date(fullDate);
                let age = calculateAge(birthDate);

                let minAge = parseInt(yearSelect.dataset.min);
                let maxAge = parseInt(yearSelect.dataset.max);

                resultBox.innerHTML = 'العمر: ' + age + ' سنة';
                resultBox.style.display = 'block';

                errorBox.innerHTML = '';
                errorBox.style.display = 'none';

                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';

                if (!isNaN(minAge) && age < minAge) {
                    errorBox.innerHTML = 'العمر أقل من المسموح';
                    errorBox.style.display = 'block';
                    submitBtn.disabled = true;
                    submitBtn.style.opacity = '0.5';
                }

                if (!isNaN(maxAge) && age > maxAge) {
                    errorBox.innerHTML = 'العمر أكبر من المسموح';
                    errorBox.style.display = 'block';
                    submitBtn.disabled = true;
                    submitBtn.style.opacity = '0.5';
                }
            }

            let parent = yearSelect.parentElement;

            parent.querySelector('.birth-year').addEventListener('change', updateBirth);
            parent.querySelector('.birth-month').addEventListener('change', updateBirth);
            parent.querySelector('.birth-day').addEventListener('change', updateBirth);
        });
    };
    </script>

</body>

</html>
