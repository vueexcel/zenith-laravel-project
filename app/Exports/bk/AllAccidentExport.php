<?php

namespace App\Exports;

use App\Models\Accident;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AllAccidentExport extends DefaultValueBinder implements
    FromQuery,
    WithTitle,
    WithHeadings,
    WithMapping,
    ShouldAutoSize,
    WithCustomValueBinder,
    WithStyles
{
    private $start, $end;
    private $sheet;

    public function __construct($start, $end) {
        $this->start = $start;
        $this->end = $end;
        $this->sheet = 'All Accident From Database';
        if(strlen($this->sheet) > 31)
            $this->sheet = substr($this->sheet,0,30);
    }

    public function query()
    {
        return Accident::query()->with('member')
            ->with('injury_type')
            ->with('body_part')
            ->with('outcome')
            ->with('causation_factor')
            ->with('group_code')
            ->with('gir_definition')
            ->with('seen_by')
            ->with('user')
            ->where('is_deleted', 0)
            ->where('accident_date', '>=', $this->start)
            ->where('accident_date', '<=', $this->end);
    }

    public function title(): string
    {
        // TODO: Implement title() method.
        return $this->sheet;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Member ID',
            'Member NO',
            'Surname',
            'Name',
            'Accident Date',
            'Report Date',
            'Logged Date',
            'Member Statement',
            'Injury Type',
            'Body Part',
            'OHC Comment',
            'Outcome',
            'Seen By',
            'Causation Factor',
            'Escalation',
            'Lt Start Date',
            'Days Lost',
            'WI Required',
            'WI Part1 Received',
            'WI Part2 Received',
            'Gir Definition',
            'Gir Reason',
            'Group Stats',
            'Statistics',
            'Stop-6',
            'Riddor',
            'Riddor Reason',
            'Monthly Stats',
            'Updated At',
            'Updated By',
        ];

    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->member->id,
            $row->member->member_no,
            $row->member->surname,
            $row->member->name,
            $row->accident_date,
            $row->reported_date,
            $row->logged_date,
            $row->member_statement,
            ($row->injury_type)?$row->injury_type->injury:'',
            ($row->body_part)?$row->body_part->body_part:'',
            $row->ohc_comment,
            ($row->outcome)?$row->outcome->outcome:'',
            ($row->seen_by)?$row->seen_by->seen_by:'',
            ($row->causation_factor)?$row->causation_factor->number."-".$row->causation_factor->causation_factor:'',
            $row->escalation,
            $row->lt_start_date,
            $row->days_lost,
            $row->wi_required,
            $row->wi_part_1_received,
            $row->wi_part_2_received,
            ($row->gir_definition)?$row->gir_definition->definition:'',
            $row->gir_reason,
            ($row->group_code)?$row->group_code->group_code:'',
            $row->statistics,
            $row->stop_6,
            $row->riddor,
            $row->riddor_reason,
            $row->monthly_stats,
            $row->updated_at,
            ($row->user)?$row->user->name:''
        ];

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
            1    => ['font' => ['bold' => true]],
        ];
    }
}
