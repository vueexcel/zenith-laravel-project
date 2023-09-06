<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    //
    public function dashboard()
    {
        $data = array();
        $gir_target = Setting::where('set_type', 'gir_target')->get()->first();
        if($gir_target != null)
            $data['gir_target'] = $gir_target->set_value;
        else
            $data['gir_target'] = 0;

        $gmir_target = Setting::where('set_type', 'gmir_target')->get()->first();
        if($gmir_target != null)
            $data['gmir_target'] = $gmir_target->set_value;
        else
            $data['gmir_target'] = 0;

        $lost_time_incident_target = Setting::where('set_type', 'all_accident_target')->get()->first();
        if($lost_time_incident_target != null)
            $data['all_accident_target'] = $lost_time_incident_target->set_value;
        else
            $data['all_accident_target'] = 0;

        $work_mss_target = Setting::where('set_type', 'work_mss_target')->get()->first();
        if($work_mss_target != null)
            $data['work_mss_target'] = $work_mss_target->set_value;
        else
            $data['work_mss_target'] = 0;

        return view('admin.dashboard', $data);
    }


    public function accident()
    {
        return view('admin.accident');
    }

    public function health_concerns()
    {
        return view('admin.health_concerns');
    }

    public function q_near_miss()
    {
        return view('admin.q_near_miss');
    }

    public function workplace_invest()
    {
        return view('admin.workplace_invest');
    }

    public function reduce_flex()
    {
        return view('admin.reduce_flex');
    }

    public function con_accidents()
    {
        return view('admin.con_accidents');
    }

    public function save_setting(Request $request)
    {
        $set_type = $request->get('set_type');
        $set_value = $request->get('set_value');

        $setting = Setting::where('set_type', $set_type)->get()->first();
        if($setting == null) {
            $setting = new Setting();
            $setting->set_type = $set_type;
            $setting->set_value = $set_value;
        } else {
            $setting->set_value = $set_value;
        }

        $setting->timestamps = false;

        if($setting->save())
            return response()->json(['message' => 'ok']);
        else
            return response()->json(['message' => 'fail']);
    }

    function export_options()
    {
        $data['options'] = array();
        $options = Setting::where('set_type', 'export_options')->get()->first();
        if(!empty($options->set_value))
            $data['options'] = explode(",", $options->set_value);
        return view('admin.export_options', $data);
    }

    function export_options_save(Request $request)
    {
        $set_value = $request->get('export_options');
        if(!empty($set_value))
            $set_value = implode(",", $set_value);
        $setting = Setting::where('set_type', 'export_options')->get()->first();
        if($setting == null) {
            $setting = new Setting();
            $setting->set_type = 'export_options';
            $setting->set_value = $set_value;
        } else {
            $setting->set_value = $set_value;
        }

        $setting->timestamps = false;
        if($setting->save())
            return response()->json(['message' => 'ok']);
        else
            return response()->json(['message' => 'fail']);
    }

}
