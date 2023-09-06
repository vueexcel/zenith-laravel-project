<?php

namespace App\Exports;

use App\Models\GroupCode;
use App\Models\HealthConcern;
use App\Models\Member;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
// use Maatwebsite\Excel\Concerns\WithColumnWidths;
// use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;

class DailyHSExport implements FromView, WithTitle, ShouldAutoSize
{
    private $sheet;

    public function __construct($sheet) {
        $this->sheet = $sheet;
    }

    public function view(): View
    {
        $data = array();
        switch ($this->sheet) {
            case "All Health Concerns":
                $data['report_data'] = $this->get_all_health_concerns();
                return view('report.zenith_daily.ramp_up', $data);
                break;
            case "Ramp-up":
                $data['report_data'] = $this->get_ramp_up();
                return view('report.zenith_daily.ramp_up', $data);
                break;
            case "Rest & Mod < 100% NWK":
                $data['report_data'] = $this->get_rest_mod_nwk();
                return view('report.zenith_daily.rest_mod', $data);
                break;
            case "Rest & Mod < 100% WK":
                $data['report_data'] = $this->get_rest_mod_wk();
                return view('report.zenith_daily.rest_mod', $data);
                break;
            case "Absent":
                $data['report_data'] = $this->get_absent();
                return view('report.zenith_daily.rest_mod', $data);
                break;
            /*case "All Rest & Mod Days":
                $data['report_data'] = $this->get_all_rest_mod();
                return view('report.zenith_daily.rest_mod', $data);
                break;*/
            case "New Restricted Cases" :
                $monday = strtotime("last monday");
                $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
                $sunday = strtotime(date("Y-m-d",$monday)." +6 days");
                $this_week_sd = date("Y-m-d",$monday);
                $this_week_ed = date("Y-m-d",$sunday);
                $report_data = HealthConcern::join('members', 'health_concerns.member_id', '=', 'members.id')
                    ->whereBetween('health_concerns.ohc_appointment', [$this_week_sd, $this_week_ed])
                    ->where('health_concerns.next_step_id', '3')
                    //->where('health_concerns.outcome', 'not like', '%Discharged%')
                    ->where('health_concerns.is_deleted', 0)
                    ->where('members.occupation', 'not like', '%maintenance%')
                    ->where('members.occupation', 'not like', '%spec%')
                    ->where('members.occupation', 'not like', '%eng%')
                    ->where('members.occupation', 'not like', '%manager%')
                    ->where('members.occupation', 'not like', '%admin%')
                    ->where('members.occupation', 'not like', '%director%')
                    ->where('members.occupation', 'not like', '%co-or%')
                    ->where('members.is_deleted', 0)
                    ->get();
                $data['report_data'] = $report_data;
                return view('report.zenith_daily.new_restricted_cases', $data);
                break;
            case "Raw List":
                $report_data = $this->get_ramp_up();
                $members = array();
                foreach ($report_data as $report_datum) {
                    array_push($members, $report_datum->member_id);
                }
                $report_data = $this->get_all_rest_mod();
                foreach ($report_data as $report_datum) {
                    if(!in_array($report_datum->member_id, $members))
                        array_push($members, $report_datum->member_id);
                }
                $data['report_data'] = Member::whereIn('id', $members)->get();
                return view('report.zenith_daily.raw_list', $data);
                break;
            /*case "Combined List":
                $members = array();
                $report_data = $this->get_ramp_up();
                foreach ($report_data as $report_datum) {
                    array_push($members, array(
                        'member' => $report_datum->member,
                        'ramp_up' => 1,
                        'rest_mod_nwk' => 0,
                        'rest_mod_wk' => 0,
                        'red_flex_not_working' => 0,
                        'maternity' => 0,
                        'ohc_date' => $report_datum->ohc_appointment,
                    ));
                }
                $data['ramp_up'] = count($report_data);

                $report_data = $this->get_rest_mod_nwk();
                foreach ($report_data as $report_datum) {
                    array_push($members, array(
                        'member' => $report_datum->member,
                        'ramp_up' => 0,
                        'rest_mod_nwk' => 1,
                        'rest_mod_wk' => 0,
                        'red_flex_not_working' => 0,
                        'maternity' => 0,
                        'ohc_date' => $report_datum->ohc_appointment,
                    ));
                }
                $data['rest_mod_nwk'] = count($report_data);

                $report_data = $this->get_rest_mod_wk();
                foreach ($report_data as $report_datum) {
                    array_push($members, array(
                        'member' => $report_datum->member,
                        'ramp_up' => 0,
                        'rest_mod_nwk' => 0,
                        'rest_mod_wk' => 1,
                        'red_flex_not_working' => 0,
                        'maternity' => 0,
                        'ohc_date' => $report_datum->ohc_appointment,
                    ));
                }
                $data['rest_mod_wk'] = count($report_data);

                usort($members, function ($item1, $item2) {
                    return $item1['ohc_date'] <=> $item2['ohc_date'];
                });

                $data['report_data'] = $members;
                return view('report.zenith_daily.combined_list', $data);
                break;
            case "Summary PPR":
                return view('report.zenith_daily.summary_ppr', $data);
                break;
            case "Summary":
                return view('report.zenith_daily.summary', $data);
                break;
            case "Today":
                $report_data = HealthConcern::join('members', 'health_concerns.member_id', '=', 'members.id')
                    ->where('health_concerns.next_step_id', '3')
                    //->where('health_concerns.outcome', 'not like', '%Discharged%')
                    ->where('health_concerns.is_deleted', 0)
                    ->where('members.occupation', 'not like', '%maintenance%')
                    ->where('members.occupation', 'not like', '%spec%')
                    ->where('members.occupation', 'not like', '%eng%')
                    ->where('members.occupation', 'not like', '%manager%')
                    ->where('members.occupation', 'not like', '%admin%')
                    ->where('members.occupation', 'not like', '%director%')
                    ->where('members.occupation', 'not like', '%co-or%')
                    ->where('members.is_deleted', 0)
                    ->count();
                $data['members'] = $report_data;
                return view('report.zenith_daily.today', $data);
                break;*/
            case "Total Health Concerns":
                $data['report_data'] = $this->get_health_concerns();
                return view('report.zenith_daily.total_health_concerns', $data);
                break;
            case "Burnaston Health Concerns":
                $groups = GroupCode::where('group_code', 'not like', 'H%')->pluck('id')->toArray();
                $data['report_data'] = $this->get_health_concerns($groups);
                return view('report.zenith_daily.health_concerns', $data);
                break;
            case "Deeside Health Concerns":
                $groups = GroupCode::where('group_code', 'like', 'H%')->pluck('id')->toArray();
                $data['report_data'] = $this->get_health_concerns($groups);
                return view('report.zenith_daily.health_concerns', $data);
                break;
            default: return view('report.zenith_daily.index', $data); break;
        }
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true], 'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]]
        ];
    }

    public function columnWidths(): array
    {
        return [

        ];
    }

    public function title(): string
    {
        // TODO: Implement title() method.
        return $this->sheet;
    }

    public function get_all_health_concerns()
    {
        return HealthConcern::join('members', 'health_concerns.member_id', '=', 'members.id')
            ->where('health_concerns.ohc_appointment', '>', '2019-12-31')
            ->where('health_concerns.is_deleted', 0)
            ->where('members.is_deleted', 0)
            ->get();
    }

    public function get_ramp_up()
    {
        $today = date('Y-m-d');
        return HealthConcern::join('members', 'health_concerns.member_id', '=', 'members.id')
            ->where('health_concerns.ohc_appointment', '>', '2018-12-31')
            ->whereNotNull('health_concerns.ramp_up')
            ->where('health_concerns.ramp_up', '!=', 'None')
            ->where('health_concerns.next_step_id', 7)
            ->where('health_concerns.current_level', '!=', 'level 1 - discharged')
            ->where('health_concerns.current_level', '!=', 'level 2 - discharged')
            ->where('health_concerns.current_level', '!=', 'level 3 - discharged')
            ->where('health_concerns.current_level', '!=', 'level 4 (red flex) discharged')
            // ->where('health_concerns.fully_fit', '>', $today)
            ->where('health_concerns.is_deleted', 0)
            ->where('members.occupation', 'not like', '%maintenance%')
            ->where('members.occupation', 'not like', '%spec%')
            ->where('members.occupation', 'not like', '%eng%')
            ->where('members.occupation', 'not like', '%manager%')
            ->where('members.occupation', 'not like', '%admin%')
            ->where('members.occupation', 'not like', '%director%')
            ->where('members.occupation', 'not like', '%co-or%')
            ->where('members.is_deleted', 0)
            ->get();
    }

    public function get_rest_mod_nwk()
    {
        return HealthConcern::join('members', 'health_concerns.member_id', '=', 'members.id')
            ->where('health_concerns.ohc_appointment', '>', '2018-12-31')
            ->where('health_concerns.origin', 'Non-Work')
            ->where('health_concerns.next_step_id', '3')
            ->where('health_concerns.outcome', 'not like', '%Discharged%')
            ->where('health_concerns.current_level', 'not like', '%Discharged')
            ->where('health_concerns.is_deleted', 0)
            ->where('members.occupation', 'not like', '%maintenance%')
            ->where('members.occupation', 'not like', '%spec%')
            ->where('members.occupation', 'not like', '%eng%')
            ->where('members.occupation', 'not like', '%manager%')
            ->where('members.occupation', 'not like', '%admin%')
            ->where('members.occupation', 'not like', '%director%')
            ->where('members.occupation', 'not like', '%co-or%')
            ->where('members.is_deleted', 0)
            ->get();
    }

    public function get_rest_mod_wk()
    {
        return HealthConcern::join('members', 'health_concerns.member_id', '=', 'members.id')
            ->where('health_concerns.ohc_appointment', '>', '2018-12-31')
            ->where('health_concerns.origin', 'like', 'Work%')
            ->where('health_concerns.next_step_id', '3')
            ->where('health_concerns.outcome', 'not like', '%Discharged%')
            ->where('health_concerns.current_level', 'not like', '%Discharged')
            ->where('health_concerns.is_deleted', 0)
            ->where('members.occupation', 'not like', '%maintenance%')
            ->where('members.occupation', 'not like', '%spec%')
            ->where('members.occupation', 'not like', '%eng%')
            ->where('members.occupation', 'not like', '%manager%')
            ->where('members.occupation', 'not like', '%admin%')
            ->where('members.occupation', 'not like', '%director%')
            ->where('members.occupation', 'not like', '%co-or%')
            ->where('members.is_deleted', 0)
            ->get();
    }

    public function get_all_rest_mod()
    {
        return HealthConcern::join('members', 'health_concerns.member_id', '=', 'members.id')
            ->where('health_concerns.ohc_appointment', '>', '2019-12-31')
            ->whereNotNull('health_concerns.origin')
            ->where('health_concerns.next_step_id', '3')
            ->where('health_concerns.outcome', 'not like', '%Discharged%')
            ->where('health_concerns.current_level', 'not like', '%Discharged')
            ->where('health_concerns.is_deleted', 0)
            ->where('members.occupation', 'not like', '%maintenance%')
            ->where('members.occupation', 'not like', '%spec%')
            ->where('members.occupation', 'not like', '%eng%')
            ->where('members.occupation', 'not like', '%manager%')
            ->where('members.occupation', 'not like', '%admin%')
            ->where('members.occupation', 'not like', '%director%')
            ->where('members.occupation', 'not like', '%co-or%')
            ->where('members.is_deleted', 0)
            ->get();
    }

    public function get_absent()
    {
        $today = date('Y-m-d');
        return HealthConcern::join('members', 'health_concerns.member_id', '=', 'members.id')
            ->where('health_concerns.ohc_appointment', '>', '2018-12-31')
            ->where('health_concerns.next_step_id', 4)
            ->where('health_concerns.is_deleted', 0)
            ->where('health_concerns.outcome', 'not like', '%Discharged%')
            ->where('members.occupation', 'not like', '%maintenance%')
            ->where('members.occupation', 'not like', '%spec%')
            ->where('members.occupation', 'not like', '%eng%')
            ->where('members.occupation', 'not like', '%manager%')
            ->where('members.occupation', 'not like', '%admin%')
            ->where('members.occupation', 'not like', '%director%')
            ->where('members.occupation', 'not like', '%co-or%')
            ->where('members.is_deleted', 0)
            ->get();
    }

    public function get_health_concerns($groups = null)
    {
        if($groups != null) {
            $report_data = HealthConcern::join('members', 'health_concerns.member_id', '=', 'members.id')
                ->where('health_concerns.ohc_appointment', '>', '2019-12-31')
                ->where('health_concerns.outcome', 'not like', '%Discharged')
                ->where('health_concerns.current_level', 'not like', '%Discharged')
                ->whereIn('health_concerns.group_code_id', $groups)
                ->where('health_concerns.is_deleted', 0)
                ->where('members.occupation', 'not like', '%maintenance%')
                ->where('members.occupation', 'not like', '%spec%')
                ->where('members.occupation', 'not like', '%eng%')
                ->where('members.occupation', 'not like', '%manager%')
                ->where('members.occupation', 'not like', '%admin%')
                ->where('members.occupation', 'not like', '%director%')
                ->where('members.occupation', 'not like', '%co-or%')
                ->where('members.is_deleted', 0)
                ->get();
        } else {
            $report_data = HealthConcern::join('members', 'health_concerns.member_id', '=', 'members.id')
                ->where('health_concerns.ohc_appointment', '>', '2019-12-31')
                ->where('health_concerns.outcome', 'not like', '%Discharged')
                ->where('health_concerns.current_level', 'not like', '%Discharged')
                ->where('health_concerns.is_deleted', 0)
                ->where('members.occupation', 'not like', '%maintenance%')
                ->where('members.occupation', 'not like', '%spec%')
                ->where('members.occupation', 'not like', '%eng%')
                ->where('members.occupation', 'not like', '%manager%')
                ->where('members.occupation', 'not like', '%admin%')
                ->where('members.occupation', 'not like', '%director%')
                ->where('members.occupation', 'not like', '%co-or%')
                ->where('members.is_deleted', 0)
                ->get();
        }
        return $report_data;
    }
}
