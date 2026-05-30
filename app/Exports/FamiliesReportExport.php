<?php

namespace App\Exports;

use App\Models\CampMember;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class FamiliesReportExport implements FromArray, ShouldAutoSize, WithEvents
{
    protected $delegate;
    protected $families;
    protected $identityNumber;

    public function __construct($identityNumber = null)
    {
        $this->delegate = auth()->user();
        $this->identityNumber = $identityNumber;

        $query = CampMember::with('wives')
            ->where('camp_id', $this->delegate->camp_id);

        if ($this->identityNumber) {
            $query->where('identity_number', 'like', '%' . $this->identityNumber . '%');
        }

        $this->families = $query->latest()->get();
    }

    public function array(): array
    {
        $data = [];

        $data[] = ['كشف العائلات', '', '', '', '', '', '', '', '', ''];
        $data[] = ['', '', '', '', '', '', '', '', '', ''];

        $data[] = ['بيانات مركز الإيواء', '', '', '', '', '', '', '', '', ''];
        $data[] = ['اسم المخيم', $this->delegate->shelter_camp_name ?? '', '', '', '', '', '', '', '', ''];
        $data[] = ['مدير مركز الإيواء', $this->delegate->shelter_manager ?? '', '', '', '', '', '', '', '', ''];
        $data[] = ['رقم التواصل', $this->delegate->shelter_phone ?? '', '', '', '', '', '', '', '', ''];
        $data[] = ['رقم التواصل البديل', $this->delegate->shelter_alt_phone ?? '', '', '', '', '', '', '', '', ''];
        $data[] = ['عنوان مركز الإيواء بالتفصيل', $this->delegate->shelter_address ?? '', '', '', '', '', '', '', '', ''];
        $data[] = ['إحداثيات GPS', $this->delegate->shelter_gps ?? '', '', '', '', '', '', '', '', ''];

        $data[] = ['', '', '', '', '', '', '', '', '', ''];
        $data[] = ['عدد العائلات', $this->families->count(), '', '', '', '', '', '', '', ''];
        $data[] = ['بيانات العائلات', '', '', '', '', '', '', '', '', ''];

        $data[] = [
            'م',
            'الاسم',
            'رقم الهوية',
            'الجنس',
            'العمر',
            'الجوال',
            'جوال احتياطي',
            'الحالة الاجتماعية',
            'عدد أفراد الأسرة',
            'الزوجات'
        ];

        $counter = 1;

        foreach ($this->families as $family) {
            $fullName = trim(
                ($family->first_name ?? '') . ' ' .
                ($family->father_name ?? '') . ' ' .
                ($family->grandfather_name ?? '') . ' ' .
                ($family->family_name ?? '')
            );

            $wives = '';

            foreach ($family->wives as $wife) {
                $wives .= trim(
                    ($wife->first_name ?? '') . ' ' .
                    ($wife->father_name ?? '') . ' ' .
                    ($wife->family_name ?? '')
                );

                $wives .= ' | هوية: ' . ($wife->identity_number ?? '-');
                $wives .= ' | عمر: ' . ($wife->age ?? '-');
                $wives .= "\n";
            }

            if ($wives == '') {
                $wives = 'لا يوجد';
            }

            $gender = $family->gender === 'female' ? 'أنثى' : 'ذكر';

            $statuses = [
                'single' => $family->gender === 'female' ? 'عزباء' : 'أعزب',
                'married' => $family->gender === 'female' ? 'متزوجة' : 'متزوج',
                'widowed' => $family->gender === 'female' ? 'أرملة' : 'أرمل',
                'divorced' => $family->gender === 'female' ? 'مطلقة' : 'مطلق',
                'polygamous' => 'متعدد الزوجات',
            ];

            $status = $statuses[$family->marital_status] ?? '-';

            $data[] = [
                $counter,
                $fullName,
                $family->identity_number ?? '',
                $gender,
                $family->age ?? '',
                $family->phone ?? '',
                $family->backup_phone ?? '',
                $status,
                $family->family_members_count ?? '',
                $wives
            ];

            $counter++;
        }

        return $data;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                $sheet->setRightToLeft(true);

                $sheet->mergeCells('A1:J1');
                $sheet->mergeCells('A3:J3');
                $sheet->mergeCells('B4:J4');
                $sheet->mergeCells('B5:J5');
                $sheet->mergeCells('B6:J6');
                $sheet->mergeCells('B7:J7');
                $sheet->mergeCells('B8:J8');
                $sheet->mergeCells('B9:J9');
                $sheet->mergeCells('A12:J12');

                $sheet->getStyle('A1:J1')->applyFromArray([
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

                $sheet->getStyle('A3:J3')->applyFromArray([
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

                $sheet->getStyle('A4:A9')->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => [
                        'fillType' => 'solid',
                        'color' => ['rgb' => 'E9F7EF'],
                    ],
                ]);

                $sheet->getStyle('A11:B11')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                        'color' => ['rgb' => '006B35'],
                    ],
                    'fill' => [
                        'fillType' => 'solid',
                        'color' => ['rgb' => 'FFF2CC'],
                    ],
                    'alignment' => ['horizontal' => 'center'],
                ]);

                $sheet->getStyle('A12:J12')->applyFromArray([
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

                $sheet->getStyle('A13:J13')->applyFromArray([
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

                $lastRow = 13 + $this->families->count();

                $sheet->getStyle('A1:J' . $lastRow)->applyFromArray([
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

                $sheet->getColumnDimension('A')->setWidth(8);
                $sheet->getColumnDimension('B')->setWidth(30);
                $sheet->getColumnDimension('C')->setWidth(18);
                $sheet->getColumnDimension('D')->setWidth(12);
                $sheet->getColumnDimension('E')->setWidth(10);
                $sheet->getColumnDimension('F')->setWidth(18);
                $sheet->getColumnDimension('G')->setWidth(18);
                $sheet->getColumnDimension('H')->setWidth(20);
                $sheet->getColumnDimension('I')->setWidth(18);
                $sheet->getColumnDimension('J')->setWidth(45);

                $sheet->getRowDimension(1)->setRowHeight(35);
                $sheet->getRowDimension(3)->setRowHeight(28);
                $sheet->getRowDimension(12)->setRowHeight(28);
                $sheet->getRowDimension(13)->setRowHeight(32);

                for ($row = 14; $row <= $lastRow; $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(45);
                }
            },
        ];
    }
}
