<?php

namespace App\Http\Controllers\Report;

use App\Exports\DailyRestrictionStatusExport;
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

class DailyRestrictionStatusController extends Controller
{
    use ReportController;

    public function __construct()
    {
        //$this->check_group_code('health_concerns');
    }

    public function index()
    {
        $report_data = array();
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
        return Excel::download(new DailyRestrictionStatusExport($export_sheets), $file_name);
    }
}
