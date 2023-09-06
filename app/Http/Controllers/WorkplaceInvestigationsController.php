<?php

namespace App\Http\Controllers;

use App\Models\Accident;
use App\Models\Member;
use App\Models\WorkplaceInvestigation;
use App\Traits\Controllers\ResourceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class WorkplaceInvestigationsController extends Controller
{
    //
    use ResourceController;

    protected $resourceAlias = 'workplace_investigations';

    protected $resourceRoutesAlias = 'workplace_investigations';

    protected $resourceModel = WorkplaceInvestigation::class;

    /**
     * @var string
     */
    protected $resourceTitle = 'Incident Investigations';

    /**
     * Used to validate store.
     *
     * @return array
     */
    private function resourceStoreValidationData()
    {
        return [
            'rules' => [
                'member_id' => 'required',
                'incident_type_id' => 'required',
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
                'member_id' => 'required',
                'incident_type_id' => 'required',
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
        $values = [];
        $values['site'] = $request->input('site', '');
        $values['incident_type_id'] = $request->input('incident_type_id', '');
        $values['logged_date'] = $request->input('logged_date', '');
        if($values['logged_date'] != "")
            $values['logged_date'] = $this->convertDateString($values['logged_date']);

        $values['incident_date'] = $request->input('incident_date', '');
        if($values['incident_date'] != "")
            $values['incident_date'] = $this->convertDateString($values['incident_date']);

        $values['reported_date'] = $request->input('reported_date', '');
        if($values['reported_date'] != "")
            $values['reported_date'] = $this->convertDateString($values['reported_date']);

        $values['member_id'] = $request->input('member_id', '');
        $values['incident_location'] = $request->input('incident_location', '');
        //$values['supervisor'] = $request->input('supervisor', '');
        $values['group_code_id'] = $request->input('group_code_id', '');
        $values['key_point_summary'] = $request->input('key_point_summary', '');

        $values['work_type_id'] = $request->input('work_type_id', '');
        $values['root_cause'] = $request->input('root_cause', '');
        $values['user_id'] = Auth::user()->id;

        //If new member
        $values['new_member_id'] = $request->input('new_member_id', '');
        if($values['new_member_id'] > 0) {
            $values['member_id'] = $values['new_member_id'];
            $new_member = Member::find($values['new_member_id']);
            $new_member->surname = $request->input('surname', '');
            $new_member->name = $request->input('name', '');
            $new_member->group_code = $request->input('group_code', '');
            $new_member->occupation = $request->input('occupation', '');
            $new_member->department = $request->input('department', '');
            $new_member->save();
        }

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
            return $this->getResourceModel()::where('is_deleted', 0)->when(! empty($search), function ($query) use ($search,$member_ids) {
                $query->where(function ($query) use ($search,$member_ids) {
                    $query->where('logged_date', 'like', "%$search%")
                        ->orWhere('supervisor', 'like', "%$search%")
                        ->orWhereIn('member_id', $member_ids);
                });
            })->orderBy('id', 'desc')->paginate($perPage);
        } else {
            return $this->getResourceModel()::where('is_deleted', 0)->when(! empty($search), function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('logged_date', 'like', "%$search%")
                        ->orWhere('supervisor', 'like', "%$search%");
                });
            })->orderBy('updated_at', 'desc')->paginate($perPage);
        }
    }


    public function getList(Request $request)
    {
        if(\request()->ajax()){
            $incident_investigations = WorkplaceInvestigation::where('is_deleted', 0)->with('member')->with('incident_type');
            return DataTables::eloquent($incident_investigations)
                ->editColumn('incident_date', function($data) {
                    if($data->incident_date != null && $data->incident_date != "" && $data->incident_date != "0000-00-00")
                        return date('d/m/Y', strtotime($data->incident_date));
                })
                ->editColumn('logged_date', function($data) {
                    if($data->logged_date != null && $data->logged_date != "" && $data->logged_date != "0000-00-00")
                        return date('d/m/Y', strtotime($data->logged_date));
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
