<?php

namespace App\Http\Controllers;

use App\Models\Accident;
use App\Models\HealthConcern;
use App\Models\Member;
use App\Traits\Controllers\ResourceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use DateTime;

class AccidentsController extends Controller
{
    //
    use ResourceController;

    protected $resourceAlias = 'accidents';

    protected $resourceRoutesAlias = 'accidents';

    protected $resourceModel = Accident::class;

    /**
     * @var string
     */
    protected $resourceTitle = 'Accidents';

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

        $values['accident_date'] = $request->input('accident_date', '');
        if($values['accident_date'] != "")
            $values['accident_date'] = $this->convertDateString($values['accident_date']);

        $values['reported_date'] = $request->input('reported_date', '');
        if($values['reported_date'] != "")
            $values['reported_date'] = $this->convertDateString($values['reported_date']);

        $values['reported_date'] = $request->input('reported_date', '');
        if($values['reported_date'] != "")
            $values['reported_date'] = $this->convertDateString($values['reported_date']);

        //$values['supervisor_id'] = $request->input('supervisor_id', '');
        $values['member_statement'] = $request->input('member_statement', '');
        $values['injury_type_id'] = $request->input('injury_type_id', '');
        $values['body_part_id'] = $request->input('body_part_id', '');
        $values['ohc_comment'] = $request->input('ohc_comment', '');
        $values['outcome_id'] = $request->input('outcome_id', '');

        $values['causation_factor_id'] = $request->input('causation_factor_id', '');
        $values['escalation'] = $request->input('escalation', '');

        $values['lt_start_date'] = $request->input('lt_start_date', '');
        if($values['lt_start_date'] != "")
            $values['lt_start_date'] = $this->convertDateString($values['lt_start_date']);
        else
            $values['lt_start_date'] = null;


        $values['days_lost'] = $request->input('days_lost', '');
        if($values['days_lost'] == "")
            $values['days_lost'] = 0;

        $values['wi_required'] = $request->input('wi_required', '');

        $values['wi_part_1_received'] = $request->input('wi_part_1_received', '');
        if($values['wi_part_1_received'] != "")
            $values['wi_part_1_received'] = $this->convertDateString($values['wi_part_1_received']);

        $values['wi_part_2_received'] = $request->input('wi_part_2_received', '');
        if($values['wi_part_2_received'] != "")
            $values['wi_part_2_received'] = $this->convertDateString($values['wi_part_2_received']);

        $values['gir_definition_id'] = $request->input('gir_definition_id', '');
        $values['gir_reason'] = $request->input('gir_reason', '');
        $values['group_code_id'] = $request->input('group_code_id', '');
        $values['statistics'] = $request->input('statistics', '');
        $values['stop_6'] = $request->input('stop_6', '');
        $values['riddor'] = $request->input('riddor', '');
        $values['riddor_reason'] = $request->input('riddor_reason', '');
        $values['user_id'] = Auth::user()->id;
        $values['monthly_stats'] = $request->input('monthly_stats', '');

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
            $accidents = Accident::with('member')->with('injury_type')->with('body_part')->with('group_code')->with('causation_factor')->where('accidents.is_deleted', 0);

