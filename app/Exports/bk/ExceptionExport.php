<?php

namespace App\Exports;

use App\Models\Accident;
use App\Models\Exception;
use App\Models\HealthConcern;
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

class ExceptionExport extends DefaultValueBinder implements
    FromQuery,
    WithTitle,
    WithHeadings,
    WithMapping,
    ShouldAutoSize,
    WithCustomValueBinder,
    WithStyles
{
    private $sheet;

    public function __construct($sheet) {
        $this->sheet = $sheet;
        if(strlen($this->sheet) > 31)
            $this->sheet = substr($this->sheet,0,30);
    }

    public function query()
    {
        $currentYear = date('Y');
        if($this->sheet == "Accidents") {
            return Accident::query()->with('member')
                ->with('group_code')
                ->where('is_deleted', 0)
                ->where(function($query){
                    $query->whereNull('reported_date');
                    $query->orWhereNull('logged_date');
                    $query->orWhereNull('member_statement');
                    $query->orWhereNull('injury_type_id');
                    $query->orWhereNull('body_part_id');
                    $query->orWhereNull('ohc_comment');
                    $query->orWhereNull('outcome_id');
                    $query->orWhereNull('gir_definition_id');
                    $query->orWhereNull('wi_required');
                    $query->orWhereNull('group_code_id');
                    $query->orWhereNull('stop_6');
                    $query->orWhereNull('riddor');
                    $query->orWhereNull('escalation');
                    $query->orWhereNull('accident_date');
                })
                ->where(function($query){
                    //$currentYear = date('Y');
                    //$query->whereYear('accident_date', $currentYear);
                    $query->where('accident_date', '>', '2020-01-10');
                    $query->orWhereNull('accident_date');
                })
                ->where(function($query){
                    //$currentYear = date('Y');
                    //$query->whereYear('logged_date', $currentYear);
                    $query->where('logged_date', '>', '2020-01-10');
                    $query->orWhereNull('logged_date');
                });
        } else if($this->sheet == "Health Concerns") {
            return HealthConcern::query()->with('member')
                ->with('body_part')
                ->with('origin_type')
                ->with('group_code')
                ->where('is_deleted', 0)
                ->where(function($query){
                    $query->whereNull('body_part_id');
                    $query->orWhereNull('origin');
                    $query->orWhereNull('origin_type_id');
                    $query->orWhereNull('symptoms');
                    $query->orWhereNull('group_code_id');
                    $query->orWhereNull('current_level');
                    $query->orWhereNull('ohc_appointment');
                    $query->orWhere(function($query){
                        $query->where('next_step_id', 7);
                        $query->where(function ($query){
                            $query->whereNull('ramp_up');
                            $query->orWhere('ramp_up', 'None');
                        });
                    });
                })
                ->where(function($query){
                    //$currentYear = date('Y');
                    //$query->whereYear('ohc_appointment', $currentYear);
                    $query->where('ohc_appointment', '>', '2020-01-10');
                    $query->orWhereNull('ohc_appointment');
                })
                ->where(function($query){
                    //$currentYear = date('Y');
                    //$query->whereYear('concern_date', $currentYear);
                    $query->where('concern_date', '>', '2020-01-10');
                    $query->orWhereNull('concern_date');
                });
        } else {
            return Exception::query()->with('member')
                ->where('confirmed', 0);
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
        if($this->sheet == "Accidents") {
            return [
                'ID',
                'Member ID',
                'Member NO',
                'Surname',
                'Name',
                'Group Stats',
                'OHC Date',
                'Missing Data'
            ];
        } else if($this->sheet == "Health Concerns") {
            return [
                'ID',
                'Member ID',
                'Member NO',
                'Surname',
                'Name',
                'Occupation',
                'Group Stats',
                'Body Part',
                'Symptoms',
                'Origin',
                'Origin Type',
                'OHC Appointment',
                'Current Level',
                'Missing Data'
            ];
        } else {
            return [
                'Episode Reference',
                'Member NO',
                'Name',
                'Surname',
                'Group Stats',
                'OHC Date',
                'Changed Data',
                'HealthConcern/Accident'
            ];
        }

    }

    public function map($row): array
    {
        // TODO: Implement map() method.
        if($this->sheet == "Accidents") {
            $missing_data = '';
            if($row->reported_date == null)
                $missing_data .= "Reported Date";

            if($row->logged_date == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Logged Date";
                else
                    $missing_data .= "Logged Date";
            }

            if($row->member_statement == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Member Statement";
                else
                    $missing_data .= "Member Statement";
            }

            if($row->injury_type_id == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Injury Type";
                else
                    $missing_data .= "Injury Type";
            }

            if($row->body_part_id == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Body Part";
                else
                    $missing_data .= "Body Part";
            }

            if($row->ohc_comment == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Ohc Comment";
                else
                    $missing_data .= "Ohc Comment";
            }

            if($row->outcome_id == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Outcome";
                else
                    $missing_data .= "Outcome";
            }

            if($row->wi_required == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Wi Required";
                else
                    $missing_data .= "Wi Required";
            }

            if($row->gir_definition_id == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Gir Definition";
                else
                    $missing_data .= "Gir Definition";
            }

            if($row->stop_6 == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Stop-6";
                else
                    $missing_data .= "Stop-6";
            }

            if($row->riddor == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Riddor";
                else
                    $missing_data .= "Riddor";
            }

            if($row->escalation == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Escalation";
                else
                    $missing_data .= "Escalation";
            }

            if($row->accident_date == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Accident Date";
                else
                    $missing_data .= "Accident Date";
            }
            return [
                $row->id,
                $row->member->id,
                $row->member->member_no,
                $row->member->surname,
                $row->member->name,
                ($row->group_code)?$row->group_code->group_code:'',
                $row->accident_date,
                $missing_data
            ];
        } else if($this->sheet == "Health Concerns") {
            $missing_data = '';
            if($row->body_part_id == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Body Part";
                else
                    $missing_data .= "Body Part";
            }

            if($row->symptoms == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Symptoms";
                else
                    $missing_data .= "Symptoms";
            }

            if($row->origin == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Origin";
                else
                    $missing_data .= "Origin";
            }

            if($row->origin_type_id == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Origin Type";
                else
                    $missing_data .= "Origin Type";
            }

            if($row->current_level == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Current Level";
                else
                    $missing_data .= "Current Level";
            }

            if($row->ohc_appointment == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Ohc Date";
                else
                    $missing_data .= "Ohc Date";
            }

            if($row->next_step_id = 7 && ($row->ramp_up == null || $row->ramp_up == 'None')) {
                if(!empty($missing_data))
                    $missing_data .= ", Ramp up";
                else
                    $missing_data .= "Ramp up";
            }

            return [
                $row->id,
                $row->member->id,
                $row->member->member_no,
                $row->member->surname,
                $row->member->name,
                $row->member->occupation,
                ($row->group_code)?$row->group_code->group_code:'',
                ($row->body_part)?$row->body_part->body_part:'',
                $row->symptoms,
                $row->origin,
                ($row->origin_type)?$row->origin_type->origin_type:'',
                $row->ohc_appointment,
                $row->current_level,
                $missing_data
            ];
        } else {
            return [
                ($row->health_concern_id)?$row->health_concern->episode_reference:'',
                $row->member->member_no,
                $row->member->name,
                $row->member->surname,
                ($row->group_code)?$row->group_code->group_code:'',
                $row->ohc_date,
                $row->changed_data,
                ($row->health_concern_id)?'Health Concern':'Accident'
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
