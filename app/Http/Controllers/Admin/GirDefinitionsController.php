<?php

namespace App\Http\Controllers\Admin;

use App\Models\GirDefinition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GirDefinitionsController extends Controller
{
    //
    public function get_all()
    {
        $data['records'] = GirDefinition::all();
        return view('admin.gir_definitions.list', $data);
    }

    public function edit(Request $request)
    {
        $item_id = $request['id'];
        if($item_id == 0)
            $data['record'] = array();
        else
            $data['record'] = GirDefinition::find($item_id);

        return view('admin.gir_definitions.edit', $data);
    }

    public function delete(Request $request)
    {
        $item_id = $request->get('delete_item_id');
        $item = GirDefinition::find($item_id);

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
                'definition' => 'required|max:50'
            ]);

            $item = new GirDefinition;
        } else {
            $validator = \Validator::make($request->all(), [
                'definition' => 'required|max:50'
            ]);

            $item = GirDefinition::find($item_id);
        }

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $item->definition = $request->input('definition', '');

        if($item->save())
            return response()->json(['success'=>'Record is successfully added']);
        else
            return response()->json(['errors'=> ['Record is not saved']]);
    }
}
