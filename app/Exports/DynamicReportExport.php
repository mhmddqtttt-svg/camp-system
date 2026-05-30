<?php

namespace App\Exports;

use App\Models\DynamicReport;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class DynamicReportExport implements FromArray, ShouldAutoSize, WithEvents
{
    protected $report;
    protected $delegate;

    public function __construct(DynamicReport $report)
    {
        $this->report = $report->load('fields', 'responses.user');
        $this->delegate = auth()->user();
    }

    public function array(): array
    {
        $rows = [];

        $fieldCount = $this->report->fields->count() + 2;

        $rows[] = [$this->report->title];
        $rows[] = [''];

        $rows[] = ['بيانات مركز الإيواء'];
        $rows[] = ['اسم المخيم', $this->delegate->shelter_camp_name ?? ''];
        $rows[] = ['مدير مركز الإيواء', $this->delegate->shelter_manager ?? ''];
        $rows[] = ['رقم التواصل', $this->delegate->shelter_phone ?? ''];
        $rows[] = ['رقم التواصل البديل', $this->delegate->shelter_alt_phone ?? ''];
        $rows[] = ['عنوان مركز الإيواء', $this->delegate->shelter_address ?? ''];
        $rows[] = ['إحداثيات GPS', $this->delegate->shelter_gps ?? ''];

        $rows[] = [''];
        $rows[] = ['بيانات الكشف'];

        $headers = ['م', 'اسم المستفيد'];

        foreach ($this->report->fields as $field) {
            $headers[] = $field->label;
        }

        $headers[] = 'تاريخ الإرسال';

        $rows[] = $headers;

        $counter = 1;

        foreach ($this->report->responses as $response) {
            $row = [
                $counter,
                $response->user->name ?? 'غير معروف',
            ];

            foreach ($this->report->fields as $field) {
                $answer = $response->answers[$field->label] ?? '';

                if (is_array($answer)) {
                    $answer = 'تاريخ الميلاد: ' . ($answer['birth_date'] ?? '-') .
                        ' | العمر: ' . ($answer['age'] ?? '-');
                }

                $row[] = $answer;
            }

            $row[] = $response->created_at->format('Y-m-d H:i');

            $rows[] = $row;

            $counter++;
        }

        return $rows;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                $sheet->setRightToLeft(true);

                $lastColumn = $sheet->getHighestColumn();
                $lastRow = $sheet->getHighestRow();

                $sheet->mergeCells("A1:{$lastColumn}1");
                $sheet->mergeCells("A3:{$lastColumn}3");
                $sheet->mergeCells("A11:{$lastColumn}11");

                $sheet->getStyle("A1:{$lastColumn}1")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 22,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => 'solid',
                        'color' => ['rgb' => '006B35'],
                    ],
                    'alignment' => [
                        'horizontal' => 'center',
                        'vertical' => 'center',
                    ],
                ]);

                $sheet->getStyle("A3:{$lastColumn}3")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                        'color' => ['rgb' => '006B35'],
                    ],
                    'fill' => [
                        'fillType' => 'solid',
                        'color' => ['rgb' => 'D9EADF'],
                    ],
                    'alignment' => ['horizontal' => 'center'],
                ]);

                $sheet->getStyle("A4:A9")->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => [
                        'fillType' => 'solid',
                        'color' => ['rgb' => 'E9F7EF'],
                    ],
                ]);

                $sheet->getStyle("A11:{$lastColumn}11")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                        'color' => ['rgb' => '006B35'],
                    ],
                    'fill' => [
                        'fillType' => 'solid',
                        'color' => ['rgb' => 'D9EADF'],
                    ],
                    'alignment' => ['horizontal' => 'center'],
                ]);

                $sheet->getStyle("A12:{$lastColumn}12")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => 'solid',
                        'color' => ['rgb' => '006B35'],
                    ],
                    'alignment' => [
                        'horizontal' => 'center',
                        'vertical' => 'center',
                    ],
                ]);

                $sheet->getStyle("A1:{$lastColumn}{$lastRow}")->applyFromArray([
                    'alignment' => [
                        'horizontal' => 'center',
                        'vertical' => 'center',
                        'wrapText' => true,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => 'thin',
                            'color' => ['rgb' => '333333'],
                        ],
                    ],
                ]);

                $sheet->getRowDimension(1)->setRowHeight(35);
                $sheet->getRowDimension(3)->setRowHeight(28);
                $sheet->getRowDimension(11)->setRowHeight(28);
                $sheet->getRowDimension(12)->setRowHeight(32);

                for ($row = 13; $row <= $lastRow; $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(40);
                }
            },
        ];
    }
}
