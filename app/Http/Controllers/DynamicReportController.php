<?php

namespace App\Http\Controllers;

use App\Models\DynamicReport;
use App\Models\DynamicReportResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DynamicReportExport;

class DynamicReportController extends Controller
{
    public function index()
    {
        $this->closeExpiredReports();

        $reports = DynamicReport::withCount('responses')
            ->latest()
            ->get();

        return view('delegate.dynamic-reports.index', compact('reports'));
    }

    public function create()
    {
        return view('delegate.dynamic-reports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'fields' => 'required|array|min:1',
            'fields.*.label' => 'required|string|max:255',
            'fields.*.type' => 'required|string',
            'fields.*.min_age' => 'nullable|integer|min:0',
            'fields.*.max_age' => 'nullable|integer|min:0',
        ]);

        $report = DynamicReport::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_open' => true,
        ]);

        foreach ($request->fields as $field) {
            $report->fields()->create([
                'label' => $field['label'],
                'type' => $field['type'],
                'min_age' => $field['min_age'] ?? null,
                'max_age' => $field['max_age'] ?? null,
            ]);
        }

        return redirect('/delegate/dynamic-reports')
            ->with('success', 'تم إنشاء الكشف بنجاح');
    }

    public function editTime(DynamicReport $report)
    {
        return view('delegate.dynamic-reports.edit-time', compact('report'));
    }

    public function updateTime(Request $request, DynamicReport $report)
    {
        $request->validate([
            'duration_minutes' => 'required|integer|min:1',
        ]);

        $report->update([
            'duration_minutes' => $request->duration_minutes,
            'opened_at' => now(),
            'is_open' => true,
        ]);

        return redirect('/delegate/dynamic-reports')
            ->with('success', 'تم تحديث وقت الكشف بنجاح');
    }

    public function toggle(DynamicReport $report)
    {
        if ($report->is_open) {
            $report->update([
                'is_open' => false,
            ]);
        } else {
            $report->update([
                'is_open' => true,
                'opened_at' => now(),
            ]);
        }

        return back()->with('success', 'تم تحديث حالة الكشف');
    }

    public function show(DynamicReport $report)
    {
        $this->closeExpiredReports();

        $report->refresh();

        $report->load('fields', 'responses.user');

        return view('delegate.dynamic-reports.show', compact('report'));
    }

 public function familyIndex()
{
    $this->closeExpiredReports();

    $reports = DynamicReport::where('is_open', true)
        ->latest()
        ->get()
        ->filter(function ($report) {
            return !$this->isReportExpired($report);
        });

    return view('family.dynamic-reports.index', compact('reports'));
}

    public function fill(DynamicReport $report)
    {
        $this->closeExpiredReports();

        $report->refresh();

        if (!$report->is_open || $this->isReportExpired($report)) {
            $report->update([
                'is_open' => false,
            ]);

            return redirect('/family/dynamic-reports')
                ->with('error', 'انتهى وقت التسجيل لهذا الكشف');
        }

        $report->load('fields');

        return view('family.dynamic-reports.fill', compact('report'));
    }

    public function submit(Request $request, DynamicReport $report)
    {
        $this->closeExpiredReports();

        $report->refresh();

        if (!$report->is_open || $this->isReportExpired($report)) {
            $report->update([
                'is_open' => false,
            ]);

            return redirect('/family/dynamic-reports')
                ->with('error', 'انتهى وقت التسجيل لهذا الكشف');
        }

        $report->load('fields');

        $answers = [];

        foreach ($report->fields as $field) {
            $value = $request->input('answers.' . $field->id);

            if (!$value) {
                return back()->with('error', 'يرجى تعبئة جميع الحقول');
            }

            if ($field->type == 'date') {
                $age = Carbon::parse($value)->age;

                if ($field->min_age !== null && $age < $field->min_age) {
                    return back()->with('error', 'العمر غير مسموح لهذا الكشف');
                }

                if ($field->max_age !== null && $age > $field->max_age) {
                    return back()->with('error', 'العمر غير مسموح لهذا الكشف');
                }

                $answers[$field->label] = [
                    'birth_date' => $value,
                    'age' => $age,
                ];
            } else {
                $answers[$field->label] = $value;
            }
        }

        DynamicReportResponse::create([
            'dynamic_report_id' => $report->id,
            'user_id' => auth()->id(),
            'answers' => $answers,
        ]);

        return redirect('/family/dynamic-reports')
            ->with('success', 'تم إرسال الكشف بنجاح');
    }

    private function isReportExpired(DynamicReport $report): bool
    {
        if (!$report->duration_minutes || !$report->opened_at) {
            return false;
        }

        $endTime = Carbon::parse($report->opened_at)
            ->addMinutes($report->duration_minutes);

        return now()->greaterThanOrEqualTo($endTime);
    }

    private function closeExpiredReports(): void
    {
        $reports = DynamicReport::where('is_open', true)
            ->whereNotNull('duration_minutes')
            ->whereNotNull('opened_at')
            ->get();

        foreach ($reports as $report) {
            if ($this->isReportExpired($report)) {
                $report->update([
                    'is_open' => false,
                ]);
            }
        }
    }
    public function exportExcel(DynamicReport $report)
{
    return Excel::download(
        new DynamicReportExport($report),
        $report->title . '.xlsx'
    );
}

public function exportPdf(DynamicReport $report)
{
    $report->load('responses.user');

    $pdf = Pdf::loadView(
        'delegate.dynamic-reports.pdf',
        compact('report')
    );

    return $pdf->download($report->title . '.pdf');
}

public function print(DynamicReport $report)
{
    $report->load('responses.user');

    return view(
        'delegate.dynamic-reports.print',
        compact('report')
    );
}
}
