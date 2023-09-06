<?php

namespace App\Http\Controllers\Admin;

use App\Models\SeenBy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeenByController extends Controller
{
    //
    public function get_all()
    {
        $data['records'] = SeenBy::all();
        return view('admin.seen_by.list', $data);
    }

    public function edit(Request $request)
    {
        $item_id = $request['id'];
        if($item_id == 0)
            $data['record'] = array();
        else
            $data['record'] = SeenBy::find($item_id);

        return view('admin.seen_by.edit', $data);
    }

    public function delete(Request $request)
    {
        $item_id = $request->get('delete_item_id');
        $item = SeenBy::find($item_id);

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
                'seen_by' => 'required|max:50'
            ]);

            $item = new SeenBy;
        } else {
            $validator = \Validator::make($request->all(), [
                'seen_by' => 'required|max:50'
            ]);

            $item = SeenBy::find($item_id);
        }

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $item->seen_by = $request->input('seen_by', '');

        if($item->save())
            return response()->json(['success'=>'Record is successfully added']);
        else
            return response()->json(['errors'=> ['Record is not saved']]);
    }
}
