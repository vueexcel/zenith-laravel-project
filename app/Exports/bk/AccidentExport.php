<?php

namespace App\Exports;

use App\Models\Accident;
use App\Models\GroupCode;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AccidentExport extends DefaultValueBinder implements
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

    public function __construct($start, $end, $sheet=null, $master_kpi = null) {
        $this->start = $start;
        $this->end = $end;
        if($sheet != null)
            $this->sheet = $sheet.' Accidents';
        else
            $this->sheet = 'Accident List From Database';
        if(strlen($this->sheet) > 31)
            $this->sheet = substr($this->sheet,0,30);
        $this->master_kpi = $master_kpi;
    }

    public function query()
    {
        if($this->sheet == "RIDDOR Accidents") {
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
                ->where('accident_date', '<=', $this->end)
                ->where('riddor', 'Yes');
        } else {
            if($this->master_kpi == null) {
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
                    ->where('accident_date', '<=', $this->end)
                    ->where('causation_factor_id', '>', 3);
            } else {
                if($this->master_kpi == "tmuk_b") {
                    $groups = GroupCode::where('group_code', 'not like', 'H%')->pluck('id')->toArray();
                } else {
                    $groups = GroupCode::where('group_code', 'like', 'H%')->pluck('id')->toArray();
                }
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
                    ->whereIn('group_code_id', $groups)
                    ->where('accident_date', '>=', $this->start)
                    ->where('accident_date', '<=', $this->end)
                    ->where('causation_factor_id', '>', 3)
                    ->where(function($query){
                        $query->where('gir_definition_id', 2);
                        $query->orwhere('gir_definition_id', 4);
                    });
            }
        }

    }

    public function title(): string
    {
        // TODO: Implement title() method.
        return $this->sheet;
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.
        if($this->master_kpi != null) {
            return [
                'Mbr_NO',
                'Occupation',
                'Group_Stats',
                'Accident Date',
                'Report Date',
                'Logged Date',
                'Supervisor',
                'Member Statement',
                'Injury Type',
                'Body Part',
                'OHC Comment',
                'Outcome',
                'Seen By',
                'Causation',
                'Causation Factor',
                'WI Required',
                'WI Part1 Received',
                'WI Part2 Received',
                'Escalation',
                'Days Lost',
                'Statistics',
                'Updated By',
                'Updated Date',
                'Causation Factor2',
                'Department',
                'Stop-6',
                'Gir Definition',
                'Gir Reason'
            ];
        } else {
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

    }

    public function map($row): array
    {
        // TODO: Implement map() method.
        if($this->master_kpi != null) {
            return [
                $row->member->member_no,
                $row->member->occupation,
                ($row->group_code)?$row->group_code->group_code:'',
                ($row->accident_date)?date('d/m/Y', strtotime($row->accident_date)):'',
                ($row->reported_date)?date('d/m/Y', strtotime($row->reported_date)):'',
                ($row->logged_date)?date('d/m/Y', strtotime($row->logged_date)):'',
                $row->member->supervisor,
                $row->member_statement,
                ($row->injury_type)?$row->injury_type->injury:'',
                ($row->body_part)?$row->body_part->body_part:'',
                $row->ohc_comment,
                ($row->outcome)?$row->outcome->outcome:'',
                ($row->seen_by)?$row->seen_by->seen_by:'',
                ($row->causation_factor)?$row->causation_factor->number:'',
                ($row->causation_factor)?$row->causation_factor->causation_factor:'',
                $row->wi_required,
                ($row->wi_part_1_received)?date('d/m/Y', strtotime($row->wi_part_1_received)):'',
                ($row->wi_part_2_received)?date('d/m/Y', strtotime($row->wi_part_2_received)):'',
                $row->escalation,
                $row->days_lost,
                $row->member->department,
                ($row->user)?$row->user->name:'',
                ($row->updated_at)?date('d/m/Y', strtotime($row->updated_at)):'',
                ($row->causation_factor)?$row->causation_factor->causation_factor:'',
                $row->member->department,
                $row->stop_6,
                ($row->gir_definition)?$row->gir_definition->definition:'',
                $row->gir_reason
            ];
        }
        else  {
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
