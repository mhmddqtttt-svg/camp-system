<?php

namespace App\Http\Controllers;

use App\Exports\FamiliesReportExport;
use App\Models\FamilyRequest;
use App\Models\FamilyProfile;
use App\Models\CampMember;
use App\Models\CampTransferRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;
use Maatwebsite\Excel\Facades\Excel;

class DelegateController extends Controller
{
    public function families()
    {
        $query = CampMember::with('user')
            ->where('camp_id', auth()->user()->camp_id);

        if (request('identity_number')) {
            $query->where('identity_number', 'like', '%' . request('identity_number') . '%');
        }

        $families = $query->latest()->get();

        $familiesCount = CampMember::where('camp_id', auth()->user()->camp_id)->count();

        if ($familiesCount >= 50) {
            $delegate = auth()->user();

            if (!$delegate->is_verified_delegate) {
                $delegate->is_verified_delegate = true;
                $delegate->save();
            }
        }

        return view('delegate.families', compact('families', 'familiesCount'));
    }

    public function familyRequests()
    {
        $requests = FamilyRequest::where('camp_id', auth()->user()->camp_id)
            ->where('status', 'pending_delegate')
            ->latest()
            ->get();

        return view('delegate.family-requests', compact('requests'));
    }

    public function transferRequests()
    {
        $requests = CampTransferRequest::with(['user', 'fromCamp', 'toCamp', 'delegate'])
            ->where('to_delegate_id', auth()->id())
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('delegate.transfer-requests', compact('requests'));
    }

    public function approveTransfer($id)
    {
        $transfer = CampTransferRequest::where('to_delegate_id', auth()->id())
            ->where('status', 'pending')
            ->findOrFail($id);

        $newCampId = $transfer->to_camp_id;
        $user = $transfer->user;

        $user->camp_id = $newCampId;
        $user->save();

        $campMember = CampMember::where('user_id', $transfer->user_id)->first();

        if ($campMember) {
            $campMember->camp_id = $newCampId;
            $campMember->save();
        }

        $transfer->status = 'approved';
        $transfer->save();

        return redirect()
            ->back()
            ->with('success', 'تم قبول النقل ونقل العائلة للمخيم الجديد');
    }

    public function rejectTransfer($id)
    {
        $transfer = CampTransferRequest::where('to_delegate_id', auth()->id())
            ->where('status', 'pending')
            ->findOrFail($id);

        $transfer->status = 'rejected';
        $transfer->save();

        return redirect()
            ->back()
            ->with('success', 'تم رفض طلب النقل');
    }

    public function transferredFamilies()
    {
        $requests = CampTransferRequest::with(['user', 'fromCamp', 'toCamp'])
            ->where('to_delegate_id', auth()->id())
            ->where('status', 'approved')
            ->latest()
            ->get();

        return view('delegate.transferred-families', compact('requests'));
    }

    public function reports()
    {
        $families = CampMember::with('wives')
            ->where('camp_id', auth()->user()->camp_id)
            ->latest()
            ->get();

        return view('delegate.reports', compact('families'));
    }

    public function exportReportsExcel()
    {
        return Excel::download(
            new FamiliesReportExport(auth()->user()),
            'families-report.xlsx'
        );
    }

    public function exportReportsPdf()
    {
        $families = CampMember::with('wives')
            ->where('camp_id', auth()->user()->camp_id)
            ->latest()
            ->get();

        $pdf = PDF::loadView('delegate.reports-print', compact('families'), [], [
            'format' => 'A4-L',
        ]);

        return $pdf->download('families-report.pdf');
    }

    public function printReports()
    {
        $families = CampMember::with('wives')
            ->where('camp_id', auth()->user()->camp_id)
            ->latest()
            ->get();

        return view('delegate.reports-print', compact('families'));
    }

    public function createProfile($id)
    {
        $family = FamilyRequest::findOrFail($id);

        return view('delegate.create-profile', compact('family'));
    }

