<?php

namespace App\Http\Controllers\Report;

use App\Exports\AllHealthConcernsExport;
use App\Exports\HsByMemberExport;
use App\Exports\HsExport;
use App\Exports\MulitpleSheetExport;
use App\Models\GroupCode;
use App\Models\HealthConcern;
use App\Models\OriginType;
use App\Traits\Controllers\ReportController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class HealthConcernByMemberController extends Controller
{

    public function index()
    {
        $data = array();
        $data['title'] = 'Health Concern By Member';
        $data['sub_title'] = '';
        return view('report.health_concern_by_member', $data);
    }

    public function get_report(Request $request)
    {
        $member_id = $request->get('id');
        $report_data = $this->get_report_data($member_id);
        $data['report_data'] = $report_data;
        return view('report.health_concerns_list', $data);
    }

    public function export_report(Request $request)
    {
        $member_id = $request->get('member_id');
        $file_name = "health_concerns_by_member.xlsx";
        return Excel::download(new HsByMemberExport($member_id), $file_name);
    }

    public function get_report_data($member_id)
    {
        $data = HealthConcern::with('member')
            ->where('member_id', $member_id)
            ->where('is_deleted', 0)
            ->orderBy('logged_date', 'DESC')
            ->get();
        return $data;
    }
}
