<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $record_id = $request->get('record_id');
        $record_table = $request->get('record_table');
        $data['histories'] = array();

        switch ($record_table) {
            case 'members' : $data['histories'] = History::where('contractor_accident_id', $record_id)->get(); break;
            case 'accidents' : $data['histories'] = History::where('accident_id', $record_id)->get(); break;
            case 'contractor_accidents' : $data['histories'] = History::where('contractor_accident_id', $record_id)->get(); break;
            case 'health_concerns' : $data['histories'] = History::where('health_concern_id', $record_id)->get();  break;
            case 'reduced_flexibilities' : $data['histories'] = History::where('reduced_flexibility_id', $record_id)->get(); break;
            case 'workplace_investigations' : $data['histories'] = History::where('workplace_investigation_id', $record_id)->get();  break;
        }

        return view('histories.list', $data);
    }
}
