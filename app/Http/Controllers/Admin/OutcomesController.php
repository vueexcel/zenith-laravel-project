<?php

namespace App\Http\Controllers\Admin;

use App\Models\Outcome;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OutcomesController extends Controller
{
    //
    public function get_all()
    {
        $data['records'] = Outcome::all();
        return view('admin.outcomes.list', $data);
    }

    public function edit(Request $request)
    {
        $item_id = $request['id'];
        if($item_id == 0)
            $data['record'] = array();
        else
            $data['record'] = Outcome::find($item_id);

        return view('admin.outcomes.edit', $data);
    }

    public function delete(Request $request)
    {
        $item_id = $request->get('delete_item_id');
        $item = Outcome::find($item_id);

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
                'outcome' => 'required|max:255'
            ]);

            $item = new Outcome;
        } else {
            $validator = \Validator::make($request->all(), [
                'outcome' => 'required|max:255'
            ]);

            $item = Outcome::find($item_id);
        }

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $item->outcome = $request->input('outcome', '');

        if($item->save())
            return response()->json(['success'=>'Record is successfully added']);
        else
            return response()->json(['errors'=> ['Record is not saved']]);
    }
}
