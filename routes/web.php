<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FamilyRequestController;
use App\Http\Controllers\DelegateRegisterController;
use App\Http\Controllers\DelegateController;
use App\Http\Controllers\Admin\FamilyRequestController as AdminFamilyRequestController;
use App\Http\Controllers\Admin\DelegateController as AdminDelegateController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CampMemberController;
use App\Http\Controllers\CampTransferController;
use App\Http\Controllers\DynamicReportController;
use App\Http\Controllers\SocialLinkController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/family', 'family.index');
Route::view('/delegate', 'delegate.index');

/*
|--------------------------------------------------------------------------
| Public Family Routes
|--------------------------------------------------------------------------
*/
Route::get('/family-login', function () {
    return redirect('/login');
})->name('family.login');

Route::get('/family-register', [FamilyRequestController::class, 'create'])
    ->name('family.register');

Route::get('/family-request', [FamilyRequestController::class, 'create'])
    ->name('family-request.create');

Route::post('/family-request', [FamilyRequestController::class, 'store'])
    ->name('family-request.store');

/*
|--------------------------------------------------------------------------
| Public Delegate Routes
|--------------------------------------------------------------------------
*/
Route::get('/delegate-register', [DelegateRegisterController::class, 'create'])
    ->name('delegate.register');

Route::post('/delegate-register', [DelegateRegisterController::class, 'store'])
    ->name('delegate.register.store');

Route::get('/go-login', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
})->name('go.login');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    Route::get('/admin/family-requests', [AdminFamilyRequestController::class, 'index'])
        ->name('admin.family-requests.index');

    Route::get('/admin/family-requests/{id}/approve', [AdminFamilyRequestController::class, 'approve'])
        ->name('admin.family-requests.approve');

    Route::get('/admin/family-requests/{id}/reject', [AdminFamilyRequestController::class, 'reject'])
        ->name('admin.family-requests.reject');

    Route::get('/admin/delegates', [AdminDelegateController::class, 'index']);
    Route::get('/admin/delegates/{id}/approve', [AdminDelegateController::class, 'approve']);
    Route::get('/admin/delegates/{id}/reject', [AdminDelegateController::class, 'reject']);
    Route::get('/admin/delegates/{id}/verify', [AdminDelegateController::class, 'verify']);
    Route::get('/admin/delegates/{id}/unverify', [AdminDelegateController::class, 'unverify']);

    Route::get('/admin/families-accounts', [DashboardController::class, 'familiesAccounts']);
    Route::get('/admin/delegates-accounts', [DashboardController::class, 'delegatesAccounts']);

    Route::get('/admin/social-links', [SocialLinkController::class, 'index'])
        ->name('admin.social-links.index');

    Route::post('/admin/social-links', [SocialLinkController::class, 'store'])
        ->name('admin.social-links.store');

    Route::put('/admin/social-links/{socialLink}', [SocialLinkController::class, 'update'])
        ->name('admin.social-links.update');

    Route::delete('/admin/social-links/{socialLink}', [SocialLinkController::class, 'destroy'])
        ->name('admin.social-links.destroy');
});