            if ($request->has("date_from"))
                $accidents = $accidents->where("logged_date", ">=", DateTime::createFromFormat("d/m/Y", $request->input("date_from"))->format("Y-m-d"));
            if ($request->has("date_to"))
                $accidents = $accidents->where("logged_date", "<=", DateTime::createFromFormat("d/m/Y", $request->input("date_to"))->format("Y-m-d"));
            if ($request->has("member_nos"))
                $accidents = $accidents->whereHas("member", function($query) use ($request) {
                    $query->whereIn("member_no", explode(",", $request->input("member_nos")));
                });
            if ($request->has("names"))
                $accidents = $accidents->whereHas("member", function($query) use ($request) {
                    $query->whereIn("name", explode(",", $request->input("names")));
                });
            if ($request->has("surnames"))
                $accidents = $accidents->whereHas("member", function($query) use ($request) {
                    $query->whereIn("surname", explode(",", $request->input("surnames")));
                });
            if ($request->has("group_codes"))
                $accidents = $accidents->whereHas("member", function($query) use ($request) {
                    $query->whereIn("group_code", explode(",", $request->input("group_codes")));
                });
            if ($request->has("reported_date_from"))
                $accidents = $accidents->where("reported_date", ">=", DateTime::createFromFormat("d/m/Y", $request->input("reported_date_from"))->format("Y-m-d"));
            if ($request->has("reported_date_to"))
                $accidents = $accidents->where("reported_date", "<=", DateTime::createFromFormat("d/m/Y", $request->input("reported_date_to"))->format("Y-m-d"));
            if ($request->has("accident_date_from"))
                $accidents = $accidents->where("accident_date", ">=", DateTime::createFromFormat("d/m/Y", $request->input("accident_date_from"))->format("Y-m-d"));
            if ($request->has("accident_date_to"))
                $accidents = $accidents->where("accident_date", "<=", DateTime::createFromFormat("d/m/Y", $request->input("accident_date_to"))->format("Y-m-d"));
            if ($request->has("ohc_date_from"))
                $accidents = $accidents->where("ohc_appointment", ">=", DateTime::createFromFormat("d/m/Y", $request->input("ohc_date_from"))->format("Y-m-d"));
            if ($request->has("ohc_date_to"))
                $accidents = $accidents->where("ohc_appointment", "<=", DateTime::createFromFormat("d/m/Y", $request->input("ohc_date_to"))->format("Y-m-d"));
            if ($request->has("injurys"))
                $accidents = $accidents->whereHas("injury_type", function($query) use ($request) {
                    $query->whereIn("injury", explode(",", $request->input("injurys")));
                });
            if ($request->has("body_parts"))
                $accidents = $accidents->whereHas("body_part", function($query) use ($request) {
                    $query->whereIn("body_part", explode(",", $request->input("body_parts")));
                });
            if ($request->has("outcomes"))
                $accidents = $accidents->whereHas("outcome", function($query) use ($request) {
                    $query->whereIn("outcome", explode(",", $request->input("outcomes")));
                });
            if ($request->has("causations"))
                $accidents = $accidents->whereHas("causation_factor", function($query) use ($request) {
                    $query->whereIn("causation_factor", explode(",", $request->input("causations")));
                });
            if ($request->has("escalations"))
                $accidents = $accidents->where("escalation", $request->input("escalations"));
            if ($request->has("absence_date_from"))
                $accidents = $accidents->where("lt_start_date", ">=", DateTime::createFromFormat("d/m/Y", $request->input("absence_date_from"))->format("Y-m-d"));
            if ($request->has("absence_date_to"))
                $accidents = $accidents->where("lt_start_date", "<=", DateTime::createFromFormat("d/m/Y", $request->input("absence_date_to"))->format("Y-m-d"));
            if ($request->has("days_lost_from"))
                $accidents = $accidents->where("days_lost_from", ">=", $request->input("days_lost_from"));
            if ($request->has("days_lost_to"))
                $accidents = $accidents->where("days_lost_to", "<=", $request->input("days_lost_to"));
            if ($request->has("gir_definitions"))
                $accidents = $accidents->whereHas("gir_definition", function($query) use ($request) {
                    $query->whereIn("definition", explode(",", $request->input("gir_definitions")));
                });
            if ($request->has("wi_required"))
                $accidents = $accidents->where("wi_required", $request->input("wi_required"));
            if ($request->has("riddor"))
                $accidents = $accidents->where("riddor", $request->input("riddor"));
            if ($request->has("stop_6"))
                $accidents = $accidents->where("stop_6", $request->input("stop_6"));

            // if ($request->has("lost_mss"))
            //     $accidents = $accidents->whereIn("lost_time_mss", $request->input("lost_mss"));
            // if ($request->has("current_levels"))
            //     $accidents = $accidents->whereIn("current_level", $request->input("current_levels"));

            return DataTables::eloquent($accidents)
                ->editColumn('member.member_no', function ($data){
                    if($data->member)
                        return $data->member->member_no;
                    else
                        return "";
                })
                ->editColumn('causation_factor.causation_factor', function ($data){
                    if($data->causation_factor)
                        return $data->causation_factor->number. " - ". $data->causation_factor->causation_factor;
                    else
                        return "";
                })
                ->editColumn('reported_date', function($data) {
                    if($data->reported_date != null && $data->reported_date != "" && $data->reported_date != "0000-00-00")
                        return date('d/m/Y', strtotime($data->reported_date));
                })
                ->editColumn('accident_date', function($data) {
                    if($data->accident_date != null && $data->accident_date != "" && $data->accident_date != "0000-00-00")
                        return date('d/m/Y', strtotime($data->accident_date));
                })
                ->editColumn('reported_date', function($data) {
                    if($data->reported_date != null && $data->reported_date != "" && $data->reported_date != "0000-00-00")
                        return date('d/m/Y', strtotime($data->reported_date));
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
