<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CampTransferRequest;
use Illuminate\Http\Request;

class CampTransferController extends Controller
{
    public function create()
    {
        $user = auth()->user();

        $delegates = User::with('camp')
            ->where('role', 'delegate')
            ->whereNotNull('camp_id')
            ->where('camp_id', '!=', $user->camp_id)
            ->get();

        return view('family.transfer-request', compact('delegates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'to_delegate_id' => 'required|exists:users,id',
            'reason' => 'nullable|max:1000',
        ], [
            'to_delegate_id.required' => 'يجب اختيار المخيم والمندوب',
            'to_delegate_id.exists' => 'المندوب غير موجود',
            'reason.max' => 'سبب النقل طويل جداً',
        ]);

        $delegate = User::where('role', 'delegate')
            ->where('id', $request->to_delegate_id)
            ->whereNotNull('camp_id')
            ->firstOrFail();

        if ($delegate->camp_id == auth()->user()->camp_id) {
            return back()
                ->withErrors([
                    'to_delegate_id' => 'أنت موجود بالفعل داخل هذا المخيم'
                ])
                ->withInput();
        }

        $existingRequest = CampTransferRequest::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->first();

        if ($existingRequest) {
            return back()
                ->withErrors([
                    'to_delegate_id' => 'لديك طلب نقل قيد المراجعة بالفعل'
                ])
                ->withInput();
        }

        CampTransferRequest::create([
            'user_id' => auth()->id(),
            'from_camp_id' => auth()->user()->camp_id,
            'to_camp_id' => $delegate->camp_id,
            'to_delegate_id' => $delegate->id,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return back()->with(
            'success',
            'تم إرسال طلب النقل للمندوب بنجاح'
        );
    }
}
