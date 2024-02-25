<?php

namespace App\Exports;

use App\Models\Bill;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BillExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithColumnFormatting
{
    protected $index = 0;

    public function headings(): array
    {
        return [
            'Sl No.',
            'UUID',
            'Name',
            'Particularts',
            'Date of Submit',
            'Bill No.',
            'Collected By',
            'Branch',
            'Amount'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]]
        ];
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Bill::all();
    }

    public function map($bill): array
    {
        $particulars    =   ($bill->fees_type == 'others') ? $bill->remarks : ucwords($bill->fees_type.' Fees');

        return [
            ++$this->index,
            'N/A',
            $bill->name,
            $particulars,
            Date::dateTimeToExcel($bill->billing_date),
            $bill->bill_no,
            'ASTA India',
            $bill->branch,
            $bill->total_amount
        ];
    }
}
