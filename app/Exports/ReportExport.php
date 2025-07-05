<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportExport implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping
{
    protected $data;
    protected $mappedData;
    protected $totalHours;

    public function __construct($data)
    {
        // Ensure all rows are arrays and compute total
        $this->data = collect($data)->map(function ($row) {
            return is_array($row) ? $row : (array) $row;
        });

        $this->mappedData = $this->data->values();

        // Compute total from clean field
        $this->totalHours = $this->mappedData
            ->pluck('Hours Worked')
            ->map(function ($value) {
                // Extract numeric part from "12.7 hours"
                return is_numeric($value) ? floatval($value) : floatval(preg_replace('/[^0-9.]/', '', $value));
            })
            ->sum();
    }

    public function headings(): array
    {
        return array_keys($this->mappedData->first());
    }

    public function collection()
    {
        $rows = $this->mappedData->toArray();

        // Add a blank row
        $blankRow = array_fill(0, count($this->headings()), '');

        // Add the total row
        $totalRow = array_fill(0, count($this->headings()) - 2, '');
        $totalRow[] = 'Total Hours';
        $totalRow[] = $this->totalHours . ' hours';

        // Append both
        $rows[] = $blankRow;
        $rows[] = $totalRow;

        return collect($rows);
    }


    // public function collection()
    // {
    //     // Add the Total Hours row manually after the data
    //     $rows = $this->mappedData->toArray();

    //     // Create a new row for total
    //     $totalRow = array_fill(0, count($this->headings()) - 2, ''); // Empty columns
    //     $totalRow[] = 'Total Hours'; // second-to-last column
    //     $totalRow[] = $this->totalHours . ' hours'; // last column

    //     $rows[] = $totalRow;

    //     return collect($rows);
    // }

    public function startCell(): string
    {
        return 'A1';
    }

    public function map($row): array
    {
        return $row;
    }
}
