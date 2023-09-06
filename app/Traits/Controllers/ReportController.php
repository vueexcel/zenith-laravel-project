<?php

namespace App\Traits\Controllers;

use App\Models\Accident;
use App\Models\ContractorAccident;
use App\Models\GroupCode;
use App\Models\HealthConcern;
use Illuminate\Http\Request;

trait ReportController {

    public function make_columns($date_type, $from_date, $to_date)
    {
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
            $last_day = intval(date("t", strtotime($from_date))) + 1;
            for($day = 1; $day < $last_day; $day++){
                array_push($columns, array(
                    'name' => $day,
                    'value' => 0
                ));
            }
        }
        else if($date_type == "week") {
            $start_date = $from_date;
            while($start_date <= $to_date) {
                array_push($columns, array(
                    'name' => date('d/m/Y', strtotime($start_date)),
                    'value' => 0
                ));
                $start_date = date('Y-m-d', strtotime("+1 day", strtotime($start_date)));
            }
        }
        else {
            $start_date = $from_date;
            while($start_date <= $to_date) {
                array_push($columns, array(
                    'name' => date('d/m/Y', strtotime($start_date)),
                    'value' => 0
                ));
                $start_date = date('Y-m-d', strtotime("+1 day", strtotime($start_date)));
            }
        }
        return $columns;
    }

    public function get_report_params(Request $request)
    {
        $date_type = $request->get('date_type');
        $date_range = null;
        $from_date = null;
        $to_date = null;
        if($date_type == "year") {
            $date_range = $request->get('year_picker');
            $start = $date_range."-01-01";
            $end = $date_range."-12-31";
        }
        else if($date_type == "month") {
            $date_range = $request->get('month_picker');
            $year_month = explode("/", $date_range);
            $year = $year_month[1];
            $month = $year_month[0];
            $start = $year."-".$month."-01";
            $end = date('Y-m-t', strtotime($start));
        } else if($date_type == "week") {
            $date_range = $request->get('week_picker');
            $week = explode(" - ", $date_range);
            $start = $this->convertDateString($week[0]);
            $end = $this->convertDateString($week[1]);
        } else {
            $start = $this->convertDateString($request->get('from_date'));
            $end = $this->convertDateString($request->get('to_date'));
        }

        $params['date_type'] = $date_type;
        $params['date_range'] = $date_range;
        $params['start_date'] = $start;
        $params['end_date'] = $end;
        return $params;
    }

    public function get_date_string($date_type, $date_range, $column)
    {
        if($date_type == "year") {
            $year = $date_range;
            $month = intval($column['name']);
            if($month < 10)
                $str_month = "0".$month;
            else
                $str_month = $month;
            $date_string = $year."-".$str_month;
        } else if($date_type == "month") {
            $year_month = explode("/", $date_range);
            $year = $year_month[1];
            $month = $year_month[0];
            $day = intval($column['name']);
            if($day < 10)
                $str_day = "0".$day;
            else
                $str_day = $day;
            $date_string = $year."-".$month."-".$str_day;
        } else {
            if($column['name'] != 'Total')
                $date_string = $this->convertDateString($column['name']);
            else
                $date_string = 'Total';
        }
        return $date_string;
    }

    public function get_group_ids($group_code)
    {
        $group_ids = array();
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

    public function check_group_code($table)
    {
        if($table == "health_concerns") {
            $items = HealthConcern::whereNull('group_code_id')->orWhere('group_code_id', '')->get();
            foreach ($items as $item) {
                $member_group_code = $item->member['group_code'];
                $group = GroupCode::where('group_code', $member_group_code)->first();
                if ($group) {
                    $item->group_code_id = $group->id;
                    $item->save();
                }
            }
        } else if($table == "accidents") {

            $items = Accident::whereNull('group_code_id')->orWhere('group_code_id', '')->get();
            // var_dump($items);
            foreach ($items as $item) {
                $member_group_code = $item->member['group_code'];
                $group = GroupCode::where('group_code', $member_group_code)->first();
                if ($group) {
                    $item->group_code_id = $group->id;
                    $item->save();
                }
            }
        } else {
            $items = ContractorAccident::whereNull('group_code_id')->orWhere('group_code_id', '')->get();
            foreach ($items as $item) {
                $member_group_code = $item->member['group_code'];
                $group = GroupCode::where('group_code', $member_group_code)->first();
                if ($group) {
                    $item->group_code_id = $group->id;
                    $item->save();
                }
            }
        }
    }
}
