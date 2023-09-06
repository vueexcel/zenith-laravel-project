<?php

namespace App\Http\Controllers\Admin;

use App\Models\OriginType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OriginTypesController extends Controller
{
    //
    public function get_all()
    {
        $data['records'] = OriginType::all();
        return view('admin.origin_types.list', $data);
    }

    public function edit(Request $request)
    {
        $item_id = $request['id'];
        if($item_id == 0)
            $data['record'] = array();
        else
            $data['record'] = OriginType::find($item_id);

        return view('admin.origin_types.edit', $data);
    }

    public function delete(Request $request)
    {
        $item_id = $request->get('delete_item_id');
        $item = OriginType::find($item_id);

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
                'origin_type' => 'required|max:255'
            ]);

            $item = new OriginType;
        } else {
            $validator = \Validator::make($request->all(), [
                'origin_type' => 'required|max:255'
            ]);

            $item = OriginType::find($item_id);
        }

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $item->origin_type = $request->input('origin_type', '');

        if($item->save())
            return response()->json(['success'=>'Record is successfully added']);
        else
            return response()->json(['errors'=> ['Record is not saved']]);
    }
}
