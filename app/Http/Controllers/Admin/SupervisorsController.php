<?php

namespace App\Http\Controllers\Admin;

use App\Models\GroupCode;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupervisorsController extends Controller
{
    //
    public function get_all()
    {
        $data['records'] = Supervisor::all();
        return view('admin.supervisors.list', $data);
    }

    public function edit(Request $request)
    {
        $item_id = $request['id'];
        if($item_id == 0)
            $data['record'] = array();
        else
            $data['record'] = Supervisor::find($item_id);

        $data['group_codes'] = GroupCode::all();

        return view('admin.supervisors.edit', $data);
    }

    public function delete(Request $request)
    {
        $item_id = $request->get('delete_item_id');
        $item = Supervisor::find($item_id);

        if($item->delete())
            return response()->json(['success'=>'Record is successfully added']);
        else
            return response()->json(['errors'=> ['Record is not saved']]);
    }

    public function save(Request $request)
    {
        $item_id = $request->get('item_id');

        $validator = \Validator::make($request->all(), [
            'surname' => 'required|min:3|max:255',
            'name' => 'required|min:3|max:255'
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        if($item_id == 0) {
            $item = new Supervisor;
        } else {
            $item = Supervisor::find($item_id);
        }

        $item->surname = $request->input('surname', '');
        $item->name = $request->input('name', '');
        $item->occupation = $request->input('occupation', '');
        $item->group_code_id = $request->input('group_code_id', '');

        if($item->save())
            return response()->json(['success'=>'Record is successfully added']);
        else
            return response()->json(['errors'=> ['Record is not saved']]);
    }

    public function get_supervisors_by_group(Request $request)
    {
        $group_code_id = $request->get('group_code');
        $supervisors = Supervisor::where('group_code_id', $group_code_id)->get();
        return response()->json($supervisors);
    }

    public function add(Request $request)
    {
        $supervisor = new Supervisor();
        $supervisor_name = $request->get('supervisor');
        if(strpos($supervisor_name, ",")) {
            $names = explode(",", $supervisor_name);
            $surname = $names[0];
            $name = $names[1];
        } else {
            $surname = $supervisor_name;
            $name = "";
        }
        $supervisor->surname = $surname;
        $supervisor->name = $name;

        $result = $supervisor->save();
        if($result)
            return response()->json(['result'=>'ok']);
        else
            return response()->json(['result'=>'fail']);
    }
}
