<?php

namespace App\Http\Controllers\Admin;

use App\Models\IncidentType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IncidentTypesController extends Controller
{
    //
    public function get_all()
    {
        $data['records'] = IncidentType::all();
        return view('admin.incident_types.list', $data);
    }

    public function edit(Request $request)
    {
        $item_id = $request['id'];
        if($item_id == 0)
            $data['record'] = array();
        else
            $data['record'] = IncidentType::find($item_id);

        return view('admin.incident_types.edit', $data);
    }

    public function delete(Request $request)
    {
        $item_id = $request->get('delete_item_id');
        $item = IncidentType::find($item_id);

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
                'incident' => 'required|max:50'
            ]);

            $item = new IncidentType;
        } else {
            $validator = \Validator::make($request->all(), [
                'incident' => 'required|max:50'
            ]);

            $item = IncidentType::find($item_id);
        }

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $item->incident = $request->input('incident', '');

        if($item->save())
            return response()->json(['success'=>'Record is successfully added']);
        else
            return response()->json(['errors'=> ['Record is not saved']]);
    }
}
