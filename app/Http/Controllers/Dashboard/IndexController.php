<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\DashboardExport;
use App\Exports\DashboardGraphExport;
use App\Models\Accident;
use App\Models\ContractorAccident;
use App\Models\GirDefinition;
use App\Models\GroupCode;
use App\Models\HealthConcern;
use App\Models\ImportXML;
use App\Models\Member;
use App\Models\OriginType;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class IndexController extends Controller
{
    //Dashboard top circle numbers
    public function index()
    {
        $data = array();
        $current_year = date('Y');
        $current_month = date('m');

        //Get Origin Type 'Accident' id
        $origin_type1 = OriginType::where('origin_type', 'Accident')->get()->first();
        //Get Origin Type 'MSS' id
        $origin_type2 = OriginType::where('origin_type', 'MSS')->get()->first();
        //Gir
        $gir_definitions = GirDefinition::where('definition', 'Lost Time')->orWhere('definition', 'Non Lost Time')->pluck('id')->toArray();

        //=======deeside members=========
        $deeside_members = Member::where('group_code', 'like', 'H%')->get()->pluck('id')->toArray();
        //=======burnaston members=========
        $burnaston_members = Member::where('group_code', 'not like', 'H%')->get()->pluck('id')->toArray();

        //===============Get Year Data
        //Gir
        $y_gir = Accident::where('is_deleted', 0)
            ->whereYear('accident_date', $current_year)
            ->where('causation_factor_id', '>', 3)
            ->whereIn('gir_definition_id', $gir_definitions)
            ->get();

        $data['y_gir'] = $y_gir->count();

        $data['deeside_y_gir'] = $y_gir->filter(function ($item) use ($deeside_members) {
            return in_array($item->member_id, $deeside_members);
        })->count();

        $data['burnaston_y_gir'] = $y_gir->filter(function ($item) use ($burnaston_members) {
            return in_array($item->member_id, $burnaston_members);
        })->count();

        //Accidents
        if($origin_type1 != null) {
            $y_accidents = Accident::where('causation_factor_id', '>', 3)
                ->whereYear('accident_date', $current_year)
                ->where('is_deleted', 0)
                ->get();

            $data['y_accidents'] = $y_accidents->count();

            $data['deeside_y_accidents'] = $y_accidents->filter(function ($item) use ($deeside_members) {
                return in_array($item->member_id, $deeside_members);
            })->count();

            $data['burnaston_y_accidents'] = $y_accidents->filter(function ($item) use ($burnaston_members) {
                return in_array($item->member_id, $burnaston_members);
            })->count();
        }
        else {
            $data['y_accidents'] = 0;
            $data['deeside_y_accidents'] = 0;
            $data['burnaston_y_accidents'] = 0;
        }

        //GMIR
        $y_gmir = HealthConcern::where('is_deleted', 0)
            ->where('current_level', '!=', 'Level 1 - Discharged')
            ->whereYear('ohc_appointment', $current_year)
            ->where('gmir', 'GMIR_Full')
            ->get();
        $data['y_gmir'] = $y_gmir->count();
        $data['deeside_y_gmir'] = $y_gmir->filter(function ($item) use ($deeside_members) {
            return in_array($item->member_id, $deeside_members);
        })->count();

        $data['burnaston_y_gmir'] = $y_gmir->filter(function ($item) use ($burnaston_members) {
            return in_array($item->member_id, $burnaston_members);
        })->count();

        //MSS
        if($origin_type2 != null) {
            $y_mss = HealthConcern::where('origin', 'Work')
                ->where('origin_type_id', $origin_type2->id)
                ->where('is_deleted', 0)
                ->where('current_level', '!=', 'Level 1 - Discharged')
                ->whereYear('ohc_appointment', $current_year)
                ->get();
            $data['y_mss'] = $y_mss->count();
            $data['deeside_y_mss'] = $y_mss->filter(function ($item) use ($deeside_members) {
                return in_array($item->member_id, $deeside_members);
            })->count();

            $data['burnaston_y_mss'] = $y_mss->filter(function ($item) use ($burnaston_members) {
                return in_array($item->member_id, $burnaston_members);
            })->count();
        }
        else {
            $data['y_mss'] = 0;
            $data['deeside_y_mss'] = 0;
            $data['burnaston_y_mss'] = 0;
        }

        //===============Get Month Data
        //Gir
        $m_gir = Accident::where('is_deleted', 0)
            ->whereYear('accident_date', $current_year)
            ->whereMonth('accident_date', $current_month)
            ->where('causation_factor_id', '>', 3)
            ->whereIn('gir_definition_id', $gir_definitions)
            ->get();
        $data['m_gir'] = $m_gir->count();
        $data['deeside_m_gir'] = $m_gir->filter(function ($item) use ($deeside_members) {
            return in_array($item->member_id, $deeside_members);
        })->count();

        $data['burnaston_m_gir'] = $m_gir->filter(function ($item) use ($burnaston_members) {
            return in_array($item->member_id, $burnaston_members);
        })->count();

        //Accidents
        if($origin_type1 != null) {
            $m_accidents = Accident::where('causation_factor_id', '>', 3)
                ->whereYear('accident_date', $current_year)
                ->whereMonth('accident_date', $current_month)
                ->where('is_deleted', 0)
                ->get();
            $data['m_accidents'] = $m_accidents->count();
            $data['deeside_m_accidents'] = $m_accidents->filter(function ($item) use ($deeside_members) {
                return in_array($item->member_id, $deeside_members);
            })->count();

            $data['burnaston_m_accidents'] = $m_accidents->filter(function ($item) use ($burnaston_members) {
                return in_array($item->member_id, $burnaston_members);
            })->count();
        }
        else {
            $data['m_accidents'] = 0;
            $data['deeside_m_accidents'] = 0;
            $data['burnaston_m_accidents'] = 0;
        }

        //GMIR
        $m_gmir = HealthConcern::where('is_deleted', 0)
            ->where('current_level', '!=', 'Level 1 - Discharged')
            ->whereYear('ohc_appointment', $current_year)
            ->whereMonth('ohc_appointment', $current_month)
            ->where('gmir', 'GMIR_Full')
            ->get();
        $data['m_gmir'] = $m_gmir->count();
        $data['deeside_m_gmir'] = $m_gmir->filter(function ($item) use ($deeside_members) {
            return in_array($item->member_id, $deeside_members);
        })->count();

        $data['burnaston_m_gmir'] = $m_gmir->filter(function ($item) use ($burnaston_members) {
            return in_array($item->member_id, $burnaston_members);
        })->count();

        //MSS
        if($origin_type2 != null) {
            $m_mss = HealthConcern::where('origin', 'Work')
                ->where('origin_type_id', $origin_type2->id)
                ->whereYear('ohc_appointment', $current_year)
                ->whereMonth('ohc_appointment', $current_month)
                ->where('is_deleted', 0)
                ->where('current_level', '!=', 'Level 1 - Discharged')
                ->get();
            $data['m_mss'] = $m_mss->count();
            $data['deeside_m_mss'] = $m_mss->filter(function ($item) use ($deeside_members) {
                return in_array($item->member_id, $deeside_members);
            })->count();

            $data['burnaston_m_mss'] = $m_mss->filter(function ($item) use ($burnaston_members) {
                return in_array($item->member_id, $burnaston_members);
            })->count();
        }
        else {
            $data['m_mss'] = 0;
            $data['deeside_m_mss'] = 0;
            $data['burnaston_m_mss'] = 0;
        }


        //=========Get This Week Data
        $day = date('w');
        $week_start = date('Y-m-d', strtotime('-'.$day.' days'));
        $week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
        $week_start .= ' 00:00:00';
        $week_end .= ' 23:59:59';

        //Gir
        $w_gir = Accident::where('is_deleted', 0)
            ->whereBetween('accident_date', [$week_start, $week_end])
            ->where('causation_factor_id', '>', 3)
            ->whereIn('gir_definition_id', $gir_definitions)
            ->get();
        $data['w_gir'] = $w_gir->count();
        $data['deeside_w_gir'] = $w_gir->filter(function ($item) use ($deeside_members) {
            return in_array($item->member_id, $deeside_members);
        })->count();

        $data['burnaston_w_gir'] = $w_gir->filter(function ($item) use ($burnaston_members) {
            return in_array($item->member_id, $burnaston_members);
        })->count();

        //Accidents
        if($origin_type1 != null) {
            $w_accidents = Accident::where('causation_factor_id', '>', 3)
                ->whereBetween('accident_date', [$week_start, $week_end])
                ->where('is_deleted', 0)
                ->get();
            $data['w_accidents'] = $w_accidents->count();
            $data['deeside_w_accidents'] = $w_accidents->filter(function ($item) use ($deeside_members) {
                return in_array($item->member_id, $deeside_members);
            })->count();

            $data['burnaston_w_accidents'] = $w_accidents->filter(function ($item) use ($burnaston_members) {
                return in_array($item->member_id, $burnaston_members);
            })->count();
        }
        else {
            $data['w_accidents'] = 0;
            $data['deeside_w_accidents'] = 0;
            $data['burnaston_w_accidents'] = 0;
        }

        //GMIR
        $w_gmir = HealthConcern::where('is_deleted', 0)
            ->where('current_level', '!=', 'Level 1 - Discharged')
            ->whereBetween('ohc_appointment', [$week_start, $week_end])
            ->where('gmir', 'GMIR_Full')
            ->get();
        $data['w_gmir'] = $w_gmir->count();
        $data['deeside_w_gmir'] = $w_gmir->filter(function ($item) use ($deeside_members) {
            return in_array($item->member_id, $deeside_members);
        })->count();

        $data['burnaston_w_gmir'] = $w_gmir->filter(function ($item) use ($burnaston_members) {
            return in_array($item->member_id, $burnaston_members);
        })->count();

        //MSS
        if($origin_type2 != null) {
            $w_mss = HealthConcern::where('origin', 'Work')
                ->where('origin_type_id', $origin_type2->id)
                ->whereBetween('ohc_appointment', [$week_start, $week_end])
                ->where('is_deleted', 0)
                ->where('current_level', '!=', 'Level 1 - Discharged')
                ->get();
            $data['w_mss'] = $w_mss->count();
            $data['deeside_w_mss'] = $w_mss->filter(function ($item) use ($deeside_members) {
                return in_array($item->member_id, $deeside_members);
            })->count();

            $data['burnaston_w_mss'] = $w_mss->filter(function ($item) use ($burnaston_members) {
                return in_array($item->member_id, $burnaston_members);
            })->count();
        }
        else {
            $data['w_mss'] = 0;
            $data['deeside_w_mss'] = 0;
            $data['burnaston_w_mss'] = 0;
        }


        $data['w_contractor_accidents'] = ContractorAccident::whereBetween('accident_date', [$week_start, $week_end])
            ->count();

        $data['settings'] = ImportXML::find(1);

        $last_update = HealthConcern::where('is_deleted', 0)->orderBy('updated_at', 'DESC')->get();
        $data['last_update'] = $last_update[0];
        $data['accident_outstanding'] = 0;
        $data['deeside_accident_outstanding'] = 0;
        $data['burnaston_accident_outstanding'] = 0;
        if($origin_type1 != null) {
            $accident_outstanding = Accident::where('causation_factor_id', '>', 3)
                ->whereYear('accident_date', $current_year)
                ->where('is_deleted', 0)
                ->whereNull('wi_part_2_received')
                ->get();
            $data['accident_outstanding'] = $accident_outstanding->count();
            $data['deeside_accident_outstanding'] = $accident_outstanding->filter(function ($item) use ($deeside_members) {
                return in_array($item->member_id, $deeside_members);
            })->count();

            $data['burnaston_accident_outstanding'] = $accident_outstanding->filter(function ($item) use ($burnaston_members) {
                return in_array($item->member_id, $burnaston_members);
            })->count();
        }

        $data['mss_outstanding'] = 0;
        $data['deeside_mss_outstanding'] = 0;
        $data['burnaston_mss_outstanding'] = 0;
        if($origin_type2 != null) {
            $mss_outstanding = HealthConcern::where('origin', 'Work')
                ->where('origin_type_id', $origin_type2->id)
                ->where('is_deleted', 0)
                ->where('current_level', '!=', 'Level 1 - Discharged')
                ->whereYear('ohc_appointment', $current_year)
                ->whereNull('wi_part_2_received')
                ->get();
            $data['mss_outstanding'] = $mss_outstanding->count();
            $data['deeside_mss_outstanding'] = $mss_outstanding->filter(function ($item) use ($deeside_members) {
                return in_array($item->member_id, $deeside_members);
            })->count();

            $data['burnaston_mss_outstanding'] = $mss_outstanding->filter(function ($item) use ($burnaston_members) {
                return in_array($item->member_id, $burnaston_members);
            })->count();
        }
        if(Auth::user()){
            return view('dashboard.index', $data);
        }else{
            return view('dashboard.default-dashboard', $data);
        }
    }

    //Dashboard top circle number click list
    public function get_list(Request $request)
    {
        //Get Origin Type 'MSS' id
        $origin_type2 = OriginType::where('origin_type', 'MSS')->get()->first();
        $current_year = date('Y');
        $current_month = date('m');

        //Gir
        $gir_definitions = GirDefinition::where('definition', 'Lost Time')->orWhere('definition', 'Non Lost Time')->pluck('id')->toArray();

        $range = $request->get('range');
        $kind = $request->get('kind');
        $selected_group = $request->get('selected_group');
        $member_ids = [];
        if($selected_group == 'deeside')
            $member_ids = Member::where('group_code', 'like', 'H%')->get()->pluck('id')->toArray();
        if($selected_group == 'burnaston')
            $member_ids = Member::where('group_code', 'not like', 'H%')->get()->pluck('id')->toArray();
        $data = array();

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
            $hs = Accident::where('is_deleted', 0)
                ->whereBetween('accident_date', [$start, $end])
                ->where('causation_factor_id', '>', 3)
                ->whereIn('gir_definition_id', $gir_definitions)
                ->get();
        } else if($kind == "accident") {
            $hs = Accident::with('member')
                ->where('is_deleted', 0)
                ->where('causation_factor_id', '>', 3)
                ->whereBetween('accident_date', [$start, $end])
                ->get();
        } else if($kind == "mss") {
            $hs = HealthConcern::with('member')
                ->where('is_deleted', 0)
                ->where('origin', 'Work')
                ->where('origin_type_id', $origin_type2->id)
                ->where('current_level', '!=', 'Level 1 - Discharged')
                ->whereBetween('ohc_appointment', [$start, $end])
                ->get();
        } else if($kind == "gmir") { //gmir
            $hs = HealthConcern::where('is_deleted', 0)
                ->where('current_level', '!=', 'Level 1 - Discharged')
                ->whereBetween('ohc_appointment', [$start, $end])
                ->where('gmir', 'GMIR_Full')
                ->get();
        } else if($kind == "accident_outstanding") {
            $hs = Accident::with('member')
                ->where('is_deleted', 0)
                ->where('causation_factor_id', '>', 3)
                ->whereBetween('accident_date', [$start, $end])
                ->whereNull('wi_part_2_received')
                ->get();
        } else if($kind == "mss_outstanding"){ //mss_outstanding
            $hs = HealthConcern::where('origin', 'Work')
                ->where('origin_type_id', $origin_type2->id)
                ->where('is_deleted', 0)
                ->where('current_level', '!=', 'Level 1 - Discharged')
                ->whereYear('ohc_appointment', $current_year)
                ->whereNull('wi_part_2_received')
                ->get();
        } else if($kind == "accident_received") {
            $hs = Accident::with('member')
                ->where('is_deleted', 0)
                ->where('causation_factor_id', '>', 3)
                ->whereBetween('accident_date', [$start, $end])
                ->whereNotNull('wi_part_2_received')
                ->get();
        } else if($kind == "mss_received"){ //mss_received
            $hs = HealthConcern::where('origin', 'Work')
                ->where('origin_type_id', $origin_type2->id)
                ->where('is_deleted', 0)
                ->where('current_level', '!=', 'Level 1 - Discharged')
                ->whereYear('ohc_appointment', $current_year)
                ->whereNotNull('wi_part_2_received')
                ->get();
        }

        if(count($member_ids) > 0)
            $hs = $hs->filter(function ($item) use ($member_ids) {
                return in_array($item->member_id, $member_ids);
            });
        $data['hs'] = $hs;
        $data['kind'] = $kind;
        $data['range'] = $range;
        return view('dashboard.report', $data);
    }

    //Dashboard top circle number click list export
    public function export(Request $request)
    {
        $range = $request->get('report_list_range');
        $kind = $request->get('report_list_kind');
        $file_name = 'dashboard_'.$kind.".xlsx";
        return Excel::download(new DashboardExport($range, $kind), $file_name);
    }

    //Dashboard Graph
    public function get_graph_data(Request $request)
    {
        $year = $request->get('graph_year');
        $graph = $request->get('e_chart');
        $selected_group = $request->get('selected_group');

        //Get Origin Type 'Accident' id
        $origin_type1 = OriginType::where('origin_type', 'Accident')->get()->first();
        //Get Origin Type 'MSS' id
        $origin_type2 = OriginType::where('origin_type', 'MSS')->get()->first();

        //Get target
        switch ($graph){
            case 'gir_chart': $setting = Setting::where('set_type', 'gir_target')->get()->first(); if($setting != null) $target = $setting->set_value; else $target = 0; break;
            case 'gmir_chart': $setting = Setting::where('set_type', 'gmir_target')->get()->first(); if($setting != null) $target = $setting->set_value; else $target = 0; break;
            case 'accident_chart': $setting = Setting::where('set_type', 'all_accident_target')->get()->first(); if($setting != null) $target = $setting->set_value; else $target = 0; break;
            case 'mss_chart': $setting = Setting::where('set_type', 'work_mss_target')->get()->first(); if($setting != null) $target = $setting->set_value; else $target = 0; break;
            default: $target = 0; break;
        }

        $target = (float) $target;
        $month_target = $target / 12;
        $data['target'] = array(
            round($month_target, 2),
            round($month_target*2, 2),
            round($month_target*3, 2),
            round($month_target*4, 2),
            round($month_target*5, 2),
            round($month_target*6, 2),
            round($month_target*7, 2),
            round($month_target*8, 2),
            round($month_target*9, 2),
            round($month_target*10, 2),
            round($month_target*11, 2),
            round($target, 2)
        );

        $gir_definitions = GirDefinition::where('definition', 'Lost Time')->orWhere('definition', 'Non Lost Time')->pluck('id')->toArray();
        //Get Graph Data
        $graph_data = array();
        $ytd_data = array();
        $ytd_value = 0;

        $member_ids = [];
        if($selected_group == 'deeside')
            $member_ids = Member::where('group_code', 'like', 'H%')->get()->pluck('id')->toArray();
        if($selected_group == 'burnaston')
            $member_ids = Member::where('group_code', 'not like', 'H%')->get()->pluck('id')->toArray();

        for($month = 1; $month < 13; $month ++) {
            $g_value = 0;
            if($month < 10)
                $month = "0".$month;

            switch ($graph){
                case 'gir_chart':
                    // if(count($member_ids) > 0) {
                    //     $g_data = Accident::where('is_deleted', 0)
                    //         ->whereYear('accident_date', $year)
                    //         ->whereMonth('accident_date', $month)
                    //         ->where('causation_factor_id', '>', 3)
                    //         ->whereIn('gir_definition_id', $gir_definitions)
                    //         ->get();
                    //     $g_value = $g_data->filter(function ($item) use ($member_ids) {
                    //         return in_array($item->member_id, $member_ids);
                    //     })->count();
                    // } else {
                        $g_value = Accident::where('is_deleted', 0)
                            ->whereYear('accident_date', $year)
                            ->whereMonth('accident_date', $month)
                            ->where('causation_factor_id', '>', 3)
                            ->whereIn('gir_definition_id', $gir_definitions);
                        if($selected_group == 'deeside')
                            $g_value = $g_value->whereHas('group_code', function ($query) {
                                $query->where('group_code', 'like', 'H%');
                            });
                        else if($selected_group == 'burnaston')
                            $g_value = $g_value->whereHas('group_code', function ($query) {
                                $query->where('group_code', 'not like', 'H%');
                            });
                        $g_value = $g_value->count();
                    // }
                    break;
                case 'gmir_chart':
                    // if(count($member_ids) > 0) {
                    //     $g_data = HealthConcern::where('is_deleted', 0)
                    //         ->where('current_level', '!=', 'Level 1 - Discharged')
                    //         ->whereYear('ohc_appointment', $year)
                    //         ->whereMonth('ohc_appointment', $month)
                    //         ->where('gmir', 'GMIR_Full')
                    //         ->get();
                    //     $g_value = $g_data->filter(function ($item) use ($member_ids) {
                    //         return in_array($item->member_id, $member_ids);
                    //     })->count();
                    // } else {
                        $g_value = HealthConcern::where('is_deleted', 0)
                            ->where('current_level', '!=', 'Level 1 - Discharged')
                            ->whereYear('ohc_appointment', $year)
                            ->whereMonth('ohc_appointment', $month)
                            ->where('gmir', 'GMIR_Full');
                        if($selected_group == 'deeside')
                            $g_value = $g_value->whereHas('group_code', function ($query) {
                                $query->where('group_code', 'like', 'H%');
                            });
                        else if($selected_group == 'burnaston')
                            $g_value = $g_value->whereHas('group_code', function ($query) {
                                $query->where('group_code', 'not like', 'H%');
                            });
                        $g_value = $g_value->count();
                    // }
                    break;
                case 'accident_chart':
                    if($origin_type1 != null) {
                        // if(count($member_ids) > 0) {
                        //     $g_data = Accident::where('causation_factor_id', '>', 3)
                        //         ->whereYear('accident_date', $year)
                        //         ->whereMonth('accident_date', $month)
                        //         ->where('is_deleted', 0)
                        //         ->get();
                        //     $g_value = $g_data->filter(function ($item) use ($member_ids) {
                        //         return in_array($item->member_id, $member_ids);
                        //     })->count();
                        // } else {
                            $g_value = Accident::where('causation_factor_id', '>', 3)
                                ->whereYear('accident_date', $year)
                                ->whereMonth('accident_date', $month)
                                ->where('is_deleted', 0);
                            if($selected_group == 'deeside')
                                $g_value = $g_value->whereHas('group_code', function ($query) {
                                    $query->where('group_code', 'like', 'H%');
                                });
                            else if($selected_group == 'burnaston')
                                $g_value = $g_value->whereHas('group_code', function ($query) {
                                    $query->where('group_code', 'not like', 'H%');
                                });
                            $g_value = $g_value->count();
                        // }
                    }
                    break;
                case 'mss_chart':
                    if($origin_type2 != null) {
                        // if(count($member_ids) > 0) {
                        //     $g_data = HealthConcern::where('origin', 'Work')
                        //         ->where('origin_type_id', $origin_type2->id)
                        //         ->whereYear('ohc_appointment', $year)
                        //         ->whereMonth('ohc_appointment', $month)
                        //         ->where('is_deleted', 0)
                        //         ->where('current_level', '!=', 'Level 1 - Discharged')
                        //         ->get();
                        //     $g_value = $g_data->filter(function ($item) use ($member_ids) {
                        //         return in_array($item->member_id, $member_ids);
                        //     })->count();
                        // } else {
                            $g_value = HealthConcern::where('origin', 'Work')
                                ->where('origin_type_id', $origin_type2->id)
                                ->whereYear('ohc_appointment', $year)
                                ->whereMonth('ohc_appointment', $month)
                                ->where('is_deleted', 0)
                                ->where('current_level', '!=', 'Level 1 - Discharged');
                            if($selected_group == 'deeside')
                                $g_value = $g_value->whereHas('group_code', function ($query) {
                                    $query->where('group_code', 'like', 'H%');
                                });
                            else if($selected_group == 'burnaston')
                                $g_value = $g_value->whereHas('group_code', function ($query) {
                                    $query->where('group_code', 'not like', 'H%');
                                });
                            $g_value = $g_value->count();
                        // }
                    }
                    break;
                default: $g_value = 0; break;
            }

            $ytd_value += $g_value;
            if($graph != 'year_chart') {
                array_push($graph_data, $g_value);
                array_push($ytd_data, $ytd_value);
            }
        }

        $data['graph_data'] = $graph_data;
        $data['ytd'] = $ytd_data;

        echo json_encode($data, true);
    }

    public function go_page($page) {
        switch ($page) {
            case "assembly": $data['page_title'] = 'Assembly'; $data['sub_buttons'] = array('production' => 'Production', 'logistics' => 'Logistics', 'maint_eng' => 'Maint/Eng'); break;
            case "body_shop": $data['page_title'] = 'Body Shop'; $data['sub_buttons'] = array('production' => 'Production', 'maint_eng' => 'Maint/Eng'); break;
            case "paint_plastic": $data['page_title'] = 'Paint / Plastic'; $data['sub_buttons'] = array('paint_shop_production' => 'Paint Shop  Production', 'plastics_shop_production' => 'Plastic Shop  Production', 'paint_shop_maint_eng' => 'Paint Shop  Maint/Eng', 'plastics_shop_maint_eng' => 'Plastic Shop  Maint/Eng'); break;
            case "qa": $data['page_title'] = 'QA'; $data['sub_buttons'] = array(); break;
            case "manufacturing": $data['page_title'] = 'Manufacturing Support & Revenue'; $data['sub_buttons'] = array(); break;
            case "corporate": $data['page_title'] = 'Corporate'; $data['sub_buttons'] = array(); break;
            case "deeside": $data['page_title'] = 'Deeside'; $data['sub_buttons'] = array(); break;
            default: $data['page_title'] = "Dashboard"; $data['sub_buttons'] = array(); break;
        }
        $data['page'] = $page;
        return view('dashboard.graphs', $data);
    }

    public function get_standard_graph(Request $request)
    {
        $year = $request->get('graph_year');
        $graph = $request->get('e_chart');

        //Get Origin Type 'MSS' id
        $origin_type2 = OriginType::where('origin_type', 'MSS')->get()->first();

        //Get Graph Data
        $accidents = array();
        $mss = array();

        for($month = 1; $month < 13; $month ++) {
            if($month < 10)
                $month = "0".$month;
            switch ($graph){
                case 'assembly_chart': //ignore for now
                    $groups = GroupCode::where('group_code', 'like', 'GA%')
                        ->orWhere('group_code', 'like', 'GB%' )
                        ->orWhere('group_code', 'like', 'GC%' )
                        ->orWhere('group_code', 'like', 'GF%' )
                        ->orWhere('group_code', 'like', 'GG%' )
                        ->orWhere('group_code', 'like', 'G7%' )->pluck('id')->toArray();
                    break;
                case 'body_shop_chart':
                    $groups = GroupCode::where('group_code', 'like', 'I3%')
                        ->orWhere('group_code', 'like', 'I4%' )
                        ->orWhere('group_code', 'like', 'IC%' )
                        ->pluck('id')->toArray();
                    break;
                case 'paint_plastic_chart':
                    $groups = GroupCode::where('group_code', 'like', 'JA%')
                        ->orWhere('group_code', 'like', 'JB%' )
                        ->orWhere('group_code', 'like', 'JC%' )
                        ->orWhere('group_code', 'like', 'JD%' )
                        ->orWhere('group_code', 'like', 'J5%' )
                        ->orWhere('group_code', 'like', 'J6%' )
                        ->pluck('id')->toArray();
                    break;
                case 'qa_chart':
                    $groups = GroupCode::where('group_code', 'like', 'F%')
                        ->pluck('id')->toArray();
                    break;
                case 'manufacturing_chart':
                    $groups = GroupCode::where('group_code', 'like', 'L6%')
                        ->orWhere('group_code', 'like', 'L7%' )
                        ->pluck('id')->toArray();
                    break;
                case 'corporate_chart':
                    $groups = GroupCode::where('group_code', 'like', 'A%')
                        ->orWhere('group_code', 'like', 'B%' )
                        ->orWhere('group_code', 'like', 'C%' )
                        ->orWhere('group_code', 'like', 'E%' )
                        ->pluck('id')->toArray();
                    break;
                case 'deeside_chart':
                    $groups = GroupCode::where('group_code', 'like', 'H%')
                        ->pluck('id')->toArray();
                    break;
                case 'assembly_production_chart': //ignore for now
                    $groups = GroupCode::where('group_code', 'like', 'G7%')->pluck('id')->toArray();
                    break;
                case 'assembly_logistics_chart': //ignore for now
                    $groups = GroupCode::where('group_code', 'like', 'GB%')->pluck('id')->toArray();
                    break;
                case 'assembly_maint_eng_chart': //ignore for now
                    $groups = GroupCode::where('group_code', 'like', 'GA%')
                        ->orWhere('group_code', 'like', 'GC%' )
                        ->orWhere('group_code', 'like', 'GF%' )
                        ->orWhere('group_code', 'like', 'GG%' )
                        ->pluck('id')->toArray();
                    break;
                case 'body_shop_production_chart':
                    $groups = GroupCode::where('group_code', 'like', 'I3%')
                        ->orWhere('group_code', 'like', 'I4%' )
                        ->pluck('id')->toArray();
                    break;
                case 'body_shop_maint_eng_chart':
                    $groups = GroupCode::Where('group_code', 'like', 'IC%' )
                        ->pluck('id')->toArray();
                    break;
                case 'paint_shop_production_chart':
                    $groups = GroupCode::where('group_code', 'like', 'J5%')
                        ->pluck('id')->toArray();
                    break;
                case 'paint_shop_maint_eng_chart':
                    $groups = GroupCode::where('group_code', 'like', 'JC%')
                        ->orWhere('group_code', 'like', 'JD%' )
                        ->pluck('id')->toArray();
                    break;
                case 'plastics_shop_production_chart':
                    $groups = GroupCode::where('group_code', 'like', 'J6%' )
                        ->pluck('id')->toArray();
                    break;
                case 'plastics_shop_maint_eng_chart':
                    $groups = GroupCode::where('group_code', 'like', 'JA%')
                        ->orWhere('group_code', 'like', 'JB%' )
                        ->pluck('id')->toArray();
                    break;

                default: $groups = array(); break;
            }

            //Accidents
            $a_value = Accident::where('causation_factor_id', '>', 3)
                ->whereYear('accident_date', $year)
                ->whereMonth('accident_date', $month)
                ->whereIn('group_code_id', $groups)
                ->where('is_deleted', 0)
                ->count();
            //MSS
            $s_value = HealthConcern::where('origin', 'Work')
                ->where('origin_type_id', $origin_type2->id)
                ->whereYear('ohc_appointment', $year)
                ->whereMonth('ohc_appointment', $month)
                ->where('current_level', '!=', 'Level 1 - Discharged')
                ->whereIn('group_code_id', $groups)
                ->where('is_deleted', 0)
                ->count();

            array_push($accidents, $a_value);
            array_push($mss, $s_value);
        }

        $data['accidents'] = $accidents;
        $data['mss'] = $mss;

        echo json_encode($data, true);
    }

    public function go_list(Request $request)
    {
        $year = $request->get('year');
        $graph_type = $request->get('graph_type');

        $return_data['page_title'] = ucfirst(str_replace("_" , " ", $graph_type));

        //Get Origin Type 'MSS'
        $origin_type2 = OriginType::where('origin_type', 'MSS')->get()->first();

        if($graph_type == "assembly_accident" || $graph_type == "assembly_mss") {
            $groups = GroupCode::where('group_code', 'like', 'GA%')
                ->orWhere('group_code', 'like', 'GB%' )
                ->orWhere('group_code', 'like', 'GC%' )
                ->orWhere('group_code', 'like', 'GF%' )
                ->orWhere('group_code', 'like', 'GG%' )
                ->orWhere('group_code', 'like', 'G7%' )->pluck('id')->toArray();
        }

        else if($graph_type == "body_shop_accident" || $graph_type == "body_shop_mss") {
            $groups = GroupCode::where('group_code', 'like', 'I3%')
                ->orWhere('group_code', 'like', 'I4%' )
                ->orWhere('group_code', 'like', 'IC%' )
                ->pluck('id')->toArray();
        }

        else if($graph_type == "paint_plastic_accident" || $graph_type == "paint_plastic_mss") {
            $groups = GroupCode::where('group_code', 'like', 'JA%')
                ->orWhere('group_code', 'like', 'JB%' )
                ->orWhere('group_code', 'like', 'JC%' )
                ->orWhere('group_code', 'like', 'JD%' )
                ->orWhere('group_code', 'like', 'J5%' )
                ->orWhere('group_code', 'like', 'J6%' )
                ->pluck('id')->toArray();
        }

        else if($graph_type == "qa_accident" || $graph_type == "qa_mss") {
            $groups = GroupCode::where('group_code', 'like', 'F%')
                ->pluck('id')->toArray();
        }

        else if($graph_type == "manufacturing_accident" || $graph_type == "manufacturing_mss") {
            $groups = GroupCode::where('group_code', 'like', 'L6%')
                ->orWhere('group_code', 'like', 'L7%' )
                ->pluck('id')->toArray();
        }

        else if($graph_type == "corporate_accident" || $graph_type == "corporate_mss") {
            $groups = GroupCode::where('group_code', 'like', 'A%')
                ->orWhere('group_code', 'like', 'B%' )
                ->orWhere('group_code', 'like', 'C%' )
                ->orWhere('group_code', 'like', 'E%' )
                ->pluck('id')->toArray();
        }

        else if($graph_type == "deeside_accident" || $graph_type == "deeside_mss") {
            $groups = GroupCode::where('group_code', 'like', 'H%')
                ->pluck('id')->toArray();
        }

        else if($graph_type == "assembly_production_accident" || $graph_type == "assembly_production_mss") {
            $groups = GroupCode::where('group_code', 'like', 'G7%')->pluck('id')->toArray();
        }

        else if($graph_type == "assembly_logistics_accident" || $graph_type == "assembly_logistics_mss") {
            $groups = GroupCode::where('group_code', 'like', 'GB%')->pluck('id')->toArray();
        }

        else if($graph_type == "assembly_maint_eng_accident" || $graph_type == "assembly_maint_eng_mss") {
            $groups = GroupCode::where('group_code', 'like', 'GA%')
                ->orWhere('group_code', 'like', 'GC%' )
                ->orWhere('group_code', 'like', 'GF%' )
                ->orWhere('group_code', 'like', 'GG%' )
                ->pluck('id')->toArray();
        }

        else if($graph_type == "body_shop_production_accident" || $graph_type == "body_shop_production_mss") {
            $groups = GroupCode::where('group_code', 'like', 'I3%')
                ->orWhere('group_code', 'like', 'I4%' )
                ->pluck('id')->toArray();
        }

        else if($graph_type == "body_shop_maint_eng_accident" || $graph_type == "body_shop_maint_eng_mss") {
            $groups = GroupCode::Where('group_code', 'like', 'IC%' )->pluck('id')->toArray();
        }

        else if($graph_type == "paint_shop_production_accident" || $graph_type == "paint_shop_production_mss") {
            $groups = GroupCode::where('group_code', 'like', 'J5%')->pluck('id')->toArray();
        }

        else if($graph_type == "paint_shop_maint_eng_accident" || $graph_type == "paint_shop_maint_eng_mss") {
            $groups = GroupCode::where('group_code', 'like', 'JC%')
                ->orWhere('group_code', 'like', 'JD%' )
                ->pluck('id')->toArray();
        }

        else if($graph_type == "plastics_shop_production_accident" || $graph_type == "plastics_shop_production_mss") {
            $groups = GroupCode::where('group_code', 'like', 'J6%' )->pluck('id')->toArray();
        }

        else if($graph_type == "plastics_shop_maint_eng_accident" || $graph_type == "plastics_shop_maint_eng_mss") {
            $groups = GroupCode::where('group_code', 'like', 'JA%')
                ->orWhere('group_code', 'like', 'JB%' )
                ->pluck('id')->toArray();
        }

        else {
            $groups = array();
        }

        if(strpos($graph_type, 'accident') !== false) {
            $data = Accident::where('causation_factor_id', '>', 3)
                ->whereYear('accident_date', $year)
                ->whereIn('group_code_id', $groups)
                ->where('is_deleted', 0)
                ->get();
            $kind = "accident";
        } else {
            $data = HealthConcern::where('origin', 'Work')
                ->where('origin_type_id', $origin_type2->id)
                ->whereYear('ohc_appointment', $year)
                ->whereIn('group_code_id', $groups)
                ->where('is_deleted', 0)
                ->where('current_level', '!=', 'Level 1 - Discharged')
                ->get();
            $kind = "health_concerns";
        }

        $return_data['hs'] = $data;
        $return_data['kind'] = $kind;
        $return_data['graph_type'] = $graph_type;
        $return_data['year'] = $year;
        return view('dashboard.list', $return_data);
    }

    public function graph_export(Request $request)
    {
        $year = $request->get('report_list_range');
        $kind = $request->get('report_list_kind');
        $file_name = $kind.".xlsx";
        return Excel::download(new DashboardGraphExport($year, $kind), $file_name);
    }
}