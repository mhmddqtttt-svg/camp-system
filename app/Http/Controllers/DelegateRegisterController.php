<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DelegateRegisterController extends Controller
{
    public function create()
    {
        $camps = Camp::all();

        return view('delegate-register.create', compact('camps'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required',
        'password' => 'required|min:6',
        'camp_name' => 'required',
        ]);
     $camp = Camp::firstOrCreate(
    [
        'name' => $request->camp_name,
    ],
    [
        'governorate' => 'غير محدد',
        'description' => 'تم إنشاؤه من طلب مندوب',
    ]
);
        User::create([
             'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => Hash::make($request->password),
        'camp_id' => $camp->id,
        'role' => 'delegate',
        'status' => 'pending',
        ]);

       return redirect('/login')->with('status', 'تم إرسال طلب المندوب، بانتظار موافقة المسؤول');
}
}
