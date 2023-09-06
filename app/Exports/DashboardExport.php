<?php

namespace App\Exports;

use App\Models\Accident;
use App\Models\ContractorAccident;
use App\Models\GirDefinition;
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

class DashboardExport extends DefaultValueBinder implements
    FromQuery,
    WithTitle,
    WithHeadings,
    WithMapping,
    ShouldAutoSize,
    WithCustomValueBinder
    // WithStyles
{
    private $range, $kind;
    private $sheet;

    public function __construct($range, $kind)
    {
        $this->range = $range;
        $this->kind = $kind;
        $this->sheet = 'Dashboard - ' . str_replace("_", " ", $kind);
        if(strlen($this->sheet) > 31)
            $this->sheet = substr($this->sheet,0,30);
        $this->user_role = Auth::user()->is_admin;
    }

    public function query()
    {
        //Get Origin Type 'MSS' id
        $origin_type2 = OriginType::where('origin_type', 'MSS')->get()->first();
        $current_year = date('Y');
        $current_month = date('m');

        $gir_definitions = GirDefinition::where('definition', 'Lost Time')->orWhere('definition', 'Non Lost Time')->pluck('id')->toArray();

        $range = $this->range;
        $kind = $this->kind;

        if($range == "year") {
            $start = $current_year."-01-01";
            $end = $current_year."-12-31";
        } else if($range == "month") {
            $start = $current_year."-".$current_month."-01";
            $end = date("Y-m-t", strtotime($start));
        } else {
            $day = date('w');
            $start = date('Y-m-d', strtotime('-'.$day.' days'));
            $end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
        }

        if($kind == "gir") {
             return Accident::with('member')
                ->where('is_deleted', 0)
                ->whereBetween('accident_date', [$start, $end])
                ->where('causation_factor_id', '>', 3)
                ->whereIn('gir_definition_id', $gir_definitions);
        } else if($kind == "accident") {
            return Accident::with('member')
                ->where('is_deleted', 0)
                ->where('causation_factor_id', '>', 3)
                ->whereBetween('accident_date', [$start, $end]);
        } else if($kind == "mss") {
            return HealthConcern::with('member')
                ->where('is_deleted', 0)
                ->where('origin', 'Work')
                ->where('origin_type_id', $origin_type2->id)
                ->where('current_level', '!=', 'Level 1 - Discharged')
                ->whereBetween('ohc_appointment', [$start, $end]);
        } else if($kind == "gmir") { //gmir
            return HealthConcern::with('member')
                ->where('is_deleted', 0)
                ->where('current_level', '!=', 'Level 1 - Discharged')
                ->whereBetween('ohc_appointment', [$start, $end])
                ->where('gmir', 'GMIR_Full');
        } else if($kind == "accident_outstanding") { //gmir
            return Accident::with('member')
                ->where('is_deleted', 0)
                ->where('causation_factor_id', '>', 3)
                ->whereNull('wi_part_2_received')
                ->whereBetween('accident_date', [$start, $end]);
        } else if($kind == "mss_outstanding"){ //mss_outstanding
            return HealthConcern::where('origin', 'Work')
                ->where('origin_type_id', $origin_type2->id)
                ->where('is_deleted', 0)
                ->where('current_level', '!=', 'Level 1 - Discharged')
                ->whereYear('ohc_appointment', $current_year)
                ->whereNull('wi_part_2_received');
        } else if($kind == "accident_received") {
            return Accident::with('member')
                ->where('is_deleted', 0)
                ->where('causation_factor_id', '>', 3)
                ->whereBetween('accident_date', [$start, $end])
                ->whereNotNull('wi_part_2_received');
        } else if($kind == "mss_received"){ //mss_received
            return HealthConcern::where('origin', 'Work')
                ->where('origin_type_id', $origin_type2->id)
                ->where('is_deleted', 0)
                ->where('current_level', '!=', 'Level 1 - Discharged')
                ->whereYear('ohc_appointment', $current_year)
                ->whereNotNull('wi_part_2_received');
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
        if($kind == "mss" || $kind == "gmir" || $kind == "mss_outstanding" || $kind == "mss_received") {
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
        if($kind == "mss" || $kind == "gmir" || $kind == "mss_outstanding" || $kind == "mss_received") {
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
                    ($row->gir_definition)?$row->gir_definition->definition:'',
                    ($row->causation_factor)?$row->causation_factor->causation_factor:'',
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
                    ($row->gir_definition)?$row->gir_definition->definition:'',
                    ($row->causation_factor)?$row->causation_factor->causation_factor:'',
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
