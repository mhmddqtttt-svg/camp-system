<?php

namespace App\Http\Controllers;

use App\Models\CampMember;
use App\Models\Wife;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CampMemberController extends Controller
{
    public function create()
    {
        $member = CampMember::with('wives')
            ->where('user_id', auth()->id())
            ->first();

        return view('family.camp-member-form', compact('member'));
    }

    public function store(Request $request)
    {
        $currentMember = CampMember::where('user_id', auth()->id())->first();

        $existingIdentityOwner = CampMember::where('identity_number', $request->identity_number)
            ->first();

        if (
            $existingIdentityOwner &&
            (!$currentMember || $existingIdentityOwner->id != $currentMember->id)
        ) {
            $ownerName = $existingIdentityOwner->first_name . ' ' .
                         $existingIdentityOwner->father_name . ' ' .
                         $existingIdentityOwner->grandfather_name . ' ' .
                         $existingIdentityOwner->family_name;

            return back()
                ->withErrors([
                    'identity_number' => 'رقم الهوية مسجل باسم: ' . $ownerName . '، رقم الجوال: ' . ($existingIdentityOwner->phone ?? 'غير مسجل')
                ])
                ->withInput();
        }

        $request->validate([
            'first_name' => 'required',
            'father_name' => 'required',
            'grandfather_name' => 'required',
            'family_name' => 'required',
            'gender' => 'required',

            'identity_number' => ['required', 'digits:9'],

            'phone' => ['nullable', 'regex:/^05[0-9]{8}$/'],
            'backup_phone' => ['nullable', 'regex:/^05[0-9]{8}$/'],

            'birth_date' => ['nullable', 'date'],

            'marital_status' => 'required',
            'family_members_count' => 'required|integer|min:1',

            'wives.*.first_name' => 'nullable',
            'wives.*.father_name' => 'nullable',
            'wives.*.grandfather_name' => 'nullable',
            'wives.*.family_name' => 'nullable',
            'wives.*.birth_date' => ['nullable', 'date'],
            'wives.*.identity_number' => ['nullable', 'digits:9'],
        ], [
            'required' => 'هذا الحقل مطلوب',

            'identity_number.digits' => 'رقم الهوية يجب أن يكون 9 أرقام',

            'phone.regex' => 'رقم الجوال يجب أن يبدأ بـ 05 ويتكون من 10 أرقام',
            'backup_phone.regex' => 'رقم الجوال الاحتياطي يجب أن يبدأ بـ 05 ويتكون من 10 أرقام',

            'birth_date.date' => 'تاريخ الميلاد غير صحيح',

            'family_members_count.integer' => 'عدد أفراد الأسرة يجب أن يكون رقماً',
            'family_members_count.min' => 'عدد أفراد الأسرة يجب أن يكون 1 أو أكثر',

            'wives.*.birth_date.date' => 'تاريخ ميلاد الزوجة غير صحيح',
            'wives.*.identity_number.digits' => 'رقم هوية الزوجة يجب أن يكون 9 أرقام',
        ]);

        if ($request->wives) {
            foreach ($request->wives as $wife) {
                if (
                    !empty($wife['identity_number']) &&
                    $wife['identity_number'] == $request->identity_number
                ) {
                    return back()
                        ->withErrors([
                            'wives' => 'رقم هوية الزوجة لا يجوز أن يكون نفس رقم هوية رب الأسرة'
                        ])
                        ->withInput();
                }
            }
        }

        $memberAge = $request->birth_date
            ? Carbon::parse($request->birth_date)->age
            : null;

        $member = CampMember::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'camp_id' => auth()->user()->camp_id,

                'first_name' => $request->first_name,
                'father_name' => $request->father_name,
                'grandfather_name' => $request->grandfather_name,
                'family_name' => $request->family_name,


                'identity_number' => $request->identity_number,

                'phone' => $request->phone,
                'backup_phone' => $request->backup_phone,

                'birth_date' => $request->birth_date,
                'age' => $memberAge,
                'gender' => $request->gender,
                'marital_status' => $request->marital_status,
                'family_members_count' => $request->family_members_count,
            ]
        );

        if (in_array($request->marital_status, ['widowed', 'divorced', 'single'])) {
            $member->wives()->delete();
        }

        if (in_array($request->marital_status, ['married', 'polygamous'])) {
            $member->wives()->delete();

            if ($request->wives) {
                foreach ($request->wives as $wife) {
                    if (!empty($wife['identity_number']) || !empty($wife['first_name'])) {
                        Wife::create([
                            'camp_member_id' => $member->id,

                            'first_name' => $wife['first_name'] ?? null,
                            'father_name' => $wife['father_name'] ?? null,
                            'grandfather_name' => $wife['grandfather_name'] ?? null,
                            'family_name' => $wife['family_name'] ?? null,

                            'identity_number' => $wife['identity_number'] ?? null,

                            'birth_date' => $wife['birth_date'] ?? null,
                            'age' => !empty($wife['birth_date'])
                                ? Carbon::parse($wife['birth_date'])->age
                                : null,
                        ]);
                    }
                }
            }
        }

        return redirect('/family/profile')->with('success', 'تم حفظ الملف الأساسي بنجاح');
    }
}