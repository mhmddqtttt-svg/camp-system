<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FamilyProfile;

class FamilyProfileController extends Controller
{
    public function create()
    {
        $member = FamilyProfile::where('user_id', auth()->id())->first();

        return view('family.profile', compact('member'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'identity_number' => 'required|unique:family_profiles,identity_number,' . auth()->id() . ',user_id',
            'first_name' => 'required',
            'father_name' => 'required',
            'grandfather_name' => 'required',
            'family_name' => 'required',
            'birth_date' => 'nullable|date',
            'phone' => 'nullable',
            'backup_phone' => 'nullable',
            'gender' => 'required',
            'marital_status' => 'required',
            'family_members_count' => 'required|integer',
            'wives.*.identity_number' => 'nullable',
        ]);

        $data['age'] = $request->birth_date
            ? now()->diffInYears($request->birth_date)
            : null;

        if ($data['gender'] == 'female') {
            if (!in_array($data['marital_status'], ['widowed', 'divorced'])) {
                return back()->with('error', 'الأنثى يمكن أن تكون فقط أرملة أو مطلقة')->withInput();
            }
        }

        if ($data['gender'] == 'male') {
            if (!in_array($data['marital_status'], ['single', 'married', 'widowed', 'divorced', 'polygamous'])) {
                return back()->with('error', 'الحالة الاجتماعية غير صحيحة')->withInput();
            }
        }

        $data['user_id'] = auth()->id();

        $familyRequest = \App\Models\FamilyRequest::where('email', auth()->user()->email)->first();

        $data['family_request_id'] = $familyRequest?->id;

        $member = FamilyProfile::updateOrCreate(
            ['user_id' => auth()->id()],
            $data
        );

        if (
            in_array($member->marital_status, ['widowed', 'divorced', 'single'])
            || $member->gender == 'female'
        ) {
            $member->wives()->delete();
        }

        if (
            $member->gender == 'male'
            && in_array($member->marital_status, ['married', 'polygamous'])
        ) {
            if ($request->has('wives')) {
                foreach ($request->wives as $wife) {
                    if (empty($wife['identity_number'])) {
                        continue;
                    }

                    $member->wives()->updateOrCreate(
                        [
                            'identity_number' => $wife['identity_number'],
                        ],
                        [
                            'first_name' => $wife['first_name'] ?? null,
                            'father_name' => $wife['father_name'] ?? null,
                            'grandfather_name' => $wife['grandfather_name'] ?? null,
                            'family_name' => $wife['family_name'] ?? null,
                            'birth_date' => $wife['birth_date'] ?? null,
                            'age' => !empty($wife['birth_date'])
                                ? now()->diffInYears($wife['birth_date'])
                                : null,
                        ]
                    );
                }
            }
        }

        return redirect('/family/dashboard')->with('success', 'تم حفظ الملف بنجاح');
    }
}
