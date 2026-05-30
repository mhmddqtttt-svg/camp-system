<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\FamilyRequest;
use App\Models\CampMember;
use Illuminate\Http\Request;

class FamilyRequestController extends Controller
{
    public function create()
{
    $camps = Camp::with('users')->get();

    $rejectedRequest = FamilyRequest::where('payment_status', 'rejected')
        ->latest()
        ->first();

    if ($rejectedRequest) {
        session()->flash(
            'error',
            'تم رفض الطلب بسبب وجود مشكلة في إشعار الدفع، الرجاء إعادة التسجيل بصورة صحيحة'
        );
    }

    return view('family-request.create', compact('camps'));
}

    public function store(Request $request)
    {
        $request->validate([

            'full_name' => 'required',

            'identity_number' => 'required|digits:9',

            'password' => 'required|min:6',

            'phone' => [
                'required',
                'regex:/^05[0-9]{8}$/'
            ],

            'email' => 'required|email|unique:family_requests,email',

            'camp_id' => 'required',

            'payment_image' => 'required|image|mimes:jpg,jpeg,png|max:4096',

        ], [

            'required' => 'هذا الحقل مطلوب',

            'identity_number.digits' => 'رقم الهوية يجب أن يكون 9 أرقام',

            'phone.regex' => 'رقم الجوال يجب أن يبدأ بـ 05 ويتكون من 10 أرقام',

            'email.unique' => 'البريد الإلكتروني مستخدم مسبقاً',

            'password.min' => 'كلمة المرور يجب أن تكون 6 أحرف على الأقل',

            'payment_image.required' => 'يجب رفع إشعار الدفع',

            'payment_image.image' => 'الملف يجب أن يكون صورة',

            'payment_image.mimes' => 'الصيغة المسموحة: jpg png jpeg',

        ]);

        $existingRequest = FamilyRequest::where('identity_number', $request->identity_number)
            ->first();

        if ($existingRequest) {

            return back()
                ->withErrors([
                    'identity_number' =>
                        'رقم الهوية مسجل مسبقاً باسم: ' .
                        $existingRequest->full_name .
                        '، رقم الجوال: ' .
                        ($existingRequest->phone ?? 'غير مسجل')
                ])
                ->withInput();
        }

        $existingMember = CampMember::where('identity_number', $request->identity_number)
            ->first();

        if ($existingMember) {

            $ownerName = $existingMember->first_name . ' ' .
                         $existingMember->father_name . ' ' .
                         $existingMember->family_name;

            return back()
                ->withErrors([
                    'identity_number' =>
                        'رقم الهوية مسجل مسبقاً باسم: ' .
                        $ownerName .
                        '، رقم الجوال: ' .
                        ($existingMember->phone ?? 'غير مسجل')
                ])
                ->withInput();
        }

        $paymentImage = null;

        if ($request->hasFile('payment_image')) {

            $paymentImage = $request
                ->file('payment_image')
                ->store('payments', 'public');
        }

        FamilyRequest::create([

            'status' => 'pending_admin',

            'payment_status' => 'pending',

            'amount' => 5,

            'payment_image' => $paymentImage,

            'full_name' => $request->full_name,

            'identity_number' => $request->identity_number,

            'password' => bcrypt($request->password),

            'phone' => $request->phone,

            'email' => $request->email,

            'camp_id' => $request->camp_id,
        ]);

        return redirect()
            ->back()
            ->with('success', 'تم إرسال الطلب وانتظار مراجعة الدفع من الإدارة');
    }
}