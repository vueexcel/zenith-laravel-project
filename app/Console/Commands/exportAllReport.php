<?php

namespace App\Console\Commands;

use App\Exports\DailyRestrictionStatusExport;
use App\Exports\MulitpleSheetExport;
use App\Models\GirDefinition;
use App\Models\GroupCode;
use App\Models\OriginType;
use App\Models\Setting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class exportAllReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:exportAllReport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is a command for export all report.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        dd('shshs');
        $year = date('Y');
        $start_date = $year."-01-01";
        $end_date = $year."-12-31";
        $setting = Setting::where('set_type', 'export_options')->get()->first();
        $export_options = explode(",", $setting->set_value);

        if(in_array('all_accidents', $export_options)) {
            //All Accident
            $report_types = ['all', 'first_aid', 'gir', 'stop_6'];
            $report_data = array();
            foreach($report_types as $report_type){
                $report_data[] = $this->get_all_accident_data($report_type, $start_date, $end_date);
            }

            $file_name = '04_AllAccidents.xlsx';
            $export_sheets = ['Accident List From Database', 'All Accidents', '1st Aid Accidents', 'GIR Accidents', 'Stop-6 Accidents'];
            Excel::store(new MulitpleSheetExport($report_data, $export_sheets, $start_date, $end_date), $file_name, 'export');
        }

        //Contract Accidents
        if(in_array('contractor_accidents', $export_options)) {
            $report_types = ['all'];
            $report_data = array();
            foreach($report_types as $report_type){
                $report_data[] = $this->get_contractor_accident_data($start_date, $end_date);
            }
            $export_sheets = ['Contractor Accidents From Database', 'Contract Accidents'];
            $file_name = '12_ContractorAccidents.xlsx';
            Excel::store(new MulitpleSheetExport($report_data, $export_sheets, $start_date, $end_date), $file_name, 'export');
        }


        //Illness Incident
        if(in_array('illness_incidents', $export_options)) {
            $report_types = ['all'];
            $report_data = array();
            foreach($report_types as $report_type){
                $report_data[] = $this->get_illness_incident_data($start_date, $end_date);
            }
            $file_name = "07_IllnessIncidents.xlsx";
            $export_sheets = ['Illness List From Database', 'Work Illness'];
            Excel::store(new MulitpleSheetExport($report_data, $export_sheets, $start_date, $end_date), $file_name, 'export');
        }


        //LostTime Incident
        if(in_array('lost_incidents', $export_options)) {
            $report_types = ['all'];
            $report_data = array();
            foreach($report_types as $report_type){
                $report_data[] = $this->get_lt_incident_data($start_date, $end_date);
            }
            $file_name = "03_LostTimeIncidents.xlsx";
            $export_sheets = ['LT Accident List From Database', 'LT MSS List From Database', 'LT Incidents'];
            Excel::store(new MulitpleSheetExport($report_data, $export_sheets, $start_date, $end_date), $file_name, 'export');
        }


        //MSS Incident
        if(in_array('mss_incidents', $export_options)) {
            $report_types = ['work_mss', 'g_mir', 'g_mir_part'];
            $report_data = array();
            foreach($report_types as $report_type){
                $report_data[] = $this->get_mss_incident_data($report_type, $start_date, $end_date);
            }
            $file_name = "05_MSSIncidents.xlsx";
            $export_sheets = ['MSS List From Database', 'Work MSS', 'G MIR', 'G MIR (Part)'];
            Excel::store(new MulitpleSheetExport($report_data, $export_sheets, $start_date, $end_date), $file_name, 'export');
        }


        //Near Miss
        if(in_array('near_misses', $export_options)) {
            $report_types = ['all'];
            $report_data = array();
            foreach($report_types as $report_type){
                $report_data[] = $this->get_near_miss_data($start_date, $end_date);
            }
            $file_name = "08_NearMisses.xlsx";
            $export_sheets = ['Near Miss List from SIRS, Database', 'Near Miss Incidents'];
            Excel::store(new MulitpleSheetExport($report_data, $export_sheets, $start_date, $end_date), $file_name, 'export');
        }

        //Restriction Cost
        if(in_array('restriction_cost', $export_options)) {
            $report_types = ['days', 'cost'];
            $report_data = array();
            foreach($report_types as $report_type){
                $report_data[] = $this->get_restriction_data($report_type, $start_date, $end_date);
            }
            $file_name = "10_RestrictionCost.xlsx";
            $export_sheets = ['Restricted & Absent Cases, Database', 'Days', 'Cost'];
            Excel::store(new MulitpleSheetExport($report_data, $export_sheets, $start_date, $end_date), $file_name, 'export');
        }


        //Riddor Incident
        if(in_array('riddor_incidents', $export_options)) {
            $report_types = ['all'];
            $report_data = array();
            foreach($report_types as $report_type){
                $report_data[] = $this->get_riddor_incident_data($start_date, $end_date);
            }
            $file_name = "09_RIDDORIncidents.xlsx";
            $export_sheets = ['RIDDOR List From Database', 'RIDDOR Industrial Disease List From Database', 'RIDDOR Dashboard'];
            Excel::store(new MulitpleSheetExport($report_data, $export_sheets, $start_date, $end_date), $file_name, 'export');
        }


        //Work Other Incident
        if(in_array('work_other_incidents', $export_options)) {
            $report_types = ['all'];
            $report_data = array();
            foreach($report_types as $report_type){
                $report_data[] = $this->get_work_other_incident_data($start_date, $end_date);
            }
            $file_name = "11_WorkOtherIncidents.xlsx";
            $export_sheets = ['Other List From Database', 'Work Other'];
            Excel::store(new MulitpleSheetExport($report_data, $export_sheets, $start_date, $end_date), $file_name, 'export');
        }

        //Daily Restriction Status
        if(in_array('daily_restriction_status', $export_options)) {
            $file_name = "Zenith Daily Restriction Data.xlsx";
            $export_sheets = [
                'All Health Concerns',
                //'Main Page',
                //'All Absent',
                'Ramp-up',
                'Rest & Mod < 100% NWK',
                'Rest & Mod < 100% WK',
                'Absent',
                'Red Flex Not Working',
                'Maternity',
                //'All Rest & Mod Days',
                'New Restricted Cases',
                //'Raw List',
                //'Combined List',
                //'Summary PPR',
                //'Summary',
                //'Today',
                'Total Health Concerns',
                //'Combined List No Absence',
                'Burnaston Health Concerns',
                'Deeside Health Concerns',
            ];
            Excel::store(new DailyRestrictionStatusExport($export_sheets), $file_name, 'export');
        }

        //Master KPI
        if(in_array('master_kpi', $export_options)) {
            $current_year = date('Y');
            $report_params['date_type'] = 'year';
            $report_params['date_range'] = $current_year;
            $start_date = $current_year."-01-01";
            $end_date = date("Y-m-d", strtotime("last day of previous month"));
            $report_types = array('tmuk_b', 'tmuk_d');
            foreach ($report_types as $report_type) {
                switch ($report_type) {
                    case 'tmuk_b' : $file_name="Zenith Master KPI - TMUK-B.xlsx"; break;
                    case 'tmuk_d' : $file_name="Zenith Master KPI - TMUK-D.xlsx"; break;
                    default : $data['sub_title'] = ''; $file_name="Zenith Master KPI.xlsx"; break;
                }
                $export_sheets = ['Accident List From Database', 'MSS List From Database'];
                $report_data = array();
                Excel::store(new MulitpleSheetExport($report_data, $export_sheets, $start_date, $end_date, $report_type), $file_name, 'export');
            }
        }
        echo "Exporting done";
    }

    public function get_all_accident_data($report_type, $start_date, $end_date)
    {
        $year = date('Y');
        $columns = $this->get_columns();
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
                $group_ids = $this->get_group_ids($group_code);
                $reporting = "LEFT(CONVERT(varchar, accident_date ,120),7)";
                $query = DB::table('accidents')
                    ->select(DB::raw('count(*) as accident_count, '.$reporting.' AS reporting'))
                    ->whereIn('group_code_id', $group_ids)
                    ->where('is_deleted', 0)
                    ->where('accident_date', '>=', $start_date)
                    ->where('accident_date', '<=', $end_date)
                    ->where('causation_factor_id', '>', 3);

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
                        $date_string = $this->get_date_string($year, $column);
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

    public function get_company_statistics_data($report_type, $start_date, $end_date)
    {
        $year = date('Y');
        $columns = $this->get_columns();

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
                $group_ids = $this->get_group_ids($group_code);
                $reporting = "LEFT(CONVERT(varchar, ohc_appointment ,120),7)";
                $query = DB::table('health_concerns')
                    ->select(DB::raw('count(*) as record_count, '.$reporting.' AS reporting'))
                    ->whereIn('group_code_id', $group_ids)
                    ->where('is_deleted', 0)
                    ->where('current_level', '!=', 'Level 1 - Discharged')
                    ->where('ohc_appointment', '>=', $start_date)
                    ->where('ohc_appointment', '<=', $end_date);

                $records = $query->groupBy(DB::raw($reporting))
                    ->orderBy(DB::raw($reporting))
                    ->get();

                foreach ($records as $record) {
                    $column_last_index = count($columns) - 1;
                    foreach ($columns as $c_index => $column) {
                        $date_string = $this->get_date_string($year, $column);
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

    public function get_contractor_accident_data($start_date, $end_date)
    {
        $year = date('Y');
        $columns = $this->get_columns();
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
                $group_ids = $this->get_group_ids($group_code);
                $reporting = "LEFT(CONVERT(varchar, accident_date ,120),7)";
                $query = DB::table('contractor_accidents')
                    ->select(DB::raw('count(*) as record_count, '.$reporting.' AS reporting'))
                    ->whereIn('group_code_id', $group_ids)
                    ->where('is_deleted', 0)
                    ->where('accident_date', '>=', $start_date)
                    ->where('accident_date', '<=', $end_date);

                $records = $query->groupBy(DB::raw($reporting))
                    ->orderBy(DB::raw($reporting))
                    ->get();

                foreach ($records as $record) {
                    $column_last_index = count($columns) - 1;
                    foreach ($columns as $c_index => $column) {
                        $date_string = $this->get_date_string($year, $column);
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

    public function get_illness_incident_data($start_date, $end_date)
    {
        $year = date('Y');
        $columns = $this->get_columns();

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
                $group_ids = $this->get_group_ids($group_code);
                $reporting = "LEFT(CONVERT(varchar, ohc_appointment ,120),7)";
                $query = DB::table('health_concerns')
                    ->select(DB::raw('count(*) as record_count, '.$reporting.' AS reporting'))
                    ->whereIn('group_code_id', $group_ids)
                    ->where('is_deleted', 0)
                    ->where('current_level', '!=', 'Level 1 - Discharged')
                    ->where('origin',  'Work')
                    ->where('ohc_appointment', '>=', $start_date)
                    ->where('ohc_appointment', '<=', $end_date);

                $origin_type = OriginType::where('origin_type', 'Illness')->get()->first();
                $query = $query->where('origin_type_id', $origin_type->id);

                $records = $query->groupBy(DB::raw($reporting))
                    ->orderBy(DB::raw($reporting))
                    ->get();

                foreach ($records as $record) {
                    $column_last_index = count($columns) - 1;
                    foreach ($columns as $c_index => $column) {
                        $date_string = $this->get_date_string($year, $column);
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

    public function get_lt_incident_data($start_date, $end_date)
    {
        $year = date('Y');
        $columns = $this->get_columns();
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
                $group_ids = $this->get_group_ids($group_code);

                //Health Concerns Table
                $reporting = "LEFT(CONVERT(varchar, ohc_appointment ,120),7)";
                $query = DB::table('health_concerns')
                    ->select(DB::raw('count(*) as record_count, '.$reporting.' AS reporting'))
                    ->whereIn('group_code_id', $group_ids)
                    ->where('is_deleted', 0)
                    ->where(function($query){
                        $query->where('origin', 'Work');
                        $query->orWhere('origin', 'Work Aggravated');
                    })
                    ->where('lost_time_mss', 'Yes')
                    ->where('ohc_appointment', '>=', $start_date)
                    ->where('ohc_appointment', '<=', $end_date);

                $origin_type = OriginType::where('origin_type', 'MSS')->get()->first();
                $query = $query->where('origin_type_id', $origin_type->id);

                $records = $query->groupBy(DB::raw($reporting))
                    ->orderBy(DB::raw($reporting))
                    ->get();

                foreach ($records as $record) {
                    $column_last_index = count($columns) - 1;
                    foreach ($columns as $c_index => $column) {
                        $date_string = $this->get_date_string($year, $column);
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


                //Accident Table
                $reporting = "LEFT(CONVERT(varchar, accident_date ,120),7)";
                $query = DB::table('accidents')
                    ->select(DB::raw('count(*) as record_count, '.$reporting.' AS reporting'))
                    ->whereIn('group_code_id', $group_ids)
                    ->where('is_deleted', 0)
                    ->where('accident_date', '>=', $start_date)
                    ->where('accident_date', '<=', $end_date)
                    ->where('escalation', 'Lost Time');

                $records = $query->groupBy(DB::raw($reporting))
                    ->orderBy(DB::raw($reporting))
                    ->get();

                foreach ($records as $record) {
                    $column_last_index = count($columns) - 1;
                    foreach ($columns as $c_index => $column) {
                        $date_string = $this->get_date_string($year, $column);
                        if($record->reporting == $date_string) {
                            $rows[$key]['groups'][$index]['columns'][$c_index]['value'] += $record-> record_count;
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

    public function get_mss_incident_data($report_type, $start_date, $end_date)
    {
        $year = date('Y');
        $columns = $this->get_columns();
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
                $group_ids = $this->get_group_ids($group_code);
                $reporting = "LEFT(CONVERT(varchar, ohc_appointment ,120),7)";
                $query = DB::table('health_concerns')
                    ->select(DB::raw('count(*) as record_count, '.$reporting.' AS reporting'))
                    ->whereIn('group_code_id', $group_ids)
                    ->where('is_deleted', 0)
                    ->where('current_level', '!=', 'Level 1 - Discharged')
                    ->where('ohc_appointment', '>=', $start_date)
                    ->where('ohc_appointment', '<=', $end_date);

                if($report_type == "work_mss") {
                    $origin_type = OriginType::where('origin_type', 'MSS')->get()->first();
                    $query = $query->where('origin_type_id', $origin_type->id)->where('origin', 'Work');
                    $query = $query->whereBetween('mss_causation_id', [1, 18]);
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
                        $date_string = $this->get_date_string($year, $column);
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

    public function get_near_miss_data($start_date, $end_date)
    {
        $year = date('Y');
        $columns = $this->get_columns();

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
                $group_ids = $this->get_group_ids($group_code);
                $reporting = "LEFT(CONVERT(varchar, ohc_appointment ,120),7)";
                $query = DB::table('health_concerns')
                    ->select(DB::raw('count(*) as record_count, '.$reporting.' AS reporting'))
                    ->whereIn('group_code_id', $group_ids)
                    ->where('is_deleted', 0)
                    ->where('current_level', '!=', 'Level 1 - Discharged')
                    ->where('ohc_appointment', '>=', $start_date)
                    ->where('ohc_appointment', '<=', $end_date)
                    ->where('riddor', '!=', 'No');

                $records = $query->groupBy(DB::raw($reporting))
                    ->orderBy(DB::raw($reporting))
                    ->get();

                foreach ($records as $record) {
                    $column_last_index = count($columns) - 1;
                    foreach ($columns as $c_index => $column) {
                        $date_string = $this->get_date_string($year, $column);
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

    public function get_restriction_data($report_type, $start_date, $end_date)
    {
        $year = date('Y');
        $columns = $this->get_columns();

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
                $group_ids = $this->get_group_ids($group_code);
                $reporting = "LEFT(CONVERT(varchar, ohc_appointment ,120),7)";
                $query = DB::table('health_concerns')
                    ->select(DB::raw('count(*) as record_count, '.$reporting.' AS reporting'))
                    ->whereIn('group_code_id', $group_ids)
                    ->where('is_deleted', 0)
                    ->where('current_level', '!=', 'Level 1 - Discharged')
                    ->where('ohc_appointment', '>=', $start_date)
                    ->where('ohc_appointment', '<=', $end_date);

                if($report_type == "days") {

                }
                if($report_type == "cost") {

                }

                $records = $query->groupBy(DB::raw($reporting))
                    ->orderBy(DB::raw($reporting))
                    ->get();

                foreach ($records as $record) {
                    $column_last_index = count($columns) - 1;
                    foreach ($columns as $c_index => $column) {
                        $date_string = $this->get_date_string($year, $column);
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

    public function get_riddor_incident_data($start_date, $end_date)
    {
        $year = date('Y');
        $columns = $this->get_columns();
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
                $group_ids = $this->get_group_ids($group_code);
                $reporting = "LEFT(CONVERT(varchar, ohc_appointment ,120),7)";
                $query = DB::table('health_concerns')
                    ->select(DB::raw('count(*) as record_count, '.$reporting.' AS reporting'))
                    ->whereIn('group_code_id', $group_ids)
                    ->where('is_deleted', 0)
                    ->where('current_level', '!=', 'Level 1 - Discharged')
                    ->where('ohc_appointment', '>=', $start_date)
                    ->where('ohc_appointment', '<=', $end_date)
                    ->where('riddor', '!=', 'No');

                $records = $query->groupBy(DB::raw($reporting))
                    ->orderBy(DB::raw($reporting))
                    ->get();

                foreach ($records as $record) {
                    $column_last_index = count($columns) - 1;
                    foreach ($columns as $c_index => $column) {
                        $date_string = $this->get_date_string($year, $column);
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

    public function get_work_other_incident_data($start_date, $end_date)
    {
        $year = date('Y');
        $columns = $this->get_columns();

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
                $group_ids = $this->get_group_ids($group_code);
                $reporting = "LEFT(CONVERT(varchar, ohc_appointment ,120),7)";
                $query = DB::table('health_concerns')
                    ->select(DB::raw('count(*) as record_count, '.$reporting.' AS reporting'))
                    ->whereIn('group_code_id', $group_ids)
                    ->where('is_deleted', 0)
                    ->where(function($query){
                        $origin_type = OriginType::where('origin_type', 'Other')->get()->first();
                        $origin_type2 = OriginType::where('origin_type', 'MSS')->get()->first();
                        $query->where('origin',  'Work')->where('origin_type_id', $origin_type->id);
                        $query->orWhere('origin',  'Work Aggravated')->where('origin_type_id', $origin_type2->id);
                    })
                    //->where('current_level', '!=', 'Level 1 - Discharged')
                    ->where('ohc_appointment', '>=', $start_date)
                    ->where('ohc_appointment', '<=', $end_date);

                $records = $query->groupBy(DB::raw($reporting))
                    ->orderBy(DB::raw($reporting))
                    ->get();

                foreach ($records as $record) {
                    $column_last_index = count($columns) - 1;
                    foreach ($columns as $c_index => $column) {
                        $date_string = $this->get_date_string($year, $column);
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

    public function get_columns()
    {
        $columns = array();
        for($month = 1; $month < 13; $month++){
            array_push($columns, array(
                'name' => $month,
                'value' => 0
            ));
        }
        array_push($columns, array(
            'name' => 'Total',
            'value' => 0
        ));
        return $columns;
    }

    public function get_date_string($year, $column)
    {
        $month = intval($column['name']);
        if($month < 10)
            $str_month = "0".$month;
        else
            $str_month = $month;
        return $year."-".$str_month;
    }

    public function get_group_ids($group_code)
    {
        if($group_code != 'H')
            $group_ids = GroupCode::where('group_code', 'like', $group_code.'%')->pluck('id')->toArray();
        else {
            $group_ids= GroupCode::where('group_code', 'like', $group_code.'%')
                ->where('group_code', 'not like', "H1%")
                ->where('group_code', 'not like', "H25%")
                ->where('group_code', 'not like', "H28%")
                ->where('group_code', 'not like', "H3%")
                ->where('group_code', 'not like', "H4%")
                ->where('group_code', 'not like', "H5%")
                ->where('group_code', 'not like', "H6%")
                ->where('group_code', 'not like', "H9%")
                ->pluck('id')->toArray();
        }
        return $group_ids;
    }
}
