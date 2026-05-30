<?php

namespace App\Http\Controllers;

use App\Models\FamilyRequest;
use App\Models\User;
use App\Models\CampMember;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard');
    }

    public function delegate()
    {
        $familiesCount = User::where('role', 'family')
            ->where('camp_id', auth()->user()->camp_id)
            ->count();

        $approvedCount = User::where('role', 'family')
            ->where('camp_id', auth()->user()->camp_id)
            ->where('status', 'active')
            ->count();

        $pendingCount = FamilyRequest::where('camp_id', auth()->user()->camp_id)
            ->where('status', 'pending_delegate')
            ->count();

        return view('delegate.dashboard', compact(
            'familiesCount',
            'approvedCount',
            'pendingCount'
        ));
    }

    public function family()
    {
        return view('family.dashboard');
    }

    public function familiesAccounts()
    {
        $search = request('search');

        $families = CampMember::with(['user', 'camp', 'wives'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('identity_number', 'like', '%' . $search . '%')
                        ->orWhere('first_name', 'like', '%' . $search . '%')
                        ->orWhere('father_name', 'like', '%' . $search . '%')
                        ->orWhere('grandfather_name', 'like', '%' . $search . '%')
                        ->orWhere('family_name', 'like', '%' . $search . '%')
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('email', 'like', '%' . $search . '%')
                                ->orWhere('identity_number', 'like', '%' . $search . '%')
                                ->orWhere('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('wives', function ($wifeQuery) use ($search) {
                            $wifeQuery->where('identity_number', 'like', '%' . $search . '%')
                                ->orWhere('first_name', 'like', '%' . $search . '%')
                                ->orWhere('father_name', 'like', '%' . $search . '%')
                                ->orWhere('grandfather_name', 'like', '%' . $search . '%')
                                ->orWhere('family_name', 'like', '%' . $search . '%');
                        });
                });
            })
            ->orderBy('camp_id')
            ->latest()
            ->get()
            ->groupBy(function ($family) {
                return $family->camp?->name ?? 'بدون مخيم';
            });

        return view('admin.families-accounts', compact('families', 'search'));
    }

    public function delegatesAccounts()
    {
        $delegates = User::with('camp')
            ->where('role', 'delegate')
            ->latest()
            ->get();

        return view('admin.delegates-accounts', compact('delegates'));
    }
}
