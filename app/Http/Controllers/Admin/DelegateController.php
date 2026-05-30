<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class DelegateController extends Controller
{
    public function index()
    {
        $delegates = User::where('role', 'delegate')
            ->latest()
            ->get();

        return view('admin.delegates.index', compact('delegates'));
    }

    public function approve($id)
    {
        $delegate = User::findOrFail($id);

        $delegate->status = 'active';

        $delegate->save();

        return redirect()->back();
    }

    public function reject($id)
    {
        $delegate = User::findOrFail($id);

        $delegate->status = 'rejected';

        $delegate->save();

        return redirect()->back();
    }

    public function verify($id)
    {
        $delegate = User::findOrFail($id);

        $delegate->is_verified_delegate = true;

        $delegate->save();

        return redirect()->back()
            ->with('success', 'تم توثيق المندوب بنجاح');
    }

    public function unverify($id)
    {
        $delegate = User::findOrFail($id);

        $delegate->is_verified_delegate = false;

        $delegate->save();

        return redirect()->back()
            ->with('success', 'تم إزالة توثيق المندوب');
    }
}
