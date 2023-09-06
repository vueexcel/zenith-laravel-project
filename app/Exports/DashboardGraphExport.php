<?php

namespace App\Exports;

use App\Models\Accident;
use App\Models\ContractorAccident;
use App\Models\GirDefinition;
use App\Models\GroupCode;
use App\Models\HealthConcern;
use App\Models\OriginType;
use Illuminate\Support\Facades\Auth;
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

class DashboardGraphExport extends DefaultValueBinder implements
    FromQuery,
    WithTitle,
    WithHeadings,
    WithMapping,
    ShouldAutoSize,
    WithCustomValueBinder
    // WithStyles
{
    private $year, $kind;
    private $sheet;

    public function __construct($year, $kind)
    {
        $this->year = $year;
        $this->kind = $kind;
        $this->sheet = str_replace("_", " ", $kind);
        if(strlen($this->sheet) > 31)
            $this->sheet = substr($this->sheet,0,30);
        $this->user_role = Auth::user()->is_admin;
    }

    public function query()
    {
        //Get Origin Type 'MSS' id
        $origin_type2 = OriginType::where('origin_type', 'MSS')->get()->first();
        $year = $this->year;
        $graph_type = $this->kind;

        if($graph_type == "assembly_accident" || $graph_type == "assembly_mss") {
            $groups = GroupCode::where('group_code', 'like', 'GA%')
                ->orWhere('group_code', 'like', 'GB%' )
                ->orWhere('group_code', 'like', 'GC%' )
                ->orWhere('group_code', 'like', 'GF%' )
                ->orWhere('group_code', 'like', 'GG%' )
                ->orWhere('group_code', 'like', 'G7%' )->pluck('id')->toArray();
        }

        else if($graph_type == "body_shop_accident" || $graph_type == "body_shop_mss") {
            $groups = GroupCode::where('group_code', 'like', 'I3%')
                ->orWhere('group_code', 'like', 'I4%' )
                ->orWhere('group_code', 'like', 'IC%' )
                ->pluck('id')->toArray();
        }

        else if($graph_type == "paint_plastic_accident" || $graph_type == "paint_plastic_mss") {
            $groups = GroupCode::where('group_code', 'like', 'JA%')
                ->orWhere('group_code', 'like', 'JB%' )
                ->orWhere('group_code', 'like', 'JC%' )
                ->orWhere('group_code', 'like', 'JD%' )
                ->orWhere('group_code', 'like', 'J5%' )
                ->orWhere('group_code', 'like', 'J6%' )
                ->pluck('id')->toArray();
        }

        else if($graph_type == "qa_accident" || $graph_type == "qa_mss") {
            $groups = GroupCode::where('group_code', 'like', 'F%')
                ->pluck('id')->toArray();
        }

        else if($graph_type == "manufacturing_accident" || $graph_type == "manufacturing_mss") {
            $groups = GroupCode::where('group_code', 'like', 'L6%')
                ->orWhere('group_code', 'like', 'L7%' )
                ->pluck('id')->toArray();
        }

        else if($graph_type == "corporate_accident" || $graph_type == "corporate_mss") {
            $groups = GroupCode::where('group_code', 'like', 'A%')
                ->orWhere('group_code', 'like', 'B%' )
                ->orWhere('group_code', 'like', 'C%' )
                ->orWhere('group_code', 'like', 'E%' )
                ->pluck('id')->toArray();
        }

        else if($graph_type == "deeside_accident" || $graph_type == "deeside_mss") {
            $groups = GroupCode::where('group_code', 'like', 'H%')
                ->pluck('id')->toArray();
        }

        else if($graph_type == "assembly_production_accident" || $graph_type == "assembly_production_mss") {
            $groups = GroupCode::where('group_code', 'like', 'G7%')->pluck('id')->toArray();
        }

        else if($graph_type == "assembly_logistics_accident" || $graph_type == "assembly_logistics_mss") {
            $groups = GroupCode::where('group_code', 'like', 'GB%')->pluck('id')->toArray();
        }

        else if($graph_type == "assembly_maint_eng_accident" || $graph_type == "assembly_maint_eng_mss") {
            $groups = GroupCode::where('group_code', 'like', 'GA%')
                ->orWhere('group_code', 'like', 'GC%' )
                ->orWhere('group_code', 'like', 'GF%' )
                ->orWhere('group_code', 'like', 'GG%' )
                ->pluck('id')->toArray();
        }

        else if($graph_type == "body_shop_production_accident" || $graph_type == "body_shop_production_mss") {
            $groups = GroupCode::where('group_code', 'like', 'I3%')
                ->orWhere('group_code', 'like', 'I4%' )
                ->pluck('id')->toArray();
        }

        else if($graph_type == "body_shop_maint_eng_accident" || $graph_type == "body_shop_maint_eng_mss") {
            $groups = GroupCode::Where('group_code', 'like', 'IC%' )->pluck('id')->toArray();
        }

        else if($graph_type == "paint_shop_production_accident" || $graph_type == "paint_shop_production_mss") {
            $groups = GroupCode::where('group_code', 'like', 'J5%')->pluck('id')->toArray();
        }

        else if($graph_type == "paint_shop_maint_eng_accident" || $graph_type == "paint_shop_maint_eng_mss") {
            $groups = GroupCode::where('group_code', 'like', 'JC%')
                ->orWhere('group_code', 'like', 'JD%' )
                ->pluck('id')->toArray();
        }

        else if($graph_type == "plastics_shop_production_accident" || $graph_type == "plastics_shop_production_mss") {
            $groups = GroupCode::where('group_code', 'like', 'J6%' )->pluck('id')->toArray();
        }

        else if($graph_type == "plastics_shop_maint_eng_accident" || $graph_type == "plastics_shop_maint_eng_mss") {
            $groups = GroupCode::where('group_code', 'like', 'JA%')
                ->orWhere('group_code', 'like', 'JB%' )
                ->pluck('id')->toArray();
        }

        else {
            $groups = array();
        }

        if(strpos($graph_type, 'accident') !== false) {
            return Accident::where('causation_factor_id', '>', 3)
                ->whereYear('accident_date', $year)
                ->whereIn('group_code_id', $groups)
                ->where('is_deleted', 0);
        } else {
            return HealthConcern::where('origin', 'Work')
                ->where('origin_type_id', $origin_type2->id)
                ->whereYear('ohc_appointment', $year)
                ->whereIn('group_code_id', $groups)
                ->where('is_deleted', 0)
                ->where('current_level', '!=', 'Level 1 - Discharged');
        }
    }

    public function title(): string
    {
        // TODO: Implement title() method.
        return $this->sheet;
    }

    public function headings(): array
    {
        $kind = $this->kind;
        $user_role = $this->user_role;
        if(strpos($kind, 'accident') === false) {
            if($user_role == 2)
                return [
                    'Episode Reference',
                    'Member No',
                    'Name',
                    'Surname',
                    'Group Stats',
                    'OHC Date',
                    'Body Part',
                    'Outcome',
                    'GMIR',
                    'Discharge Date',
                    'Current Level',
                    'Updated At',
                    'WI Part1 Received',
                    'WI Part2 Received',
                ];
            else
                return [
                    'Episode Reference',
                    'Group Stats',
                    'OHC Date',
                    'Body Part',
                    'Outcome',
                    'GMIR',
                    'Discharge Date',
                    'Current Level',
                    'Updated At',
                    'WI Part1 Received',
                    'WI Part2 Received',
                ];
        } else {
            if($user_role == 2)
                return [
                    'Member No',
                    'Name',
                    'Surname',
                    'Group Stats',
                    'Reported Date',
                    'Accident Date',
                    'OHC Date',
                    'Department',
                    'GIR',
                    'Causation',
                    'Updated At',
                    'WI Part1 Received',
                    'WI Part2 Received',
                ];
            else
                return [
                    'Group Stats',
                    'Reported Date',
                    'Accident Date',
                    'OHC Date',
                    'Department',
                    'GIR',
                    'Causation',
                    'Updated At',
                    'WI Part1 Received',
                    'WI Part2 Received',
                ];
        }
    }

    public function map($row): array
    {
        // TODO: Implement map() method.
        $kind = $this->kind;
        $user_role = $this->user_role;
        if(strpos($kind, 'accident') === false)  {
            if($user_role == 2)
                return [
                    $row->episode_reference,
                    $row->member->member_no,
                    $row->member->name,
                    $row->member->surname,
                    ($row->group_code)?$row->group_code->group_code:'',
                    ($row->ohc_appointment != null && $row->ohc_appointment != "")?date('d/m/Y', strtotime($row->ohc_appointment)):'',
                    ($row->body_part)?$row->body_part->body_part:'',
                    $row->outcome,
                    ($row->gmir)?$row->gmir:'No',
                    ($row->discharge_date != null && $row->discharge_date != "")?date('d/m/Y', strtotime($row->discharge_date)):'',
                    $row->current_level,
                    ($row->updated_at != null && $row->updated_at != "")?date('d/m/Y H:i', strtotime($row->updated_at)):'',
                    ($row->wi_part_1_received != null && $row->wi_part_1_received != "")?date('d/m/Y H:i', strtotime($row->wi_part_1_received)):'',
                    ($row->wi_part_2_received != null && $row->wi_part_2_received != "")?date('d/m/Y H:i', strtotime($row->wi_part_2_received)):'',
                ];
            else
                return [
                    $row->episode_reference,
                    ($row->group_code)?$row->group_code->group_code:'',
                    ($row->ohc_appointment != null && $row->ohc_appointment != "")?date('d/m/Y', strtotime($row->ohc_appointment)):'',
                    ($row->body_part)?$row->body_part->body_part:'',
                    $row->outcome,
                    ($row->gmir)?$row->gmir:'No',
                    ($row->discharge_date != null && $row->discharge_date != "")?date('d/m/Y', strtotime($row->discharge_date)):'',
                    $row->current_level,
                    ($row->updated_at != null && $row->updated_at != "")?date('d/m/Y H:i', strtotime($row->updated_at)):'',
                    ($row->wi_part_1_received != null && $row->wi_part_1_received != "")?date('d/m/Y H:i', strtotime($row->wi_part_1_received)):'',
                    ($row->wi_part_2_received != null && $row->wi_part_2_received != "")?date('d/m/Y H:i', strtotime($row->wi_part_2_received)):'',
                ];
        } else {
            if($user_role == 2)
                return [
                    $row->member->member_no,
                    $row->member->name,
                    $row->member->surname,
                    ($row->group_code)?$row->group_code->group_code:'',
                    ($row->reported_date != null && $row->reported_date != "")?date('d/m/Y', strtotime($row->reported_date)):'',
                    ($row->accident_date != null && $row->accident_date != "")?date('d/m/Y', strtotime($row->accident_date)):'',
                    ($row->logged_date != null && $row->logged_date != "")?date('d/m/Y', strtotime($row->logged_date)):'',
                    $row->member->department,
                    $row->gir_definition->definition,
                    $row->causation_factor->causation_factor,
                    ($row->updated_at != null && $row->updated_at != "")?date('d/m/Y H:i', strtotime($row->updated_at)):'',
                    ($row->wi_part_1_received != null && $row->wi_part_1_received != "")?date('d/m/Y H:i', strtotime($row->wi_part_1_received)):'',
                    ($row->wi_part_2_received != null && $row->wi_part_2_received != "")?date('d/m/Y H:i', strtotime($row->wi_part_2_received)):'',
                ];
            else
                return [
                    ($row->group_code)?$row->group_code->group_code:'',
                    ($row->reported_date != null && $row->reported_date != "")?date('d/m/Y', strtotime($row->reported_date)):'',
                    ($row->accident_date != null && $row->accident_date != "")?date('d/m/Y', strtotime($row->accident_date)):'',
                    ($row->logged_date != null && $row->logged_date != "")?date('d/m/Y', strtotime($row->logged_date)):'',
                    $row->member->department,
                    $row->gir_definition->definition,
                    $row->causation_factor->causation_factor,
                    ($row->updated_at != null && $row->updated_at != "")?date('d/m/Y H:i', strtotime($row->updated_at)):'',
                    ($row->wi_part_1_received != null && $row->wi_part_1_received != "")?date('d/m/Y H:i', strtotime($row->wi_part_1_received)):'',
                    ($row->wi_part_2_received != null && $row->wi_part_2_received != "")?date('d/m/Y H:i', strtotime($row->wi_part_2_received)):'',
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
            1 => ['font' => ['bold' => true]],
        ];
    }
}
