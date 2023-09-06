<?php

namespace App\Http\Controllers\Admin;

use App\Reports;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('dashboard.index', ['reports' => new Reports()]);
    }
}
