<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $links = SocialLink::latest()->get();

        return view('admin.social-links.index', compact('links'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'target' => 'required|in:all,delegate,family',
        ]);

        SocialLink::create([
            'name' => $request->name,
            'url' => $request->url,
            'target' => $request->target,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'تم إضافة الرابط بنجاح');
    }

    public function update(Request $request, SocialLink $socialLink)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
            'target' => 'required|in:all,delegate,family',
        ]);

        $socialLink->update([
            'name' => $request->name,
            'url' => $request->url,
            'target' => $request->target,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'تم تعديل الرابط بنجاح');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();

        return back()->with('success', 'تم حذف الرابط بنجاح');
    }
}
