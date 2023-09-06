<?php

namespace App\Http\Controllers\Report;

use App\Exports\AllAccidentExport;
use App\Exports\AllHealthConcernsExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class AllRecordController extends Controller
{
    //
    public function all_accidents()
    {
        $data = array();
        $data['title'] = 'All Accident Export';
        $data['sub_title'] = '';
        return view('report.all_report', $data);
        //return Excel::download(new AllAccidentExport(), 'All Accidents.xlsx');
    }

    public function all_health_concerns()
    {
        $data = array();
        $data['title'] = 'All Health Concerns Export';
        $data['sub_title'] = '';
        return view('report.all_report', $data);
        //return Excel::download(new AllHealthConcernsExport(), 'All Health Concerns.xlsx');
    }

    public function all_record_export(Request $request)
    {
        $start = $this->convertDateString($request->get('from_date'));
        $end = $this->convertDateString($request->get('to_date'));
        $report_target = $request->get('report_target');
        if($report_target == "All Health Concerns Export")
            return Excel::download(new AllHealthConcernsExport($start, $end), 'All Health Concerns.xlsx');
        else
            return Excel::download(new AllAccidentExport($start, $end), 'All Accidents.xlsx');

    }
}
