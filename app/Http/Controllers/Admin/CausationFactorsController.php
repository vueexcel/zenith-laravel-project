<?php

namespace App\Http\Controllers\Admin;

use App\Models\CausationFactor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CausationFactorsController extends Controller
{
    //
    public function get_all()
    {
        $data['records'] = CausationFactor::all();
        return view('admin.causation_factors.list', $data);
    }

    public function edit(Request $request)
    {
        $item_id = $request['id'];
        if($item_id == 0)
            $data['record'] = array();
        else
            $data['record'] = CausationFactor::find($item_id);

        return view('admin.causation_factors.edit', $data);
    }

    public function delete(Request $request)
    {
        $item_id = $request->get('delete_item_id');
        $item = CausationFactor::find($item_id);

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
                'number' => 'required|unique:causation_factors,number',
                'causation_factor' => 'required|max:100'
            ]);

            $item = new CausationFactor;
        } else {
            $validator = \Validator::make($request->all(), [
                'number' => 'required|unique:causation_factors,number,'.$request->get('item_id'),
                'causation_factor' => 'required|max:100',
            ]);

            $item = CausationFactor::find($item_id);
        }

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $item->number = $request->input('number', '');
        $item->causation_factor = $request->input('causation_factor', '');

        if($item->save())
            return response()->json(['success'=>'Record is successfully added']);
        else
            return response()->json(['errors'=> ['Record is not saved']]);
    }
}
