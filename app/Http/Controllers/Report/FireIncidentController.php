<?php

namespace App\Http\Controllers\Report;

use App\Exports\AccidentExport;
use App\Models\GirDefinition;
use App\Models\GroupCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class FireIncidentController extends Controller
{
    //
    public function index()
    {
        $current_year = date('Y');
        $report_type = 'all';
        $data = $this->get_report_data($report_type, 'year', $current_year);
        $data['report_type'] = $report_type;
        $data['current_year'] = $current_year;
        $data['sub_title'] = '';
        return view('report.fires_incidents.index', $data);
    }

    public function get_report(Request $request)
    {
        $report_data = $this->get_report_data_with_post($request);
        return view('report.fires_incidents.list', $report_data);
    }

    public function export_report(Request $request)
    {
        $report_data = $this->get_report_data_with_post($request);
        $file_name = "fires_incidents.xlsx";
        return Excel::download(new AccidentExport($report_data), $file_name);
    }

    public function get_report_data_with_post(Request $request)
    {
        $report_type = $request->get('report_type');
        $date_type = $request->get('date_type');
        $date_range = null;
        $from_date = null;
        $to_date = null;
        if($date_type == "year") {
            $date_range = $request->get('year_picker');
        }
        else if($date_type == "month") {
            $date_range = $request->get('month_picker');
        } else if($date_type == "week") {
            $date_range = $request->get('week_picker');
        } else {
            $from_date = $this->convertDateString($request->get('from_date'));
            $to_date = $this->convertDateString($request->get('to_date'));
        }

        return $this->get_report_data($report_type, $date_type, $date_range, $from_date, $to_date);
    }

    public function get_report_data($report_type, $date_type, $date_range = null, $from_date = null, $to_date = null)
    {
        $rows = Config::get('adminlte.report_groups');
        $columns = array();
        if($date_type == "year") {
            for($month = 1; $month < 13; $month++){
                array_push($columns, array(
                    'name' => $month,
                    'value' => 0
                ));
            }
        }
        else if($date_type == "month") {
            $year_month = explode("/", $date_range);
            $first_day = $year_month[1]."-".$year_month[0]."-01";
            $last_day = intval(date("t", strtotime($first_day))) + 1;
            for($day = 1; $day < $last_day; $day++){
                array_push($columns, array(
                    'name' => $day,
                    'value' => 0
                ));
            }
        }
        else if($date_type == "week") {
            $week = explode(" - ", $date_range);
            $week_start = $this->convertDateString($week[0]);
            $week_end = $this->convertDateString($week[1]);
            $start_date = $week_start;
            while($start_date <= $week_end) {
                array_push($columns, array(
                    'name' => date('d/m/Y', strtotime($start_date)),
                    'value' => 0
                ));
                $start_date = date('Y-m-d', strtotime("+1 day", strtotime($start_date)));
            }
        }
        else {
            $start = $from_date;
            $end = $to_date;
            $start_date = $start;
            while($start_date <= $end) {
                array_push($columns, array(
                    'name' => date('d/m/Y', strtotime($start_date)),
                    'value' => 0
                ));
                $start_date = date('Y-m-d', strtotime("+1 day", strtotime($start_date)));
            }
        }

        array_push($columns, array(
            'name' => 'Total',
            'value' => 0
        ));

        $j5_c_d = $columns;
        $j6_a_b = $columns;
        $ga_f_g = $columns;
        $burnaston = $columns;
        $tmuk = $columns;

        foreach ($rows as $key => $row){
            $rows[$key]['columns'] = $columns;
            $groups = $row['groups'];
            foreach($groups as $index => $group){
                $group_code = str_replace("?", "", $group['code']);
                $rows[$key]['groups'][$index]['columns'] = $columns;
                $group_ids = GroupCode::where('group_code', 'like', $group_code.'%')->pluck('id')->toArray();
                if($date_type == "year") {
                    $year = $date_range;
                    $reporting = "LEFT(CONVERT(varchar, accident_date ,120),7)";
                    $start = $year."-01-01";
                    $end = $year."-12-31";
                } else if($date_type == "month") {
                    $year_month = explode("/", $date_range);
                    $year = $year_month[1];
                    $month = $year_month[0];
                    $reporting = "LEFT(CONVERT(varchar, accident_date ,120),10)";
                    $start = $year."-".$month."-01";
                    $end = date('Y-m-t', strtotime($start));
                } else if($date_type == "week") {
                    $reporting = "LEFT(CONVERT(varchar, accident_date ,120),10)";
                    $start = $week_start;
                    $end = $week_end;
                }
                else {
                    $reporting = "LEFT(CONVERT(varchar, accident_date ,120),10)";
                    $start = $from_date;
                    $end = $to_date;
                }
                $query = DB::table('accidents')
                    ->select(DB::raw('count(*) as accident_count, '.$reporting.' AS reporting'))
                    ->whereIn('group_code_id', $group_ids)
                    ->where('accident_date', '>=', $start)
                    ->where('accident_date', '<=', $end);

                if($report_type == "first_aid") {
                    $gir_definition = GirDefinition::where('definition', 'First Aid')->get()->first();
                    $query = $query->where('gir_definition_id', $gir_definition->id);
                }
                if($report_type == "gir") {
                    $gir_definitions = GirDefinition::where('definition', 'Lost Time')->orWhere('definition', 'Non Lost Time')->pluck('id')->toArray();
                    $query = $query->whereIn('gir_definition_id', $gir_definitions);
                }
                if($report_type == "stop_6") {
                    $query = $query->where('stop_6', 'yes');
                }

                $accidents = $query->groupBy(DB::raw($reporting))
                    ->orderBy(DB::raw($reporting))
                    ->get();

                foreach ($accidents as $accident) {
                    $column_last_index = count($columns) - 1;
                    foreach ($columns as $c_index => $column) {
                        if($date_type == "year") {
                            $year = $date_range;
                            $month = $column['name'];
                            if($month < 10)
                                $str_month = "0".$month;
                            else
                                $str_month = $month;
                            $date_string = $year."-".$str_month;
                        } else if($date_type == "month") {
                            $year_month = explode("/", $date_range);
                            $year = $year_month[1];
                            $month = $year_month[0];
                            $day = $column['name'];
                            if($day < 10)
                                $str_day = "0".$month;
                            else
                                $str_day = $month;
                            $date_string = $year."-".$month."-".$str_day;
                        } else {
                            if($column['name'] != 'Total')
                                $date_string = $this->convertDateString($column['name']);
                            else
                                $date_string = 'Total';
                        }

                        if($accident->reporting == $date_string) {
                            $rows[$key]['groups'][$index]['columns'][$c_index]['value'] = $accident-> accident_count;
                            $rows[$key]['groups'][$index]['columns'][$column_last_index]['value'] += $accident-> accident_count;
                            $rows[$key]['columns'][$c_index]['value'] += $accident-> accident_count;
                            $rows[$key]['columns'][$column_last_index]['value'] += $accident-> accident_count;

                            if($group_code == "J5" || $group_code == "JC" || $group_code == "JD") {
                                $j5_c_d[$c_index]['value'] += $accident-> accident_count;
                                $j5_c_d[$column_last_index]['value'] += $accident-> accident_count;
                            }

                            if($group_code == "J6" || $group_code == "JA" || $group_code == "JB") {
                                $j6_a_b[$c_index]['value'] += $accident-> accident_count;
                                $j6_a_b[$column_last_index]['value'] += $accident-> accident_count;
                            }

                            if($group_code == "GA" || $group_code == "GF" || $group_code == "GG") {
                                $ga_f_g[$c_index]['value'] += $accident-> accident_count;
                                $ga_f_g[$column_last_index]['value'] += $accident-> accident_count;
                            }

                            if($key != 'H') {
                                $burnaston[$c_index]['value'] += $accident-> accident_count;
                                $burnaston[$column_last_index]['value'] += $accident-> accident_count;
                            }

                            $tmuk[$c_index]['value'] += $accident-> accident_count;
                            $tmuk[$column_last_index]['value'] += $accident-> accident_count;

                            break;
                        }
                    }
                }
            }
        }

        $data['j5_c_d'] = $j5_c_d;
        $data['j6_a_b'] = $j6_a_b;
        $data['ga_f_g'] = $ga_f_g;
        $data['burnaston'] = $burnaston;
        $data['tmuk'] = $tmuk;
        $data['rows'] = $rows;
        $data['columns'] = $columns;
        return $data;
    }
}