/*
|--------------------------------------------------------------------------
| Delegate Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:delegate'])->group(function () {
    Route::get('/delegate/dashboard', [DashboardController::class, 'delegate'])
        ->name('delegate.dashboard');

    Route::get('/delegate/families', [DelegateController::class, 'families']);
    Route::get('/delegate/families/export/excel', [DelegateController::class, 'exportFamiliesExcel']);
    Route::get('/delegate/families/export/pdf', [DelegateController::class, 'exportFamiliesPdf']);

    Route::get('/delegate/family-requests', [DelegateController::class, 'familyRequests']);

    Route::get('/delegate/reports', [DelegateController::class, 'reports']);
    Route::get('/delegate/reports/export/excel', [DelegateController::class, 'exportReportsExcel']);
    Route::get('/delegate/reports/export/pdf', [DelegateController::class, 'exportReportsPdf']);
    Route::get('/delegate/reports/print', [DelegateController::class, 'printReports']);

    Route::get('/delegate/families/{id}/report', [ReportController::class, 'create']);
    Route::post('/delegate/families/{id}/report', [ReportController::class, 'store']);

    Route::get('/delegate/families/{id}/profile', [DelegateController::class, 'createProfile']);
    Route::post('/delegate/families/{id}/profile', [DelegateController::class, 'storeProfile']);

    Route::get('/delegate/families/{id}/approve', [DelegateController::class, 'approveFamily']);
    Route::get('/delegate/families/{id}/reject', [DelegateController::class, 'rejectFamily']);

    Route::get('/delegate/transfer-requests', [DelegateController::class, 'transferRequests']);
    Route::get('/delegate/transfer-requests/{id}/approve', [DelegateController::class, 'approveTransfer']);
    Route::get('/delegate/transfer-requests/{id}/reject', [DelegateController::class, 'rejectTransfer']);
    Route::get('/delegate/transferred-families', [DelegateController::class, 'transferredFamilies']);

    Route::get('/delegate/dynamic-reports', [DynamicReportController::class, 'index'])
        ->name('delegate.dynamic-reports.index');

    Route::get('/delegate/dynamic-reports/create', [DynamicReportController::class, 'create'])
        ->name('delegate.dynamic-reports.create');

    Route::post('/delegate/dynamic-reports', [DynamicReportController::class, 'store'])
        ->name('delegate.dynamic-reports.store');

    Route::get('/delegate/dynamic-reports/{report}/edit-time', [DynamicReportController::class, 'editTime'])
        ->name('delegate.dynamic-reports.edit-time');

    Route::put('/delegate/dynamic-reports/{report}/update-time', [DynamicReportController::class, 'updateTime'])
        ->name('delegate.dynamic-reports.update-time');

    Route::get('/delegate/dynamic-reports/{report}/toggle', [DynamicReportController::class, 'toggle'])
        ->name('delegate.dynamic-reports.toggle');

    Route::get('/delegate/dynamic-reports/{report}', [DynamicReportController::class, 'show'])
        ->name('delegate.dynamic-reports.show');

    Route::get('/delegate/dynamic-reports/{report}/excel', [DynamicReportController::class, 'exportExcel']);
    Route::get('/delegate/dynamic-reports/{report}/pdf', [DynamicReportController::class, 'exportPdf']);
    Route::get('/delegate/dynamic-reports/{report}/print', [DynamicReportController::class, 'print']);

    Route::get('/delegate/whatsapp-group', function () {
        return view('delegate.whatsapp-group');
    })->name('delegate.whatsapp-group');

    Route::post('/delegate/whatsapp-group', [DelegateController::class, 'updateWhatsappGroup'])
        ->name('delegate.whatsapp-group.update');

    Route::get('/delegate/shelter-info', [DelegateController::class, 'shelterInfo']);
    Route::post('/delegate/shelter-info', [DelegateController::class, 'updateShelterInfo']);
});

/*
|--------------------------------------------------------------------------
| Family Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:family'])->group(function () {
    Route::get('/family/dashboard', [DashboardController::class, 'family'])
        ->name('family.dashboard');

    Route::get('/family/profile', [CampMemberController::class, 'create']);
    Route::post('/family/profile', [CampMemberController::class, 'store']);

    Route::get('/family/transfer-request', [CampTransferController::class, 'create']);
    Route::post('/family/transfer-request', [CampTransferController::class, 'store']);

    Route::get('/family/dynamic-reports', [DynamicReportController::class, 'familyIndex'])
        ->name('family.dynamic-reports.index');

    Route::get('/family/dynamic-reports/{report}/fill', [DynamicReportController::class, 'fill'])
        ->name('family.dynamic-reports.fill');

    Route::post('/family/dynamic-reports/{report}/submit', [DynamicReportController::class, 'submit'])
        ->name('family.dynamic-reports.submit');
});

require __DIR__.'/auth.php';
