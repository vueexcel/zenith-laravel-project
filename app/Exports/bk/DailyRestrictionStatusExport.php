<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DailyRestrictionStatusExport implements WithMultipleSheets
{
    private $export_sheets;
    public function __construct($export_sheets) {
        $this->export_sheets = $export_sheets;
    }

    public function sheets(): array
    {
        $sheets = [];
        foreach ($this->export_sheets as $sheet){
            $sheets[] = new DailyHSExport($sheet);
        }
        return $sheets;
    }
}
