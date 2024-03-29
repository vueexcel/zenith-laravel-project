<?php

namespace App\Http\Controllers\Admin;

use App\Models\MssCausation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MssCausationController extends Controller
{
    //
    public function get_all()
    {
        $data['records'] = MssCausation::all();
        return view('admin.mss_causation.list', $data);
    }

    public function edit(Request $request)
    {
        $item_id = $request['id'];
        if($item_id == 0)
            $data['record'] = array();
        else
            $data['record'] = MssCausation::find($item_id);

        return view('admin.mss_causation.edit', $data);
    }

    public function delete(Request $request)
    {
        $item_id = $request->get('delete_item_id');
        $item = MssCausation::find($item_id);

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
                'mss_number' => 'required|unique:mss_causations,mss_number'
            ]);

            $item = new MssCausation;
        } else {
            $validator = \Validator::make($request->all(), [
                'mss_number' => 'required|unique:mss_causations,mss_number,'.$request->get('item_id'),
            ]);

            $item = MssCausation::find($item_id);
        }

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $item->mss_causation = $request->input('mss_causation', '');
        $item->mss_number = $request->input('mss_number', '');


        if($item->save())
            return response()->json(['success'=>'Record is successfully added']);
        else
            return response()->json(['errors'=> ['Record is not saved']]);
    }
}
