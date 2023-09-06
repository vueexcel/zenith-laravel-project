<?php

namespace App\Exports;

use App\Models\HealthConcern;
use App\Models\OriginType;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
// use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class IllnessIncidentExport extends DefaultValueBinder implements
    FromQuery,
    WithTitle,
    WithHeadings,
    WithMapping,
    ShouldAutoSize,
    WithCustomValueBinder
    // WithStyles
{
    private $start, $end;
    private $sheet;

    public function __construct($start, $end) {
        $this->start = $start;
        $this->end = $end;
        $this->sheet = 'Illness List From Database';
        if(strlen($this->sheet) > 31)
            $this->sheet = substr($this->sheet,0,30);
    }

    public function query()
    {
        $origin_type = OriginType::where('origin_type', 'Illness')->get()->first();
        return HealthConcern::query()->with('member')
            ->with('body_part')
            ->with('origin_type')
            ->with('mss_causation')
            ->with('next_step')
            ->with('group_code')
            ->with('user')
            ->where('is_deleted', 0)
            ->where('current_level', '!=', 'Level 1 - Discharged')
            ->where('origin',  'Work')
            ->where('ohc_appointment', '>=', $this->start)
            ->where('ohc_appointment', '<=', $this->end)
            ->where('origin_type_id', $origin_type->id);
    }

    public function title(): string
    {
        // TODO: Implement title() method.
        return $this->sheet;
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
            'ID',
            'Member ID',
            'Member NO',
            'Surname',
            'Name',
            'Occupation',
            'Group Code',
            'Section',
            'Department',
            'Division',
            'Supervisor',
            'Logged Date',
            'Concern Date',
            'Level1 Date',
            'Repeat',
            'Body Part',
            'Symptoms',
            'Origin',
            'Origin Type',
            'WI Required',
            'WI Part1 Received',
            'WI Part2 Received',
            'Group Stats',
            'Level1 Discharged',
            'OHC Appointment',
            'Appointment Reason',
            'Initial Advice',
            'Next Step1 Date',
            'Next Step1',
            'Next Step2 Date',
            'Next Step2',
            'Next Step3 Date',
            'Next Step3',
            'Next Step4 Date',
            'Next Step4',
            'Next Step5 Date',
            'Next Step5',
            'Next Step6 Date',
            'Next Step6',
            'Next Step7 Date',
            'Next Step7',
            'Next Step8 Date',
            'Next Step8',
            'Next Step9 Date',
            'Next Step9',
            'Outcome',
            'Next Steps',
            'Level2 Date',
            'Level2 Discharged',
            'Level3 Date',
            'Level3 Discharged',
            'Level4 Date',
            'Level5 Discharged',
            'Group Stats',
            'RTW Date',
            'RTW Date Revised',
            'Current Level',
            'Ramp Up',
            'Fully Fit',
            'Discharged Date',
            'GMIR',
            'Lost Time MSS',
            'LT Start Date',
            'MSS Causation Factor',
            'Updated At',
            'Updated By',
            'Status',
            'Month',
        ];
    }

    public function map($row): array
    {
        // TODO: Implement map() method.
        return [
            $row->id,
            $row->member->id,
            $row->member->member_no,
            $row->member->surname,
            $row->member->name,
            $row->member->occupation,
            $row->member->group_code,
            $row->member->section,
            $row->member->department,
            $row->member->division,
            $row->member->supervisor,
            $row->logged_date,
            $row->concern_date,
            $row->level_1_date,
            $row->repeat,
            ($row->body_part)?$row->body_part->body_part:'',
            $row->symptoms,
            $row->origin,
            ($row->origin_type)?$row->origin_type->origin_type:'',
            $row->wi_required,
            $row->wi_part_1_received,
            $row->wi_part_2_received,
            ($row->group_code)?$row->group_code->group_code:'',
            $row->level_1_discharged,
            $row->ohc_appointment,
            $row->appointment_reason,
            $row->initial_advice,
            $row->next_steps_1_date,
            $row->next_steps_1,
            $row->next_steps_2_date,
            $row->next_steps_2,
            $row->next_steps_3_date,
            $row->next_steps_3,
            $row->next_steps_4_date,
            $row->next_steps_4,
            $row->next_steps_5_date,
            $row->next_steps_5,
            $row->next_steps_6_date,
            $row->next_steps_6,
            $row->next_steps_7_date,
            $row->next_steps_7,
            $row->next_steps_8_date,
            $row->next_steps_8,
            $row->next_steps_9_date,
            $row->next_steps_9,
            $row->outcome,
            ($row->next_step)?$row->next_step->next_step:'',
            $row->level_2_date,
            $row->level_2_discharged,
            $row->level_3_date,
            $row->level_3_discharged,
            $row->level_4_date,
            $row->level_4_discharged,
            ($row->group_code)?$row->group_code->group_code:'',
            $row->rtw_date,
            $row->rtw_date_revised,
            $row->current_level,
            $row->ramp_up,
            $row->fully_fit,
            $row->discharge_date,
            $row->gmir,
            $row->lost_time_mss,
            $row->lt_start_date,
            ($row->mss_causation)?$row->mss_causation->mss_number.'-'.$row->mss_causation->mss_causation:'',
            $row->updated_at,
            ($row->user)?$row->user->name:'',
            '',
            '',
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
