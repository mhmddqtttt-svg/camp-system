<h1>الملف الأساسي</h1>

<form method="POST" action="/family/profile">
    @csrf

    <label>الجنس</label>
    <select name="gender" id="gender" required onchange="updateMaritalStatus()"
        style="width:100%;padding:12px;margin:10px 0 20px;">
        <option value="">اختر الجنس</option>
        <option value="male" {{ old('gender', $member->gender ?? '') == 'male' ? 'selected' : '' }}>ذكر</option>
        <option value="female" {{ old('gender', $member->gender ?? '') == 'female' ? 'selected' : '' }}>أنثى</option>
    </select>

    <label>الحالة الاجتماعية</label>
    <select name="marital_status" id="marital_status" required onchange="toggleWifeFields()"
        style="width:100%;padding:12px;margin:10px 0 20px;">
        <option value="">اختر الحالة الاجتماعية</option>
    </select>

    <div id="wife_fields" style="display:none;">
        <label>اسم الزوجة</label>
        <input type="text" name="wife_name" placeholder="اسم الزوجة"
            style="width:100%;padding:12px;margin:10px 0 20px;">
    </div>

    <button type="submit">حفظ</button>
</form>

<script>
let savedMaritalStatus = "{{ old('marital_status', $member->marital_status ?? '') }}";

function updateMaritalStatus() {
    let gender = document.getElementById('gender').value;
    let maritalStatus = document.getElementById('marital_status');

    maritalStatus.innerHTML = '<option value="">اختر الحالة الاجتماعية</option>';

    if (gender === 'female') {
        maritalStatus.innerHTML += `
            <option value="widowed">أرملة</option>
            <option value="divorced">مطلقة</option>
        `;
    }

    if (gender === 'male') {
        maritalStatus.innerHTML += `
            <option value="single">أعزب</option>
            <option value="married">متزوج</option>
            <option value="widowed">أرمل</option>
            <option value="divorced">مطلق</option>
            <option value="polygamous">متعدد</option>
        `;
    }

    if (savedMaritalStatus) {
        maritalStatus.value = savedMaritalStatus;
    }

    toggleWifeFields();
}

function toggleWifeFields() {
    let gender = document.getElementById('gender').value;
    let status = document.getElementById('marital_status').value;
    let wifeFields = document.getElementById('wife_fields');

    if (gender === 'male' && (status === 'married' || status === 'polygamous')) {
        wifeFields.style.display = 'block';
    } else {
        wifeFields.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    updateMaritalStatus();

    document.getElementById('gender').addEventListener('change', function() {
        savedMaritalStatus = '';
        updateMaritalStatus();
    });
});
</script>
