<?php

namespace App\Http\Controllers\Admin;

use App\Models\NextStep;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NextStepsController extends Controller
{
    //
    public function get_all()
    {
        $data['records'] = NextStep::all();
        return view('admin.next_steps.list', $data);
    }

    public function edit(Request $request)
    {
        $item_id = $request['id'];
        if($item_id == 0)
            $data['record'] = array();
        else
            $data['record'] = NextStep::find($item_id);

        return view('admin.next_steps.edit', $data);
    }

    public function delete(Request $request)
    {
        $item_id = $request->get('delete_item_id');
        $item = NextStep::find($item_id);

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
                'next_step' => 'required|max:255'
            ]);

            $item = new NextStep;
        } else {
            $validator = \Validator::make($request->all(), [
                'next_step' => 'required|max:255'
            ]);

            $item = NextStep::find($item_id);
        }

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $item->next_step = $request->input('next_step', '');

        if($item->save())
            return response()->json(['success'=>'Record is successfully added']);
        else
            return response()->json(['errors'=> ['Record is not saved']]);
    }


    public function add(Request $request)
    {
        $next_step = $request->get('next_step');
        $check = NextStep::where('next_step', $next_step)->first();
        if(count($check) > 0) {
            return response()->json(['result'=>'fail']);
        } else {
            $new_step = new NextStep();
            $new_step->next_step = $next_step;
            $result = $new_step->save();
            if($result)
                return response()->json(['result'=>$new_step]);
            else
                return response()->json(['result'=>'fail']);
        }

    }
}