    public function approveFamily($id)
    {
        $family = FamilyRequest::where('camp_id', auth()->user()->camp_id)
            ->findOrFail($id);

        $family->status = 'approved';
        $family->save();

        User::updateOrCreate(
            ['email' => $family->email],
            [
                'name' => $family->full_name,
                'password' => $family->password,
                'role' => 'family',
                'status' => 'active',
                'camp_id' => $family->camp_id,
            ]
        );

        return redirect()->back();
    }

    public function rejectFamily($id)
    {
        $family = FamilyRequest::where('camp_id', auth()->user()->camp_id)
            ->findOrFail($id);

        $family->status = 'rejected_delegate';
        $family->save();

        return redirect()->back();
    }

    public function storeProfile(Request $request, $id)
    {
        FamilyProfile::create([
            'family_request_id' => $id,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'wife_name' => $request->wife_name,
            'wife_identity_number' => $request->wife_identity_number,
            'total_family_members' => $request->total_family_members,
            'children_0_2_male' => $request->children_0_2_male,
            'children_0_2_female' => $request->children_0_2_female,
            'children_3_5_male' => $request->children_3_5_male,
            'children_3_5_female' => $request->children_3_5_female,
            'children_6_18_male' => $request->children_6_18_male,
            'children_6_18_female' => $request->children_6_18_female,
            'members_19_60_male' => $request->members_19_60_male,
            'members_19_60_female' => $request->members_19_60_female,
            'members_above_60_male' => $request->members_above_60_male,
            'members_above_60_female' => $request->members_above_60_female,
            'disabled_members' => $request->disabled_members,
            'chronic_disease_members' => $request->chronic_disease_members,
            'pregnant_or_nursing' => $request->pregnant_or_nursing,
            'current_address' => $request->current_address,
            'original_address' => $request->original_address,
            'governorate' => $request->governorate,
        ]);

        return redirect('/delegate/families');
    }

    public function updateWhatsappGroup(Request $request)
    {
        $request->validate([
            'whatsapp_group_link' => 'nullable|url',
        ]);

        auth()->user()->update([
            'whatsapp_group_link' => $request->whatsapp_group_link,
        ]);

        return back()->with('success', 'تم حفظ رابط مجموعة الواتساب');
    }

    public function shelterInfo()
    {
        return view('delegate.shelter-info');
    }

    public function updateShelterInfo(Request $request)
    {
        $request->validate([
            'shelter_camp_name' => 'required',
            'shelter_manager' => 'required',
            'shelter_phone' => 'required',
            'shelter_alt_phone' => 'nullable',
            'shelter_address' => 'required',
            'shelter_gps' => 'nullable',
        ]);

        auth()->user()->update([
            'shelter_camp_name' => $request->shelter_camp_name,
            'shelter_manager' => $request->shelter_manager,
            'shelter_phone' => $request->shelter_phone,
            'shelter_alt_phone' => $request->shelter_alt_phone,
            'shelter_address' => $request->shelter_address,
            'shelter_gps' => $request->shelter_gps,
        ]);

        return back()->with('success', 'تم حفظ بيانات مركز الإيواء');
    }

    public function exportFamiliesExcel()
    {
        return Excel::download(
            new FamiliesReportExport(request('identity_number')),
            'families-report.xlsx'
        );
    }

public function pdf($id)
{
    return redirect('/delegate/dynamic-reports/' . $id . '/print');
}

public function print($id)
{
    $report = \App\Models\DynamicReport::with(['fields', 'responses'])
        ->findOrFail($id);

    return view('delegate.dynamic-reports.print', compact('report'));
}
public function exportFamiliesPdf()
{
    $delegate = auth()->user();

    $query = CampMember::where('camp_id', $delegate->camp_id);

    if (request('identity_number')) {
        $query->where('identity_number', request('identity_number'));
    }

    $families = $query->latest()->get();

    $pdf = PDF::loadView('delegate.families-pdf', compact('families', 'delegate'), [], [
        'format' => 'A4-L',
    ]);

    return $pdf->download('families-report.pdf');
}
}