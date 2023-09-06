<?php

namespace App\Http\Controllers;

use App\Models\Accident;
use App\Models\ContractorAccident;
use App\Models\Member;
use App\Traits\Controllers\ResourceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class ContractorAccidentsController extends Controller
{
    //
    use ResourceController;

    protected $resourceAlias = 'contractor_accidents';

    protected $resourceRoutesAlias = 'contractor_accidents';

    protected $resourceModel = ContractorAccident::class;

    /**
     * @var string
     */
    protected $resourceTitle = 'Contractor Accidents';

    /**
     * Used to validate store.
     *
     * @return array
     */
    private function resourceStoreValidationData()
    {
        return [
            'rules' => [
                't_number' => 'required|min:3|max:10',
                'member_id' => 'required',
                'accident_date' => 'required',
                'reported_date' => 'required',
                'logged_date' => 'required',
                'contractor_name' => 'required|min:3|max:255',
                'contracting_company' => 'required|min:3|max:255',
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
                't_number' => 'required',
                'member_id' => 'required',
                'accident_date' => 'required',
                'reported_date' => 'required',
                'logged_date' => 'required',
                'contractor_name' => 'required|min:3|max:255',
                'contracting_company' => 'required|min:3|max:255',
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
        $values['member_id'] = $request->input('member_id', '');
        $values['t_number'] = $request->input('t_number', '');
        $values['accident_date'] = $request->input('accident_date', '');
        if($values['accident_date'] != "")
            $values['accident_date'] = $this->convertDateString($values['accident_date']);

        $values['reported_date'] = $request->input('reported_date', '');
        if($values['reported_date'] != "")
            $values['reported_date'] = $this->convertDateString($values['reported_date']);

        $values['logged_date'] = $request->input('logged_date', '');
        if($values['logged_date'] != "")
            $values['logged_date'] = $this->convertDateString($values['logged_date']);

        $values['contractor_name'] = $request->input('contractor_name', '');
        $values['contracting_company'] = $request->input('contracting_company', '');
        $values['contractor_statement'] = $request->input('contractor_statement', '');
        $values['injury_type_id'] = $request->input('injury_type_id', '');
        $values['body_part_id'] = $request->input('body_part_id', '');
        $values['ohc_comment'] = $request->input('ohc_comment', '');
        $values['outcome_id'] = $request->input('outcome_id', '');
        $values['causation_factor_id'] = $request->input('causation_factor_id', '');
        $values['escalation'] = $request->input('escalation', '');

        $values['lt_start_date'] = $request->input('lt_start_date', '');
        if($values['lt_start_date'] != "")
            $values['lt_start_date'] = $this->convertDateString($values['lt_start_date']);

        $values['days_lost'] = $request->input('days_lost', '');

        $values['report_required'] = $request->input('report_required', '');
        $values['report_received'] = $request->input('report_received', '');

        $values['report_received_date'] = $request->input('report_received_date', '');
        if($values['report_received_date'] != "")
            $values['report_received_date'] = $this->convertDateString($values['report_received_date']);

        $values['significant_incident'] = $request->input('significant_incident', '');
        $values['statistics'] = $request->input('statistics', '');

        $values['user_id'] = Auth::user()->id;

        //If new member
        $values['new_member_id'] = $request->input('new_member_id', '');
        if($values['new_member_id'] > 0) {
            $values['member_id'] = $values['new_member_id'];
            $new_member = Member::find($values['new_member_id']);
            $new_member->surname = $request->input('tcr_surname', '');
            $new_member->name = $request->input('tcr_name', '');
            $new_member->group_code = $request->input('tcr_group_code', '');
            $new_member->department = $request->input('tcr_department', '');
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
                $query->where(function ($query) use ($search, $member_ids) {
                    $query->where('t_number', 'like', "%$search%")
                        ->orWhere('contractor_name', 'like', "%$search%")
                        ->orWhere('contracting_company', 'like', "%$search%")
                        ->orWhereIn('member_id', $member_ids);
                });
            })->orderBy('updated_at', 'desc')->paginate($perPage);
        } else {
            return $this->getResourceModel()::where('is_deleted', 0)->when(! empty($search), function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('t_number', 'like', "%$search%")
                        ->orWhere('contractor_name', 'like', "%$search%")
                        ->orWhere('contracting_company', 'like', "%$search%");
                });
            })->orderBy('updated_at', 'desc')->paginate($perPage);
        }
    }


    public function getList(Request $request)
    {
        if(\request()->ajax()){
            $contractor_accidents = ContractorAccident::where('is_deleted', 0)->with('member');
            return DataTables::eloquent($contractor_accidents)
                ->editColumn('accident_date', function($data) {
                    if($data->accident_date != null && $data->accident_date != "" && $data->accident_date != "0000-00-00")
                        return date('d/m/Y', strtotime($data->accident_date));
                })
                ->editColumn('updated_at', function($data) {
                    if($data->updated_at != null && $data->updated_at != "" && $data->updated_at != "0000-00-00")
                        return date('d/m/Y H:i', strtotime($data->updated_at));
                })
                ->addColumn('action', function ($contractor_accidents) {
                    $button = '<div class="btn-group">';
                    $button .= '<a href="'.route($this->resourceRoutesAlias.'.edit', $contractor_accidents->id).'" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>';
                    $button .= '<a href="#" class="btn btn-danger btn-sm btnOpenerModalConfirmModelDelete" data-form-id="formDeleteModel_'.$contractor_accidents->id.'"><i class="fa fa-trash-o"></i></a>';
                    $button .= '</div>';
                    $button .= '<form id="formDeleteModel_'.$contractor_accidents->id.'" action="'.route($this->resourceRoutesAlias.'.destroy', $contractor_accidents->id).'" method="POST" style="display: none;" class="hidden form-inline">';
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
