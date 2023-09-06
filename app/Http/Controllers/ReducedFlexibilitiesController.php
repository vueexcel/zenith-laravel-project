<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\ReducedFlexibility;
use App\Models\WorkplaceInvestigation;
use App\Traits\Controllers\ResourceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class ReducedFlexibilitiesController extends Controller
{
    //
    use ResourceController;

    protected $resourceAlias = 'reduced_flexibilities';

    protected $resourceRoutesAlias = 'reduced_flexibilities';

    protected $resourceModel = ReducedFlexibility::class;

    /**
     * @var string
     */
    protected $resourceTitle = 'Reduced Flexibility';

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
        $values['supervisor_id'] = $request->input('supervisor_id', '');
        if($values['supervisor_id'] == "")
            $values['supervisor_id'] = null;
        $values['outcome'] = $request->input('outcome', '');

        $values['l4_date'] = $request->input('l4_date', '');
        if($values['l4_date'] != "")
            $values['l4_date'] = $this->convertDateString($values['l4_date']);

        $values['restricted_status'] = $request->input('restricted_status', '');
        $values['category_id'] = $request->input('category_id', '');
        $values['no_of_online_processes'] = $request->input('no_of_online_processes', '');
        $values['no_of_offline_processes'] = 0;
        //$values['comments'] = $request->input('comments', '');
        $values['group_code_id'] = $request->input('group_code_id', '');

        $values['initial_medical_date'] = $request->input('initial_medical_date', '');
        if($values['initial_medical_date'] != "")
            $values['initial_medical_date'] = $this->convertDateString($values['initial_medical_date']);

        $values['initial_medical_time'] = $request->input('initial_medical_time', '');
        $values['temp_placed_in_headcount_position'] = $request->input('temp_placed_in_headcount_position', '');
        $values['perm_placed_in_headcount_position'] = $request->input('perm_placed_in_headcount_position', '');

        $values['placement_date'] = $request->input('placement_date', '');
        if($values['placement_date'] != "")
            $values['placement_date'] = $this->convertDateString($values['placement_date']);

        $values['process'] = $request->input('process', '');
        $values['action'] = $request->input('action', '');
        //$values['resp'] = $request->input('resp', '');

        //$values['timing'] = $request->input('timing', '');
        //$values['timing'] = $this->convertDateString($values['timing']);

        $values['origin'] = $request->input('origin', '');

        //$values['actual_timing'] = $request->input('actual_timing', '');
        //$values['actual_timing'] = $this->convertDateString($values['actual_timing']);

        //$values['last_review'] = $request->input('last_review', '');
        //$values['last_review'] = $this->convertDateString($values['last_review']);

        $values['ramp_up'] = $request->input('ramp_up', '');

        $values['fully_fit_date'] = $request->input('fully_fit_date', '');
        if($values['fully_fit_date'] != "")
            $values['fully_fit_date'] = $this->convertDateString($values['fully_fit_date']);

        $values['user_id'] = Auth::user()->id;

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
                    $query->where('l4_date', 'like', "%$search%")
                        ->orWhere('comments', 'like', "%$search%")
                        ->orWhereIn('member_id', $member_ids);
                });
            })->orderBy('updated_at', 'desc')->paginate($perPage);
        } else {
            return $this->getResourceModel()::where('is_deleted', 0)->when(! empty($search), function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('l4_date', 'like', "%$search%")
                        ->orWhere('comments', 'like', "%$search%");
                });
            })->orderBy('updated_at', 'desc')->paginate($perPage);
        }
    }

    public function getList(Request $request)
    {
        if(\request()->ajax()){
            $reduced_flexibility = ReducedFlexibility::where('is_deleted', 0)->with('member')->with('category');
            return DataTables::eloquent($reduced_flexibility)
                ->editColumn('fully_fit_date', function($data) {
                    if($data->fully_fit_date != null && $data->fully_fit_date != "" && $data->fully_fit_date != "0000-00-00")
                        return date('d/m/Y', strtotime($data->fully_fit_date));
                })
                ->editColumn('l4_date', function($data) {
                    if($data->l4_date != null && $data->l4_date != "" && $data->l4_date != "0000-00-00")
                        return date('d/m/Y', strtotime($data->l4_date));
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
