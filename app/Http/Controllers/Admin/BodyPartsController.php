<?php

namespace App\Http\Controllers\Admin;

use App\Models\BodyPart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BodyPartsController extends Controller
{
    //
    public function get_all()
    {
        $data['records'] = BodyPart::all();
        return view('admin.body_parts.list', $data);
    }

    public function edit(Request $request)
    {
        $item_id = $request['id'];
        if($item_id == 0)
            $data['record'] = array();
        else
            $data['record'] = BodyPart::find($item_id);

        return view('admin.body_parts.edit', $data);
    }

    public function delete(Request $request)
    {
        $item_id = $request->get('delete_item_id');
        $item = BodyPart::find($item_id);

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
                'body_part' => 'required|max:255'
            ]);

            $item = new BodyPart;
        } else {
            $validator = \Validator::make($request->all(), [
                'body_part' => 'required|max:255'
            ]);

            $item = BodyPart::find($item_id);
        }

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $item->body_part = $request->input('body_part', '');

        if($item->save())
            return response()->json(['success'=>'Record is successfully added']);
        else
            return response()->json(['errors'=> ['Record is not saved']]);
    }
}
