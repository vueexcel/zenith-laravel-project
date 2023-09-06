<?php

namespace App\Http\Controllers\Report;

use App\Exports\HsExport;
use App\Exports\MulitpleSheetExport;
use App\Models\GirDefinition;
use App\Models\GroupCode;
use App\Models\OriginType;
use App\Traits\Controllers\ReportController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class MasterKPIController extends Controller
{
    //
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
        $start_date = $current_year."-01-01";
        $end_date = date("Y-m-d", strtotime("last day of previous month"));
        switch ($report_type) {
            case 'tmuk_b' : $file_name="Zenith Master KPI - TMUK-B.xlsx"; break;
            case 'tmuk_d' : $file_name="Zenith Master KPI - TMUK-D.xlsx"; break;
            default : $data['sub_title'] = ''; $file_name="Zenith Master KPI.xlsx"; break;
        }
        $export_sheets = ['Accident List From Database', 'MSS List From Database'];
        $report_data = array();
        return Excel::download(new MulitpleSheetExport($report_data, $export_sheets, $start_date, $end_date, $report_type), $file_name);
    }
}
