<?php

namespace App\Http\Controllers\Admin;

use App\Models\WorkType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkTypesController extends Controller
{
    //
    public function get_all()
    {
        $data['records'] = WorkType::all();
        return view('admin.work_types.list', $data);
    }

    public function edit(Request $request)
    {
        $item_id = $request['id'];
        if($item_id == 0)
            $data['record'] = array();
        else
            $data['record'] = WorkType::find($item_id);

        return view('admin.work_types.edit', $data);
    }

    public function delete(Request $request)
    {
        $item_id = $request->get('delete_item_id');
        $item = WorkType::find($item_id);

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
                'work_type' => 'required|max:50'
            ]);

            $item = new WorkType;
        } else {
            $validator = \Validator::make($request->all(), [
                'work_type' => 'required|max:50'
            ]);

            $item = WorkType::find($item_id);
        }

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $item->work_type = $request->input('work_type', '');

        if($item->save())
            return response()->json(['success'=>'Record is successfully added']);
        else
            return response()->json(['errors'=> ['Record is not saved']]);
    }
}
