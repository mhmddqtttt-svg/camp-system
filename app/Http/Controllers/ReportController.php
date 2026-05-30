<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\FamilyRequest;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function create($familyId)
    {
        $family = FamilyRequest::findOrFail($familyId);

        return view('delegate.reports-create', compact('family'));
    }

    public function store(Request $request, $familyId)
    {
        $request->validate([
            'report' => 'required',
        ]);

        Report::create([
            'family_request_id' => $familyId,
            'delegate_id' => auth()->id(),
            'report' => $request->report,
            'status' => 'pending',
        ]);

        return redirect('/delegate/reports');
    }
}
