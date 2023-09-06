<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormsController extends Controller
{
    //
    public function index()
    {
        $data['title'] = 'Report';
        $data['sub_title'] = 'Forms';
        return view('report.forms', $data);
    }
}
