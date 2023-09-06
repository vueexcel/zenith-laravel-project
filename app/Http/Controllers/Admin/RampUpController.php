<?php

namespace App\Http\Controllers\Admin;

use App\Models\RampUp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RampUpController extends Controller
{
    //
    public function get_all()
    {
        $data['records'] = RampUp::all();
        return view('admin.ramp_up.list', $data);
    }

    public function edit(Request $request)
    {
        $item_id = $request['id'];
        if($item_id == 0)
            $data['record'] = array();
        else
            $data['record'] = RampUp::find($item_id);

        return view('admin.ramp_up.edit', $data);
    }

    public function delete(Request $request)
    {
        $item_id = $request->get('delete_item_id');
        $item = RampUp::find($item_id);

        if($item->delete())
            return response()->json(['success'=>'Record is successfully added']);
        else
            return response()->json(['errors'=> ['Record is not saved']]);
    }

    public function save(Request $request)
    {
        $item_id = $request->get('item_id');

        if($item_id == 0) {
            $validator = \Validator::make($request->all(), [
                'ramp_up' => 'required|max:255'
            ]);

            $item = new RampUp;
        } else {
            $validator = \Validator::make($request->all(), [
                'ramp_up' => 'required|max:255'
            ]);

            $item = RampUp::find($item_id);
        }

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $item->ramp_up = $request->input('ramp_up', '');
        $item->timestamps = false;
        if($item->save())
            return response()->json(['success'=>'Record is successfully added']);
        else
            return response()->json(['errors'=> ['Record is not saved']]);
    }


    public function add(Request $request)
    {
        $ramp_up = $request->get('ramp_up');
        $check = RampUp::where('ramp_up', $ramp_up)->first();
        if(count($check) > 0) {
            return response()->json(['result'=>'fail']);
        } else {
            $new_ramp_up = new RampUp();
            $new_ramp_up->ramp_up = $ramp_up;
            $result = $new_ramp_up->save();
            if($result)
                return response()->json(['result'=>$new_ramp_up]);
            else
                return response()->json(['result'=>'fail']);
        }

    }
}

