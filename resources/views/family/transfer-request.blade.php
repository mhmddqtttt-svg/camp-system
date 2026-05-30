<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلب نقل مخيم</title>

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
        max-width: 850px;
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
        font-size: 40px;
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

    .field {
        margin-bottom: 24px
    }

    label {
        display: block;
        margin-bottom: 12px;
        color: #065f46;
        font-weight: bold;
        font-size: 18px;
    }

    .custom-select-title {
        width: 100%;
        padding: 18px;
        border: 2px solid #198754;
        border-radius: 22px;
        background: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        font-size: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .05);
    }

    .delegate-list {
        display: none;
        border: 2px solid #198754;
        border-top: none;
        border-radius: 0 0 22px 22px;
        overflow: hidden;
        background: white;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .05);
    }

    .delegate-option {
        padding: 18px;
        cursor: pointer;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: .25s;
    }

    .delegate-option:last-child {
        border-bottom: none
    }

    .delegate-option:hover {
        background: #f0fdf4
    }

    .delegate-option.active {
        background: #ecfdf5;
        border-right: 5px solid #198754
    }

    .delegate-right {
        display: flex;
        align-items: center;
        gap: 15px
    }

    .circle {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        border: 2px solid #198754;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: .25s;
        background: white;
    }

    .delegate-option.active .circle {
        background: #198754;
        color: white
    }

    .delegate-info {
        line-height: 2;
        color: #0f172a;
        font-size: 16px;
    }

    .verify-badge {
        width: 28px;
        height: 28px;
        background: #1d9bf0;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 15px;
        flex-shrink: 0;
        box-shadow: 0 5px 15px rgba(29, 155, 240, .35);
    }

    textarea {
        width: 100%;
        border: 2px solid #d1d5db;
        border-radius: 18px;
        padding: 16px;
        font-size: 16px;
        outline: none;
        transition: .25s;
        background: white;
        min-height: 170px;
        resize: vertical;
        line-height: 2;
    }

    textarea:focus {
        border-color: #198754;
        box-shadow: 0 0 0 4px rgba(25, 135, 84, .12);
    }

    .buttons {
        display: flex;
        gap: 14px;
        margin-top: 25px
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
        max-width: 160px;
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

        .delegate-option {
            padding: 15px
        }

        .delegate-info {
            font-size: 14px
        }

        .buttons {
            flex-direction: column
        }

        .back-btn {
            max-width: 100%
        }
    }
    </style>
</head>

<body>

    <div class="page">

        <div class="hero">
            <h1>طلب نقل مخيم</h1>
            <p>اختر المخيم المطلوب النقل إليه ثم اكتب سبب النقل وسيتم إرسال الطلب للمراجعة.</p>
        </div>

        <div class="card">

            @if(session('success'))
            <div style="background:#d1e7dd;color:#0f5132;padding:15px;border-radius:15px;margin-bottom:20px;">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div style="background:#fee2e2;color:#991b1b;padding:15px;border-radius:15px;margin-bottom:20px;">
                @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
                @endforeach
            </div>
            @endif

            <form method="POST" action="/family/transfer-request">
                @csrf

                <input type="hidden" name="to_delegate_id" id="to_delegate_id" required>

                <div class="field">
                    <label>المخيم المطلوب النقل إليه</label>

                    <div class="custom-select-title" onclick="toggleDelegates()">
                        <span id="selected-text">اختر المخيم المطلوب النقل إليه</span>
                        <span>⌄</span>
                    </div>

                    <div class="delegate-list" id="delegate-list">
                        @foreach($delegates as $delegate)
                        <div class="delegate-option" onclick="selectDelegate('{{ $delegate->id }}', this)">

                            <div class="delegate-right">
                                <div class="circle">✓</div>

                                <div class="delegate-info">
                                    {{ $delegate->camp?->name ?? 'مخيم غير معروف' }}
                                    <br>
                                    المندوب: {{ $delegate->name }}
                                </div>
                            </div>

                            @if($delegate->is_verified_delegate)
                            <div class="verify-badge">✓</div>
                            @endif

                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="field">
                    <label>سبب النقل</label>

                    <textarea name="reason" placeholder="اكتب سبب طلب النقل بشكل واضح ومفصل..."
                        required>{{ old('reason') }}</textarea>
                </div>

                <div class="buttons">
                    <button type="submit" class="btn submit-btn">إرسال طلب النقل</button>

                    <a href="/family/dashboard" class="btn back-btn">رجوع</a>
                </div>
            </form>
        </div>
    </div>

    <script>
    function toggleDelegates() {
        let list = document.getElementById('delegate-list');
        list.style.display = list.style.display === 'block' ? 'none' : 'block';
    }

    function selectDelegate(id, element) {
        document.getElementById('to_delegate_id').value = id;

        document.querySelectorAll('.delegate-option').forEach(function(item) {
            item.classList.remove('active');
        });

        element.classList.add('active');

        document.getElementById('selected-text').innerText =
            element.querySelector('.delegate-info').innerText.replace(/\s+/g, ' ');

        document.getElementById('delegate-list').style.display = 'none';
    }
    </script>

</body>

</html>
