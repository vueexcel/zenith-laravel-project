<?php

namespace App\Http\Controllers\Report;

use App\Exports\HsExport;
use App\Exports\MulitpleSheetExport;
use App\Models\GroupCode;
use App\Models\OriginType;
use App\Traits\Controllers\ReportController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class MSSIncidentController extends Controller
{
    use ReportController;

    public function __construct()
    {
        $this->check_group_code('health_concerns');
    }

    public function index($report_type)
    {
        $current_year = date('Y');
        $report_params['date_type'] = 'year';
        $report_params['date_range'] = $current_year;
        $report_params['start_date'] = $current_year."-01-01";
        $report_params['end_date'] = $current_year."-12-31";
        $data = $this->get_report_data($report_type, $report_params);
        $data['report_type'] = $report_type;
        $data['report_name'] = 'mss_incidents';
        $data['current_year'] = $current_year;
        $data['title'] = 'MSS Incidents';
        switch ($report_type) {
            case 'work_mss' : $data['sub_title'] = 'Work MSS'; break;
            case 'g_mir' : $data['sub_title'] = 'G MIR'; break;
            case 'g_mir_part' : $data['sub_title'] = 'G MIR (Part)'; break;
            default : $data['sub_title'] = ''; break;
        }
        $data['action'] = route('report::mss_incidents.export_report');

        // dd($data);

        return view('report.index', $data);
    }

    public function get_report(Request $request)
    {
        $report_type = $request->get('report_type');
        $report_params = $this->get_report_params($request);
        $report_data = $this->get_report_data($report_type, $report_params);
        return view('report.list', $report_data);
    }

    public function export_report(Request $request)
    {
        $report_types = ['work_mss', 'g_mir', 'g_mir_part'];
        $report_params = $this->get_report_params($request);
        $report_data = array();
        foreach($report_types as $report_type){
            $report_data[] = $this->get_report_data($report_type, $report_params);
        }
        $file_name = "05_MSSIncidents.xlsx";
        $export_sheets = ['MSS List From Database', 'Work MSS', 'G MIR', 'G MIR (Part)'];
        $start_date = $report_params['start_date'];
        $end_date = $report_params['end_date'];
        return Excel::download(new MulitpleSheetExport($report_data, $export_sheets, $start_date, $end_date), $file_name);
    }

    public function get_report_data($report_type, $report_params)
    {
        $date_type = $report_params['date_type'];
        $date_range = $report_params['date_range'];
        $start_date = $report_params['start_date'];
        $end_date = $report_params['end_date'];

        $columns = $this->make_columns($date_type, $start_date, $end_date);
        array_push($columns, array(
            'name' => 'Total',
            'value' => 0
        ));

        $rows = Config::get('adminlte.report_groups');
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
                // $group_ids = $this->get_group_ids($group_code);
                if($date_type == "year") {
                    $reporting = "LEFT(CONVERT(varchar, ohc_appointment ,120),7)";
                } else {
                    $reporting = "LEFT(CONVERT(varchar, ohc_appointment ,120),10)";
                }
                $query = DB::table('health_concerns')
                    ->select(DB::raw('count(*) as record_count, '.$reporting.' AS reporting'))
                    // ->whereIn('group_code_id', $group_ids)
                    ->where('is_deleted', 0)
                    ->where('current_level', '!=', 'Level 1 - Discharged')
                    ->where('ohc_appointment', '>=', $start_date)
                    ->where('ohc_appointment', '<=', $end_date);

                if($report_type == "work_mss") {
                    $origin_type = OriginType::where('origin_type', 'MSS')->get()->first();
                    $query = $query->where('origin_type_id', $origin_type->id)->where('origin', 'Work');
                    // $query = $query->whereBetween('mss_causation_id', [1, 18]);
                }
                if($report_type == "g_mir") {
                    $query = $query->where('gmir', 'GMIR_Full');
                }
                if($report_type == "g_mir_part") {
                    $query = $query->where('gmir', 'GMIR_Part');
                }

                $records = $query->groupBy(DB::raw($reporting))
                    ->orderBy(DB::raw($reporting))
                    ->get();
                foreach ($records as $record) {
                    $column_last_index = count($columns) - 1;
                    foreach ($columns as $c_index => $column) {
                        $date_string = $this->get_date_string($date_type, $date_range, $column);
                        if($record->reporting == $date_string) {
                            $rows[$key]['groups'][$index]['columns'][$c_index]['value'] = $record-> record_count;
                            $rows[$key]['groups'][$index]['columns'][$column_last_index]['value'] += $record-> record_count;
                            $rows[$key]['columns'][$c_index]['value'] += $record-> record_count;
                            $rows[$key]['columns'][$column_last_index]['value'] += $record-> record_count;

                            if($group_code == "J5" || $group_code == "JC" || $group_code == "JD") {
                                $j5_c_d[$c_index]['value'] += $record-> record_count;
                                $j5_c_d[$column_last_index]['value'] += $record-> record_count;
                            }

                            if($group_code == "J6" || $group_code == "JA" || $group_code == "JB") {
                                $j6_a_b[$c_index]['value'] += $record-> record_count;
                                $j6_a_b[$column_last_index]['value'] += $record-> record_count;
                            }

                            if($group_code == "GA" || $group_code == "GF" || $group_code == "GG") {
                                $ga_f_g[$c_index]['value'] += $record-> record_count;
                                $ga_f_g[$column_last_index]['value'] += $record-> record_count;
                            }

                            if($key != 'H') {
                                $burnaston[$c_index]['value'] += $record-> record_count;
                                $burnaston[$column_last_index]['value'] += $record-> record_count;
                            }

                            $tmuk[$c_index]['value'] += $record-> record_count;
                            $tmuk[$column_last_index]['value'] += $record-> record_count;

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
