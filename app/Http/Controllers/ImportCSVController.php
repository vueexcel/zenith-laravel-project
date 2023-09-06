<?php

namespace App\Http\Controllers;

use App\Imports\MembersImport;
use App\Jobs\ImportCSVOfMembers;
use App\Models\GroupCode;
use App\Models\ImportCSV;
use App\Models\Member;
use App\Models\Supervisor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Excel;
use Rap2hpoutre\FastExcel\FastExcel;

class ImportCSVController extends Controller
{
    //

    public function index()
    {
        $data['settings'] = ImportCSV::find(1);
        return view('import_csv.index', $data);
    }

    public function save(Request $request)
    {
        $import_url = $request->get('import_url');
        $set_time = $request->get('set_time');

        $setting = ImportCSV::find(1);

        if($setting == null) {
            $setting = new ImportCSV();
        }

        $setting->set_time = $set_time;
        $setting->import_url = $import_url;

        if($setting->save())
            return response()->json(['message' => 'ok']);
        else
            return response()->json(['message' => 'fail']);
    }

    public function import()
    {
        $setting = ImportCSV::find(1);
        if($setting == null) {
            return response()->json(['errors' => ['Url setting is not existed.']]);
        }
        else {
            $import_url = $setting->import_url;
            $import_url = pathinfo($import_url, PATHINFO_FILENAME) . '.' . strtolower(pathinfo($import_url, PATHINFO_EXTENSION));
            Excel::import(new MembersImport, storage_path($import_url));
            $import_csv = ImportCSV::find(1);
            $import_csv->last_import = date('Y-m-d H:i:s');
            $import_csv->save();
            return response()->json(['message' => date('d-m-Y H:i:s')]);
            /*dispatch(new ImportCSVOfMembers());
            if ($result == true) {
                $import_csv = ImportCSV::find(1);
                $import_csv->last_import = date('Y-m-d H:i:s');
                $import_csv->save();
                return response()->json(['message' => date('d-m-Y H:i:s')]);
            } else {
                return response()->json(['errors' => ['Import failed.']]);
            }*/
        }
    }
}
