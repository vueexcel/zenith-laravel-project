<?php

namespace App\Http\Controllers;

use App\Models\FireIncident;
use App\Models\Member;
use App\Traits\Controllers\ResourceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use DateTime;

class FireIncidentsController extends Controller
{
    //
    use ResourceController;

    protected $resourceAlias = 'fire_incidents';

    protected $resourceRoutesAlias = 'fire_incidents';

    protected $resourceModel = FireIncident::class;

    /**
     * @var string
     */
    protected $resourceTitle = 'FireIncidents';

    /**
     * Used to validate store.
     *
     * @return array
     */
    private function resourceStoreValidationData()
    {
        return [
            'rules' => [
                'member_id' => 'required'
            ],
            'messages' => [],
            'attributes' => [],
        ];
    }

    /**
     * Used to validate update.
     *
     * @param $record
     * @return array
     */
    private function resourceUpdateValidationData($record)
    {
        return [
            'rules' => [
                'member_id' => 'required'
            ],
            'messages' => [],
            'attributes' => [],
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param null $record
     * @return array
     */
    private function getValuesToSave(Request $request, $record = null)
    {
        //$creating = is_null($record);
        $values = [];
        $values['member_id'] = $request->input('member_id', '');

        $values['logged_date'] = $request->input('logged_date', '');
        if($values['logged_date'] != "")
            $values['logged_date'] = $this->convertDateString($values['logged_date']);

        $values['reported_date'] = $request->input('reported_date', '');
        if($values['reported_date'] != "")
            $values['reported_date'] = $this->convertDateString($values['reported_date']);

        $values['incident_date'] = $request->input('incident_date', '');
        if($values['incident_date'] != "")
            $values['incident_date'] = $this->convertDateString($values['incident_date']);

        $values['group_code_id'] = $request->input('group_code_id', '');
        $values['location'] = $request->input('location', '');
        $values['summary'] = $request->input('summary', '');
        $values['root_cause'] = $request->input('root_cause', '');
        $values['significant'] = $request->input('significant', '');
        $values['stop6'] = $request->input('stop6', '');
        $values['work_type_id'] = $request->input('work_type_id', '');

        return $values;
    }

    private function alterValuesToSave(Request $request, $values)
    {
        return $values;
    }

    /**
     * @param $record
     * @return bool
     */
    private function checkDestroy($record)
    {
        return true;
    }

    /**
     * Retrieve the list of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $perPage
     * @param string|null $search
     * @return \Illuminate\Support\Collection
     */
    private function getSearchRecords(Request $request, $perPage = 15, $search = null)
    {
        if($search != null && $search != "") {
            $member_ids = Member::where('member_no', $search)->orWhere('surname', 'like', '%'.$search.'%')->orWhere('name', 'like', '%'.$search.'%')->pluck('id')->toArray();
            return $this->getResourceModel()::where('is_deleted', 0)->when(! empty($search), function ($query) use ($search, $member_ids) {
                $query->where(function ($query) use ($search, $member_ids) {
                    $query->where('member_statement', 'like', "%$search%")
                        ->orWhere('ohc_comment', 'like', "%$search%")
                        ->orWhereIn('member_id', $member_ids);;
                });
            })->orderBy('updated_at', 'desc')->paginate($perPage);
        } else {
            return $this->getResourceModel()::where('is_deleted', 0)->when(! empty($search), function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('member_statement', 'like', "%$search%")
                        ->orWhere('ohc_comment', 'like', "%$search%");
                });
            })->orderBy('updated_at', 'desc')->paginate($perPage);
        }
    }

    public function getList(Request $request)
    {
        if(\request()->ajax()){
            $fire_incidents = FireIncident::with('member')->with('work_type')->with('group_code')->where('fire_incidents.is_deleted', 0)->select("fire_incidents.*");

            if ($request->has("logged_date_from"))
                $fire_incidents = $fire_incidents->where("logged_date", "<=", DateTime::createFromFormat("d/m/Y", $request->input("logged_date_from"))->format("Y-m-d"));
            if ($request->has("logged_date_to"))
                $fire_incidents = $fire_incidents->where("logged_date", ">=", DateTime::createFromFormat("d/m/Y", $request->input("logged_date_to"))->format("Y-m-d"));
            if ($request->has("incident_date_from"))
                $fire_incidents = $fire_incidents->where("incident_date", "<=", DateTime::createFromFormat("d/m/Y", $request->input("incident_date_from"))->format("Y-m-d"));
            if ($request->has("incident_date_to"))
                $fire_incidents = $fire_incidents->where("incident_date", ">=", DateTime::createFromFormat("d/m/Y", $request->input("incident_date_to"))->format("Y-m-d"));
            if ($request->has("reported_date_from"))
                $fire_incidents = $fire_incidents->where("reported_date", "<=", DateTime::createFromFormat("d/m/Y", $request->input("reported_date_from"))->format("Y-m-d"));
            if ($request->has("reported_date_to"))
                $fire_incidents = $fire_incidents->where("reported_date", ">=", DateTime::createFromFormat("d/m/Y", $request->input("reported_date_to"))->format("Y-m-d"));
            if ($request->has("member_nos"))
                $fire_incidents = $fire_incidents->whereHas("member", function($query) use ($request) {
                    $query->whereIn("member_no", explode(",", $request->input("member_nos")));
                });
            if ($request->has("names"))
                $fire_incidents = $fire_incidents->whereHas("member", function($query) use ($request) {
                    $query->whereIn("name", explode(",", $request->input("names")));
                });

            if ($request->has("surnames"))
                $fire_incidents = $fire_incidents->whereHas("member", function($query) use ($request) {
                    $query->whereIn("surname", explode(",", $request->input("surnames")));
                });
            if ($request->has("group_codes"))
                $fire_incidents = $fire_incidents->whereHas("member", function($query) use ($request) {
                    $query->whereIn("group_code", explode(",", $request->input("group_codes")));
                });
            if ($request->has("location"))
                $fire_incidents = $fire_incidents->whereIn("group_code", explode(",", $request->input("location")));
            if ($request->has("summary"))
                $fire_incidents = $fire_incidents->whereIn("summary", explode(",", $request->input("summary")));
            if ($request->has("root_cause"))
                $fire_incidents = $fire_incidents->whereIn("root_cause", explode(",", $request->input("root_cause")));
            if ($request->has("stop6"))
                $fire_incidents = $fire_incidents->whereIn("stop6", $request->input("stop6"));
            if ($request->has("significant"))
                $fire_incidents = $fire_incidents->whereIn("significant", $request->input("significant"));

            return DataTables::eloquent($fire_incidents)
                ->editColumn('member.member_no', function ($data){
                    if($data->member)
                        return $data->member->member_no;
                    else
                        return "";
                })
                ->editColumn('reported_date', function($data) {
                    if($data->reported_date != null && $data->reported_date != "" && $data->reported_date != "0000-00-00")
                        return date('d/m/Y', strtotime($data->reported_date));
                })
                ->editColumn('logged_date', function($data) {
                    if($data->logged_date != null && $data->logged_date != "" && $data->logged_date != "0000-00-00")
                        return date('d/m/Y', strtotime($data->logged_date));
                })
                ->editColumn('incident_date', function($data) {
                    if($data->incident_date != null && $data->incident_date != "" && $data->incident_date != "0000-00-00")
                        return date('d/m/Y', strtotime($data->incident_date));
                })
                ->editColumn('updated_at', function($data) {
                    if($data->updated_at != null && $data->updated_at != "" && $data->updated_at != "0000-00-00")
                        return date('d/m/Y H:i', strtotime($data->updated_at));
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group">';
                    $button .= '<a href="'.route($this->resourceRoutesAlias.'.edit', $data->id).'" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>';
                    $button .= '<a href="#" class="btn btn-danger btn-sm btnOpenerModalConfirmModelDelete" data-form-id="formDeleteModel_'.$data->id.'"><i class="fa fa-trash-o"></i></a>';
                    $button .= '</div>';
                    $button .= '<form id="formDeleteModel_'.$data->id.'" action="'.route($this->resourceRoutesAlias.'.destroy', $data->id).'" method="POST" style="display: none;" class="hidden form-inline">';
                    $button .= csrf_field();
                    $button .= '<input type="hidden" name="_method" value="DELETE">';
                    $button .= '<button type="submit" class="btn btn-danger">Delete</button>';
                    $button .= '</form>';
                    return $button;
                })
                ->toJson();
        }
    }
}
