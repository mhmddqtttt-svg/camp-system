<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FamilyRequest;

class FamilyRequestController extends Controller
{
    public function index()
    {
        $requests = FamilyRequest::latest()->get();

        return view('admin.family-requests.index', compact('requests'));
    }

    public function approve($id)
    {
        $request = FamilyRequest::findOrFail($id);

        $request->payment_status = 'paid';
        $request->status = 'pending_delegate';

        $request->save();

        return redirect()->back();
    }

   public function reject($id)
{
    $request = FamilyRequest::findOrFail($id);

    $request->payment_status = 'rejected';

    $request->status = 'rejected_admin';

    $request->save();

    return redirect()
        ->back()
        ->with('success', 'تم رفض الطلب وإبلاغ العائلة');
}
}
