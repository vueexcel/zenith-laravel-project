<?php

namespace App\Http\Controllers\Admin;

use App\Models\GroupCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupCodesController extends Controller
{
    public function get_all()
    {
        $data['records'] = GroupCode::all();
        return view('admin.group_codes.list', $data);
    }

    public function edit(Request $request)
    {
        $item_id = $request['id'];
        if($item_id == 0)
            $data['record'] = array();
        else
            $data['record'] = GroupCode::find($item_id);

        return view('admin.group_codes.edit', $data);
    }

    public function delete(Request $request)
    {
        $item_id = $request->get('delete_item_id');
        $item = GroupCode::find($item_id);

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
                'group_code' => 'required|unique:group_codes,group_code'
            ]);

            $item = new GroupCode;
        } else {
            $validator = \Validator::make($request->all(), [
                'group_code' => 'required|unique:group_codes,group_code,'.$request->get('item_id'),
            ]);

            $item = GroupCode::find($item_id);
        }

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $item->group_code = $request->input('group_code', '');
        $item->s_generation = $request->input('s_generation', '');
        $item->s_guid = $request->input('s_guid', '');
        $item->s_lineage = $request->input('s_lineage', '');
        $item->section = $request->input('section', '');
        $item->department = $request->input('department', '');
        $item->division = $request->input('division', '');

        if($item->save())
            return response()->json(['success'=>'Record is successfully added']);
        else
            return response()->json(['errors'=> ['Record is not saved']]);
    }


    public function add(Request $request)
    {
        $group_code_name = $request->get('group_code');
        $group_code = GroupCode::where('group_code', $group_code_name)->first();
        if($group_code == null) {
            $group_code = new GroupCode();
            $group_code->group_code = $group_code_name;
            $result = $group_code->save();
        } else {
            $result = true;
        }


        if($result)
            return response()->json(['result'=>'ok']);
        else
            return response()->json(['result'=>'fail']);
    }
}
