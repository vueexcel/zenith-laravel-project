<?php

namespace App\Http\Controllers;

use App\Exports\ExceptionExport;
use App\Exports\MulitpleSheetExport;
use App\Models\Accident;
use App\Models\GroupCode;
use App\Models\HealthConcern;
use App\Models\Member;
use App\Models\NextStep;
use App\Models\OriginType;
use App\Traits\Controllers\ResourceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class HealthConcernsController extends Controller
{
    //
    use ResourceController;

    protected $resourceAlias = 'health_concerns';

    protected $resourceRoutesAlias = 'health_concerns';

    protected $resourceModel = HealthConcern::class;

    /**
     * @var string
     */
    protected $resourceTitle = 'Health Concerns';

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

        $values['logged_date'] = $request->input('logged_date', '');
        if(!empty($values['logged_date']))
            $values['logged_date'] = $this->convertDateString($values['logged_date']);

        $values['concern_date'] = $request->input('concern_date', '');
        if($values['concern_date'] != "")
            $values['concern_date'] = $this->convertDateString($values['concern_date']);

        $values['repeat'] = $request->input('repeat', '');

        /*$values['level_1_date'] = $request->input('level_1_date', '');
        if($values['level_1_date'] != "")
            $values['level_1_date'] = $this->convertDateString($values['level_1_date']);*/

        $values['body_part_id'] = $request->input('body_part_id', '');
        $values['symptoms'] = $request->input('symptoms', '');
        $values['origin'] = $request->input('origin', '');
        $values['origin_type_id'] = $request->input('origin_type_id', '');
        $values['wi_required'] = $request->input('wi_required', '');

        $values['wi_part_2_received'] = $request->input('wi_part_2_received', '');
        if($values['wi_part_2_received'] != "")
            $values['wi_part_2_received'] = $this->convertDateString($values['wi_part_2_received']);

        $values['wi_part_1_received'] = $request->input('wi_part_1_received', '');
        if($values['wi_part_1_received'] != "")
            $values['wi_part_1_received'] = $this->convertDateString($values['wi_part_1_received']);

        if($request->input('group_code_id')) {
            $values['group_code_id'] = $request->input('group_code_id', '');
        }

        $values['ohc_appointment'] = $request->input('ohc_appointment', '');
        if($values['ohc_appointment'] != "")
            $values['ohc_appointment'] = $this->convertDateString($values['ohc_appointment']);

        $values['appointment_reason'] = $request->input('appointment_reason', '');
        $values['initial_advice'] = $request->input('initial_advice', '');

        //Next Step 1
        $values['next_steps_1'] = $request->input('next_steps_1', '');
        $values['next_steps_1_date'] = $request->input('next_steps_1_date', '');
        if($values['next_steps_1_date'] != "")
            $values['next_steps_1_date'] = $this->convertDateString($values['next_steps_1_date']);

        //Next Step 2
        $values['next_steps_2'] = $request->input('next_steps_2', '');
        $values['next_steps_2_date'] = $request->input('next_steps_2_date', '');
        if($values['next_steps_2_date'] != "")
            $values['next_steps_2_date'] = $this->convertDateString($values['next_steps_2_date']);

        //Next Step 3
        $values['next_steps_3'] = $request->input('next_steps_3', '');
        $values['next_steps_3_date'] = $request->input('next_steps_3_date', '');
        if($values['next_steps_3_date'] != "")
            $values['next_steps_3_date'] = $this->convertDateString($values['next_steps_3_date']);

        //Next Step 4
        $values['next_steps_4'] = $request->input('next_steps_4', '');
        $values['next_steps_4_date'] = $request->input('next_steps_4_date', '');
        if($values['next_steps_4_date'] != "")
            $values['next_steps_4_date'] = $this->convertDateString($values['next_steps_4_date']);

        //Next Step 5
        $values['next_steps_5'] = $request->input('next_steps_5', '');
        $values['next_steps_5_date'] = $request->input('next_steps_5_date', '');
        if($values['next_steps_5_date'] != "")
            $values['next_steps_5_date'] = $this->convertDateString($values['next_steps_5_date']);

        //Next Step 6
        $values['next_steps_6'] = $request->input('next_steps_6', '');
        $values['next_steps_6_date'] = $request->input('next_steps_6_date', '');
        if($values['next_steps_6_date'] != "")
            $values['next_steps_6_date'] = $this->convertDateString($values['next_steps_6_date']);

        //Next Step 7
        $values['next_steps_7'] = $request->input('next_steps_7', '');
        $values['next_steps_7_date'] = $request->input('next_steps_7_date', '');
        if($values['next_steps_7_date'] != "")
            $values['next_steps_7_date'] = $this->convertDateString($values['next_steps_7_date']);

        //Next Step 8
        $values['next_steps_8'] = $request->input('next_steps_8', '');
        $values['next_steps_8_date'] = $request->input('next_steps_8_date', '');
        if($values['next_steps_8_date'] != "")
            $values['next_steps_8_date'] = $this->convertDateString($values['next_steps_8_date']);

        //Next Step 9
        $values['next_steps_9'] = $request->input('next_steps_9', '');
        $values['next_steps_9_date'] = $request->input('next_steps_9_date', '');
        if($values['next_steps_9_date'] != "")
            $values['next_steps_9_date'] = $this->convertDateString($values['next_steps_9_date']);


        $values['gmir'] = $request->input('gmir', '');

        if($request->input('outcome')) {
            $values['outcome'] = $request->input('outcome', '');
        }

        $values['current_level'] = $request->input('current_level', '');

        $values['level1_raised_date'] = $request->input('level1_raised_date', '');
        if($values['level1_raised_date'] != "")
            $values['level1_raised_date'] = $this->convertDateString($values['level1_raised_date']);

        $values['ramp_up'] = $request->input('ramp_up', '');

        $values['fully_fit'] = $request->input('fully_fit', '');
        if($values['fully_fit'] != "")
            $values['fully_fit'] = $this->convertDateString($values['fully_fit']);

        $values['discharge_date'] = $request->input('discharge_date', '');
        if($values['discharge_date'] != "")
            $values['discharge_date'] = $this->convertDateString($values['discharge_date']);


        $values['lost_time_mss'] = $request->input('lost_time_mss', '');

        $values['lt_start_date'] = $request->input('lt_start_date', '');
        if($values['lt_start_date'] != "")
            $values['lt_start_date'] = $this->convertDateString($values['lt_start_date']);

        if($request->input('mss_causation_id'))
            $values['mss_causation_id'] = $request->input('mss_causation_id','');

        if($request->input('lost_time_mss'))
            $values['lost_time_mss'] = $request->input('lost_time_mss','');


        $values['riddor'] = $request->input('riddor', '');
        $values['user_id'] = Auth::user()->id;

        //If origin type is accident
        if(isset($values['origin_type_id']) && $values['origin_type_id'] > 0){
            $origin_type = OriginType::find($values['origin_type_id']);
            if($origin_type && $origin_type->origin_type == 'Accident' && $values['origin'] == "Work") {
                $fields = $values;
                $fields['accident_date'] = $values['ohc_appointment'];
                $fields['reported_date'] = $values['ohc_appointment'];
                $fields['logged_date'] = $values['ohc_appointment'];
                //check exist accident already
                $accidentYear = date('Y', strtotime($values['ohc_appointment']));
                $accident = Accident::where('member_id', $values['member_id'])->whereYear('accident_date', $accidentYear)->get();
                if(empty($accident))
                    Accident::create( $fields );
            }
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
        //get member ids with search
        if($search != null && $search != "") {
            $member_ids = Member::where('member_no', $search)->orWhere('surname', 'like', '%'.$search.'%')->orWhere('name', 'like', '%'.$search.'%')->pluck('id')->toArray();
            return $this->getResourceModel()::where('is_deleted', 0)->when(! empty($search), function ($query) use ($search, $member_ids) {
                $query->where(function ($query) use ($search, $member_ids) {
                    $query->where('logged_date', 'like', "%$search%")
                        ->orWhere('concern_date', 'like', "%$search%")
                        ->orWhere('symptoms', 'like', "%$search%")
                        ->orWhereIn('member_id', $member_ids);
                });
            })->orderBy('updated_at', 'desc')->paginate($perPage);
        } else {
            return $this->getResourceModel()::where('is_deleted', 0)->when(! empty($search), function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('logged_date', 'like', "%$search%")
                        ->orWhere('concern_date', 'like', "%$search%")
                        ->orWhere('symptoms', 'like', "%$search%");
                });
            })->orderBy('updated_at', 'desc')->paginate($perPage);
        }
    }

    public function getList(Request $request)
    {
        if(\request()->ajax()){
            $hs = HealthConcern::with('member')->with('body_part')->where('health_concerns.is_deleted', 0);
            return DataTables::eloquent($hs)
                ->editColumn('ohc_appointment', function($hs) {
                    if($hs->ohc_appointment != null && $hs->ohc_appointment != "" && $hs->ohc_appointment != "0000-00-00")
                        return date('d/m/Y', strtotime($hs->ohc_appointment));
                })
                ->editColumn('discharge_date', function($hs) {
                    if($hs->discharge_date != null && $hs->discharge_date != "" && $hs->discharge_date != "0000-00-00")
                        return date('d/m/Y', strtotime($hs->discharge_date));
                })
                ->editColumn('updated_at', function($hs) {
                    if($hs->updated_at != null && $hs->updated_at != "" && $hs->updated_at != "0000-00-00")
                        return date('d/m/Y H:i', strtotime($hs->updated_at));
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

    public function exceptions()
    {
        $data = array();
        $data['title'] = "Exceptions";
        $data['sub_title'] = "";

        //Get List
        $data['exceptions'] = $this->getExceptions();
        return view('exceptions.index', $data);
    }

    public function getExceptions()
    {
        $exceptions = array();
        $currentYear = date('Y');
        $hs = HealthConcern::where('is_deleted', 0)
            ->where(function($query){
                $query->whereNull('body_part_id');
                $query->orWhereNull('origin');
                $query->orWhereNull('origin_type_id');
                $query->orWhereNull('symptoms');
                $query->orWhereNull('group_code_id');
                $query->orWhereNull('current_level');
                $query->orWhereNull('ohc_appointment');
            })
            ->where(function($query){
                $currentYear = date('Y');
                $query->whereYear('ohc_appointment', $currentYear);
                $query->orWhereNull('ohc_appointment');
            })
            ->where(function($query){
                $currentYear = date('Y');
                $query->whereYear('concern_date', $currentYear);
                $query->orWhereNull('concern_date');
            })
            ->with('member')
            ->with('group_code')
            ->get();

        foreach ($hs as $record){
            $missing_data = '';

            if($record->body_part_id == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Body Part";
                else
                    $missing_data .= "Body Part";
            }

            if($record->symptoms == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Symptoms";
                else
                    $missing_data .= "Symptoms";
            }

            if($record->origin == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Origin";
                else
                    $missing_data .= "Origin";
            }

            if($record->origin_type_id == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Origin Type";
                else
                    $missing_data .= "Origin Type";
            }

            if(empty($record->group_code_id)) {
                $group = GroupCode::where('group_code', $record->member->group_code)->first();
                if(empty($group)) {
                    $group = new GroupCode();
                    $group->group_code = $record->member->group_code;
                    $group->save();
                    $record->group_code_id = $group->id;
                } else
                    $record->group_code_id = $group->id;
                $record->save();
            }

            if($record->current_level == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Current Level";
                else
                    $missing_data .= "Current Level";
            }

            if($record->ohc_appointment == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Ohc Date";
                else
                    $missing_data .= "Ohc Date";
            }

            if($record->group_code_id != null && $record->group_code)
                $group_code =  $record->group_code->group_code;
            else
                $group_code =  '';

            array_push($exceptions, array(
                'id' => $record->id,
                'episode_reference' => $record->episode_reference,
                'member_no' => $record->member->member_no,
                'name' => $record->member->name,
                'member_surname' => $record->member->surname,
                'group_code' => $group_code,
                'ohc_appointment' => $record->ohc_appointment,
                'missing_data' => $missing_data,
                'hs_accident' => 'Health Concerns'
            ));
        }

        $accidents = Accident::where('is_deleted', 0)
            ->where(function($query){
                $query->whereNull('reported_date');
                $query->orWhereNull('logged_date');
                $query->orWhereNull('member_statement');
                $query->orWhereNull('injury_type_id');
                $query->orWhereNull('body_part_id');
                $query->orWhereNull('ohc_comment');
                $query->orWhereNull('outcome_id');
                $query->orWhereNull('gir_definition_id');
                $query->orWhereNull('wi_required');
                $query->orWhereNull('group_code_id');
                $query->orWhereNull('stop_6');
                $query->orWhereNull('riddor');
                $query->orWhereNull('escalation');
                $query->orWhereNull('accident_date');
            })
            ->where(function($query){
                $currentYear = date('Y');
                $query->whereYear('accident_date', $currentYear);
                $query->orWhereNull('accident_date');
            })
            ->where(function($query){
                $currentYear = date('Y');
                $query->whereYear('logged_date', $currentYear);
                $query->orWhereNull('logged_date');
            })
            ->with('member')
            ->get();

        foreach ($accidents as $record){
            $missing_data = '';
            if($record->reported_date == null)
                $missing_data .= "Reported Date";

            if($record->logged_date == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Logged Date";
                else
                    $missing_data .= "Logged Date";
            }

            if($record->member_statement == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Member Statement";
                else
                    $missing_data .= "Member Statement";
            }

            if($record->injury_type_id == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Injury Type";
                else
                    $missing_data .= "Injury Type";
            }

            if($record->body_part_id == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Body Part";
                else
                    $missing_data .= "Body Part";
            }

            if($record->ohc_comment == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Ohc Comment";
                else
                    $missing_data .= "Ohc Comment";
            }

            if($record->outcome_id == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Outcome";
                else
                    $missing_data .= "Outcome";
            }

            if($record->wi_required == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Wi Required";
                else
                    $missing_data .= "Wi Required";
            }

            if($record->gir_definition_id == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Gir Definition";
                else
                    $missing_data .= "Gir Definition";
            }

            if($record->group_code_id == null) {
                $group = GroupCode::where('group_code', $record->member->group_code)->first();
                if(empty($group)) {
                    $group = new GroupCode();
                    $group->group_code = $record->member->group_code;
                    $group->save();
                    $record->group_code_id = $group->id;
                } else
                    $record->group_code_id = $group->id;
                $record->save();
            }

            if($record->stop_6 == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Stop-6";
                else
                    $missing_data .= "Stop-6";
            }

            if($record->riddor == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Riddor";
                else
                    $missing_data .= "Riddor";
            }

            if($record->escalation == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Escalation";
                else
                    $missing_data .= "Escalation";
            }

            if($record->accident_date == null) {
                if(!empty($missing_data))
                    $missing_data .= ", Accident Date";
                else
                    $missing_data .= "Accident Date";
            }

            if($record->group_code_id != null && $record->group_code)
                $group_code =  $record->group_code->group_code;
            else
                $group_code =  '';

            array_push($exceptions, array(
                'id' => $record->id,
                'episode_reference' => '',
                'member_no' => $record->member->member_no,
                'name' => $record->member->name,
                'member_surname' => $record->member->surname,
                'group_code' => $group_code,
                'ohc_appointment' => $record->logged_date,
                'missing_data' => $missing_data,
                'hs_accident' => 'Accidents'
            ));
        }

        return $exceptions;
    }

    public function exceptionExport(Request $request)
    {
        $exception_export_type = $request->get('exception_export_type');
        if($exception_export_type == "excel") {
            //return Excel::download(new ExceptionExport, "exception_list.xlsx");
            $report_data = array();
            $export_sheets = ['Health Concerns', 'Accidents'];
            $start_date = date('Y-m-d');
            $end_date = date('Y-m-d');
            return Excel::download(new MulitpleSheetExport($report_data, $export_sheets, $start_date, $end_date), "exception_list.xlsx");
        } else {
            //Send Email
            $data['exceptions'] = $this->getExceptions();
            Mail::send('exceptions.list', $data, function($message) {
                $message->to('benson@live.co.uk', 'Benson Robert')->subject('Exception List');
                $message->from('zenthinspired@outlook.com','Zenth Inspired');
            });
            return redirect('exceptions');
        }
    }
}
