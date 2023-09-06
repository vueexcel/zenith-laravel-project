<?php

namespace App\Http\Controllers\Admin;

use App\Models\InjuryType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InjuryTypesController extends Controller
{
    //
    public function get_all()
    {
        $data['records'] = InjuryType::all();
        return view('admin.injury_types.list', $data);
    }

    public function edit(Request $request)
    {
        $item_id = $request['id'];
        if($item_id == 0)
            $data['record'] = array();
        else
            $data['record'] = InjuryType::find($item_id);

        return view('admin.injury_types.edit', $data);
    }

    public function delete(Request $request)
    {
        $item_id = $request->get('delete_item_id');
        $item = InjuryType::find($item_id);

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
                'injury' => 'required|max:30'
            ]);

            $item = new InjuryType;
        } else {
            $validator = \Validator::make($request->all(), [
                'injury' => 'required|max:30'
            ]);

            $item = InjuryType::find($item_id);
        }

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $item->injury = $request->input('injury', '');

        if($item->save())
            return response()->json(['success'=>'Record is successfully added']);
        else
            return response()->json(['errors'=> ['Record is not saved']]);
    }
}
