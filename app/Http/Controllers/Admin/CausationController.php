<?php

namespace App\Http\Controllers\Admin;

use App\Models\Causation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CausationController extends Controller
{
    //
    public function get_all()
    {
        $data['records'] = Causation::all();
        return view('admin.causation.list', $data);
    }

    public function edit(Request $request)
    {
        $item_id = $request['id'];
        if($item_id == 0)
            $data['record'] = array();
        else
            $data['record'] = Causation::find($item_id);

        return view('admin.causation.edit', $data);
    }

    public function delete(Request $request)
    {
        $item_id = $request->get('delete_item_id');
        $item = Causation::find($item_id);

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
                'causation' => 'required|max:50'
            ]);

            $item = new Causation;
        } else {
            $validator = \Validator::make($request->all(), [
                'causation' => 'required|max:50'
            ]);

            $item = Causation::find($item_id);
        }

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $item->causation = $request->input('causation', '');

        if($item->save())
            return response()->json(['success'=>'Record is successfully added']);
        else
            return response()->json(['errors'=> ['Record is not saved']]);
    }
}
