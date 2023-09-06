<?php

namespace App\Exports;

use App\Models\HealthConcern;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class HsByMemberExport extends DefaultValueBinder implements FromView, WithStyles, WithTitle, WithCustomValueBinder
{
    private $member_id;

    public function __construct($member_id)
    {
        $this->member_id = $member_id;
        $this->sheet = 'HealConcerns By Member';
        if(strlen($this->sheet) > 31)
            $this->sheet = substr($this->sheet,0,30);
    }

    public function view(): View
    {
        $data['report_data'] = HealthConcern::with('member')
            ->where('is_deleted', 0)
            ->where('member_id', $this->member_id)
            ->orderBy('logged_date', 'DESC')
            ->get();
        return view('report.health_concerns_list', $data);
    }



    public function title(): string
    {
        // TODO: Implement title() method.
        return $this->sheet;
    }

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);
            return true;
        }
        // else return default behavior
        return parent::bindValue($cell, $value);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
