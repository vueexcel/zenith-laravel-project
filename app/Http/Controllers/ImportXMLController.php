<?php

namespace App\Http\Controllers;

use App\Jobs\ImportXMLofHC;
use App\Models\ImportCSV;
use App\Models\ImportXML;
use Illuminate\Http\Request;

class ImportXMLController extends Controller
{
    //

    public function index()
    {
        $data['settings'] = ImportXML::find(1);
        return view('import_xml.index', $data);
    }

    public function save(Request $request)
    {
        $import_url = $request->get('import_url');
        $set_time = $request->get('set_time');

        $setting = ImportXML::find(1);

        if($setting == null) {
            $setting = new ImportXML();
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
        $setting = ImportXML::find(1);
        if($setting == null) {
            return response()->json(['errors' => ['Url setting is not existed.']]);
        }
        else {
            $result = true;
            dispatch(new ImportXMLofHC());
            if ($result == true) {
                $import_csv = ImportXML::find(1);
                $import_csv->last_import = date('Y-m-d H:i:s');
                $import_csv->save();
                return response()->json(['message' => date('d-m-Y H:i:s')]);
            } else {
                return response()->json(['errors' => ['Import failed.']]);
            }
        }
    }
}
