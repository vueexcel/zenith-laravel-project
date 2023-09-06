<?php

namespace App\Jobs;

use App\Models\Accident;
use App\Models\BodyPart;
use App\Models\Exception;
use App\Models\GroupCode;
use App\Models\HealthConcern;
use App\Models\ImportXML;
use App\Models\InjuryType;
use App\Models\Member;
use App\Models\NextStep;
use App\Models\OriginType;
use App\Models\Outcome;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Storage;
use Orchestra\Parser\Xml\Facade as XMLParser;
use \Illuminate\Support\Facades\File as File;

class ImportXMLofHC implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle()
    {
        //
        $setting = ImportXML::find(1);
        $import_url = $setting->import_url;
        $content = File::get(storage_path($import_url));

        $content = str_replace("._x0020", "", $content);
        $content = str_replace("_x0020", "", $content);
        $content = str_replace("_x0031_-9_", "", $content);
        $content = str_replace("_x0031_-12_", "", $content);
        $content = str_replace("_x0031_-15_", "", $content);
        $content = str_replace("_x0032_-1_", "", $content);
        $content = str_replace("_x0032_-2_", "", $content);
        $content = str_replace("_x0031_-2_", "", $content);
        $content = str_replace("_x0031_-13_", "", $content);

        $content = str_replace("_x0031_-14_", "", $content);
        $content = str_replace("_x0031_-18_", "", $content);
        $content = str_replace("_x0031_-19_", "", $content);
        $content = str_replace("_x0031_-16_", "", $content);

        Storage::put($import_url, $content);
        $xml = XMLParser::load(storage_path('app/'.$import_url));

        $data = $xml->parse([
            'hcs' => ['uses' => 'AdvancedSearchResults[Episode_Reference,Member,Group_Code,Date_First_Noted_by_Member,Repeat,Level_1_date,Symptoms,Body_Part,Origin,Origin_Type,OHC_Appointment_Date,Current_advice,Current_Status,Number_of_Weeks_Restriction_x002F_Modification_x002F_Ramp_Up_to_be_in_place,Current_Level,Estimated_RTW_Date,Accident_Date,Accident_Outcome,Type_of_Injury,Member_Statement]']
        ]);

        $records = $data['hcs'];
        $currentYear = date('Y');
        if(count($records) > 0) {
            foreach ($records as $record) {
                $member_no = $record['Member'];
                if(strlen($member_no) == 4)
                    $member_no = "0".$member_no;
                if(strlen($member_no) == 3)
                    $member_no = "00".$member_no;
                if(strlen($member_no) == 2)
                    $member_no = "000".$member_no;
                if(strlen($member_no) == 1)
                    $member_no = "0000".$member_no;

                $member = Member::where('member_no', $member_no)->first();

                if($member && !empty($record['Episode_Reference'])) {
                    $hc = HealthConcern::where('episode_reference', $record['Episode_Reference'])->where('is_deleted', 0)->first();
                    if(empty($hc))
                        $hc = HealthConcern::where('member_id',$member->id)->whereNull('episode_reference')->whereYear('ohc_appointment', $currentYear)->where('is_deleted', 0)->first();

                    if(empty($hc)) {
                        $hc = new HealthConcern();
                        $hc->timestamps = true;
                        $new_record = true;
                        //Default mss causation is "TO BE Confirmed"
                        $hc->mss_causation_id = 17;
                    } else {
                        $hc->timestamps = false;
                        $new_record = false;
                    }

                    //Episode Reference
                    $hc->episode_reference = $record['Episode_Reference'];

                    //OHC Date
                    if(!empty($record['OHC_Appointment_Date'])) {
                        $ohc_date = explode("/", substr($record['OHC_Appointment_Date'],4));
                        $ohc_appointment = $ohc_date[2]."-".$ohc_date[1]."-".$ohc_date[0];
                    } else {
                        $ohc_appointment = null;
                    }

                    if(!empty($ohc_appointment) && empty($hc->ohc_appointment)) {
                        $hc->ohc_appointment = $ohc_appointment;
                    }

                    if(empty($hc->next_steps_1_date) && !empty($ohc_appointment))
                        $hc->next_steps_1_date = $ohc_appointment;

                    //Member
                    $hc->member_id = $member->id;

                    //Group code
                    if(!empty($record['Group_Code'])) {
                        $group = GroupCode::where('group_code', $record['Group_Code'])->first();
                        if(empty($group)) {
                            $group = new GroupCode();
                            $group->group_code = $record['Group_Code'];
                            $group->save();
                        }
                        if(empty($hc->group_code_id))
                            $hc->group_code_id = $group->id;
                    } else {
                        $group = GroupCode::where('group_code', $member->group_code)->first();
                        if(empty($group)) {
                            $group = new GroupCode();
                            $group->group_code = $member->group_code;
                            $group->save();
                        }
                        if(empty($hc->group_code_id))
                            $hc->group_code_id = $group->id;
                    }

                    //Date 1st Noted by Member
                    if(!empty($record['Date_First_Noted_by_Member'])) {
                        $concern_date = explode("/", substr($record['Date_First_Noted_by_Member'],4));
                        if(!empty($concern_date))
                            $hc->concern_date = $concern_date[2]."-".$concern_date[1]."-".$concern_date[0];
                    }

                    //Repeat
                    if(!empty($record['Repeat']))
                        $hc->repeat = $record['Repeat'];

                    //Symptoms
                    if(!empty($record['Symptoms']))
                        $hc->symptoms = $record['Symptoms'];

                    //Body_Part
                    if(!empty($record['Body_Part'])) {
                        $body_part = BodyPart::where('body_part', $record['Body_Part'])->first();

                        if(empty($body_part)) {
                            $body_part = new BodyPart();
                            $body_part->body_part = $record['Body_Part'];
                            $body_part->save();
                        }

                        if($hc->body_part_id != $body_part->id && $new_record === false) {
                            $this->saveChangedDataException($ohc_appointment, 'Body Part', $hc);
                        }

                        $hc->body_part_id = $body_part->id;
                    }

                    //Origin
                    if(!empty($record['Origin'])) {
                        $record['Origin'] = str_replace(" Concern", "", $record['Origin']);

                        if($hc->origin != $record['Origin'] && $new_record === false) {
                            $this->saveChangedDataException($ohc_appointment, 'Origin', $hc);
                        }

                        $hc->origin = $record['Origin'];
                    }

                    //Origin Type
                    if(!empty($record['Origin_Type'])) {
                        $origin_type = OriginType::where('origin_type', $record['Origin_Type'])->first();
                        if($origin_type){

                            if($hc->origin_type_id != $origin_type->id && $new_record === false) {
                                $this->saveChangedDataException($ohc_appointment, 'Origin Type', $hc);
                            }

                            $hc->origin_type_id = $origin_type->id;

                            //===If origin type ==  "Accident" and origin = "Work", Create accident===
                            if($record['Origin_Type'] == "Accident" && $record['Origin'] == 'Work') {
                                /*if(!empty($ohc_appointment)) {
                                    $accident = Accident::where('member_id', $member->id)
                                        ->where(function($query) use ($ohc_appointment) {
                                            $currentYear = date('Y', strtotime($ohc_appointment));
                                            $query->whereYear('logged_date', $currentYear);
                                            $query->orWhereYear('accident_date', $currentYear);
                                            $query->orWhereNull('logged_date');
                                        })->first();
                                } else {
                                    $accident = Accident::where('member_id', $member->id)->orderBy('logged_date', 'DESC')->first();
                                }*/
                                $accident = Accident::where('episode_reference', $record['Episode_Reference'])->first();

                                if($accident == null) {
                                    $accident = new Accident();
                                    $accident->timestamps = true;
                                    $accident_new = true;
                                    $accident->episode_reference = $record['Episode_Reference'];
                                } else {
                                    $accident->timestamps = false;
                                    $accident_new = false;
                                }

                                $accident->member_id = $member->id;
                                $accident->logged_date = $ohc_appointment;

                                //Body Part
                                if(!empty($body_part)) {
                                    if($accident->body_part_id != $body_part->id && $accident_new === false) {
                                        $this->saveChangedDataException($ohc_appointment, 'Body Part', null, $accident);
                                    }
                                    $accident->body_part_id = $body_part->id;
                                }

                                //Group Code
                                if(!empty($group))
                                    if(empty($accident->group_code_id))
                                        $accident->group_code_id = $group->id;
                                else {
                                    $group = GroupCode::where('group_code', $member->group_code)->first();
                                    if(empty($group)) {
                                        $group = new GroupCode();
                                        $group->group_code = $member->group_code;
                                        $group->save();
                                    }
                                    if(empty($accident->group_code_id))
                                        $accident->group_code_id = $group->id;
                                }

                                if(!empty($record['Accident_Date'])) {
                                    $accident_date_array = explode("/", substr($record['Accident_Date'],4));
                                    $accident_date = $accident_date_array[2]."-".$accident_date_array[1]."-".$accident_date_array[0];
                                    $accident->accident_date = $accident_date;
                                    $accident->monthly_stats = date('n', strtotime($accident_date));
                                }

                                if(!empty($record['Accident_Outcome'])) {
                                    $outcome = Outcome::where('outcome', $record['Accident_Outcome'])->first();
                                    if(empty($outcome)) {
                                        $outcome = new Outcome();
                                        $outcome->outcome = $record['Accident_Outcome'];
                                        $outcome->save();
                                    }
                                    $accident->outcome_id = $outcome->id;
                                }

                                if(!empty($record['Type_of_Injury'])) {
                                    $injury = InjuryType::where('injury', $record['Type_of_Injury'])->first();
                                    if(empty($injury)) {
                                        $injury = new InjuryType();
                                        $injury->injury = $record['Type_of_Injury'];
                                        $injury->save();
                                    }
                                    $accident->injury_type_id = $injury->id;
                                }

                                if(!empty($concern_date))
                                    $accident->reported_date = $concern_date[2]."-".$concern_date[1]."-".$concern_date[0];

                                if(empty($accident->causation_factor_id))
                                    $accident->causation_factor_id = 19;

                                if(!empty($record['Current_advice']))
                                    $accident->ohc_comment = $record['Current_advice'];

                                if(!empty($record['Member_Statement']))
                                    $accident->member_statement = $record['Member_Statement'];

                                if(empty($accident->stop_6))
                                    $accident->stop_6 = 'no';

                                if(empty($accident->escalation))
                                    $accident->escalation = 'None';

                                if(empty($accident->wi_required))
                                    $accident->wi_required = 'Yes';

                                if(empty($accident->riddor))
                                    $accident->riddor = 'No';

                                if(empty($accident->gir_definition_id))
                                    $accident->gir_definition_id = 3;

                                $accident->save();
                            }
                            //======================================================================//
                        }
                    }

                    if(!empty($record['Current_advice']))
                        $hc->initial_advice = $record['Current_advice'];

                    if(!empty($record['Number_of_Weeks_Restriction_x002F_Modification_x002F_Ramp_Up_to_be_in_place']) && $record['Number_of_Weeks_Restriction_x002F_Modification_x002F_Ramp_Up_to_be_in_place'] != "None") {
                        if($record['Number_of_Weeks_Restriction_x002F_Modification_x002F_Ramp_Up_to_be_in_place'] == 1)
                            $hc->ramp_up = $record['Number_of_Weeks_Restriction_x002F_Modification_x002F_Ramp_Up_to_be_in_place']. ' Week';
                        else
                            $hc->ramp_up = $record['Number_of_Weeks_Restriction_x002F_Modification_x002F_Ramp_Up_to_be_in_place']. ' Weeks';

                        //Calculation Fully fit date(ramp up completion date)
                        if(!empty($ohc_appointment)) {
                            $ramp_up_week = '+'.$record['Number_of_Weeks_Restriction_x002F_Modification_x002F_Ramp_Up_to_be_in_place'].' weeks';
                            $hc->fully_fit = date('Y-m-d', strtotime($ramp_up_week, strtotime($ohc_appointment)));
                        }
                    }

                    if(!empty($record['Current_Status'])) {
                        //Next Step
                        $next_step_name = str_replace(" (PPO or SPO)", "", $record['Current_Status']);
                        $next_step_name = str_replace(" (PPO and SPO)", "", $next_step_name);
                        if($next_step_name == "Modified Working Normally")
                            $next_step_name = "Modified Work - WN";
                        if($next_step_name == "Working Normally")
                            $next_step_name = "Work Normally";

                        $next_step = NextStep::where('next_step', $next_step_name)->first();

                        if(empty($next_step)) {
                            $next_step = new NextStep();
                            $next_step->next_step = $next_step_name;
                            $next_step->save();
                        }

                        /*if($hc->id == 61068) {
                            $abc = 0;
                        }*/
                        $chk = $this->checkExistNextStep($hc, $next_step->id, $ohc_appointment);
                        $hc->next_step_id = $next_step->id;

                        // Ramp up
                        if($hc->next_step_id == 7) {
                            if(!empty($record['Number_of_Weeks_Restriction_x002F_Modification_x002F_Ramp_Up_to_be_in_place']) && $record['Number_of_Weeks_Restriction_x002F_Modification_x002F_Ramp_Up_to_be_in_place'] != "None") {
                                if($record['Number_of_Weeks_Restriction_x002F_Modification_x002F_Ramp_Up_to_be_in_place'] == 1)
                                    $hc->ramp_up = $record['Number_of_Weeks_Restriction_x002F_Modification_x002F_Ramp_Up_to_be_in_place']. ' Week';
                                else
                                    $hc->ramp_up = $record['Number_of_Weeks_Restriction_x002F_Modification_x002F_Ramp_Up_to_be_in_place']. ' Weeks';

                                //Calculation Fully fit date(ramp up completion date)
                                if(!empty($ohc_appointment)) {
                                    $ramp_up_week = '+'.$record['Number_of_Weeks_Restriction_x002F_Modification_x002F_Ramp_Up_to_be_in_place'].' weeks';
                                    $hc->fully_fit = date('Y-m-d', strtotime($ramp_up_week, strtotime($ohc_appointment)));
                                }
                            }
                        } else {
                            $hc->ramp_up = 'None';
                            $hc->fully_fit = null;
                        }

                        if($chk == true) {
                            if(empty($hc->next_steps_1)){
                                $hc->next_steps_1 = $next_step->id;
                                if(!empty($ohc_appointment)) {
                                    //$hc->discharge_date = $ohc_appointment;
                                    if(empty($hc->next_steps_1_date) && !empty($ohc_appointment))
                                        $hc->next_steps_1_date = $ohc_appointment;
                                }
                            } else {
                                if(empty($hc->next_steps_2)){
                                    if($hc->next_steps_1 != $next_step->id) {
                                        $hc->next_steps_2 = $next_step->id;
                                        if (!empty($ohc_appointment)) {
                                            //$hc->discharge_date = $ohc_appointment;
                                            $hc->next_steps_2_date = $ohc_appointment;
                                        }
                                    }
                                } else {
                                    if(empty($hc->next_steps_3)){
                                        if($hc->next_steps_2 != $next_step->id) {
                                            $hc->next_steps_3 = $next_step->id;
                                            if (!empty($ohc_appointment)) {
                                                //$hc->discharge_date = $ohc_appointment;
                                                $hc->next_steps_3_date = $ohc_appointment;
                                            }
                                        }
                                    } else {
                                        if(empty($hc->next_steps_4)){
                                            if($hc->next_steps_3 != $next_step->id) {
                                                $hc->next_steps_4 = $next_step->id;
                                                if (!empty($ohc_appointment)) {
                                                    //$hc->discharge_date = $ohc_appointment;
                                                    $hc->next_steps_4_date = $ohc_appointment;
                                                }
                                            }
                                        } else {
                                            if(empty($hc->next_steps_5)){
                                                if($hc->next_steps_4 != $next_step->id) {
                                                    $hc->next_steps_5 = $next_step->id;
                                                    if (!empty($ohc_appointment)) {
                                                        //$hc->discharge_date = $ohc_appointment;
                                                        $hc->next_steps_5_date = $ohc_appointment;
                                                    }
                                                }
                                            } else {
                                                if(empty($hc->next_steps_6)){
                                                    if($hc->next_steps_5 != $next_step->id) {
                                                        $hc->next_steps_6 = $next_step->id;
                                                        if (!empty($ohc_appointment)) {
                                                            //$hc->discharge_date = $ohc_appointment;
                                                            $hc->next_steps_6_date = $ohc_appointment;
                                                        }
                                                    }
                                                } else {
                                                    if(empty($hc->next_steps_7)){
                                                        if($hc->next_steps_6 != $next_step->id) {
                                                            $hc->next_steps_7 = $next_step->id;
                                                            if (!empty($ohc_appointment)) {
                                                                //$hc->discharge_date = $ohc_appointment;
                                                                $hc->next_steps_7_date = $ohc_appointment;
                                                            }
                                                        }
                                                    } else{
                                                        if(empty($hc->next_steps_8)){
                                                            if($hc->next_steps_7 != $next_step->id) {
                                                                $hc->next_steps_8 = $next_step->id;
                                                                if (!empty($ohc_appointment)) {
                                                                    //$hc->discharge_date = $ohc_appointment;
                                                                    $hc->next_steps_8_date = $ohc_appointment;
                                                                }
                                                            }
                                                        } else {
                                                            if(empty($hc->next_steps_9)){
                                                                if($hc->next_steps_8 != $next_step->id) {
                                                                    $hc->next_steps_9 = $next_step->id;
                                                                    if (!empty($ohc_appointment)) {
                                                                        //$hc->discharge_date = $ohc_appointment;
                                                                        $hc->next_steps_9_date = $ohc_appointment;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }

                    if(!empty($record['Current_Level'])) {
                        $hc->current_level = $record['Current_Level'];
                        $hc->outcome = $record['Current_Level'];
                        if(strpos($record['Current_Level'], 'DISCHARGED') !== false) {
                            if (!empty($ohc_appointment)) {
                                $hc->discharge_date = $ohc_appointment;
                            }
                        }
                    }

                    if(!empty($record['Estimated_RTW_Date'])) {
                        $rtw_date = explode("/", substr($record['Estimated_RTW_Date'],4));
                        $hc->rtw_date = $rtw_date[2]."-".$rtw_date[1]."-".$rtw_date[0];
                    }
                    $hc->save();
                }
            }
        }

    }

    public function checkExistNextStep($hc, $next_step_id, $next_step_date)
    {
        $chk = true;
        $last_next_step = $hc->next_steps_1;
        $last_next_step_date = $hc->next_steps_1_date;

        if(!empty($hc->next_steps_2)){
            $last_next_step = $hc->next_steps_2;
            $last_next_step_date = $hc->next_steps_2_date;
        }

        if(!empty($hc->next_steps_3)){
            $last_next_step = $hc->next_steps_3;
            $last_next_step_date = $hc->next_steps_3_date;
        }

        if(!empty($hc->next_steps_4)){
            $last_next_step = $hc->next_steps_4;
            $last_next_step_date = $hc->next_steps_4_date;
        }

        if(!empty($hc->next_steps_5)){
            $last_next_step = $hc->next_steps_5;
            $last_next_step_date = $hc->next_steps_5_date;
        }

        if(!empty($hc->next_steps_6)){
            $last_next_step = $hc->next_steps_6;
            $last_next_step_date = $hc->next_steps_6_date;
        }

        if(!empty($hc->next_steps_7)){
            $last_next_step = $hc->next_steps_7;
            $last_next_step_date = $hc->next_steps_7_date;
        }

        if(!empty($hc->next_steps_8)){
            $last_next_step = $hc->next_steps_8;
            $last_next_step_date = $hc->next_steps_8_date;
        }

        if($last_next_step != null && $last_next_step_date >= $next_step_date)
            $chk = false;

        return $chk;
    }

    public function saveChangedDataException($ohc_data, $changed_data, $hc=null, $accident=null)
    {
        if($hc != null){
            $exception = Exception::where('health_concern_id', $hc->id)->where('ohc_date', $ohc_data)->first();
        } else {
            $exception = Exception::where('accident_id', $accident->id)->where('ohc_date', $ohc_data)->first();
        }

        if(empty($exception)) {
            $exception = new Exception();

            if($hc != null) {
                $exception->member_id = $hc->member_id;
                $exception->health_concern_id = $hc->id;
            } else {
                $exception->member_id = $accident->member_id;
                $exception->accident_id = $accident->id;
            }

            $exception->changed_data = $changed_data;
            $exception->ohc_date = $ohc_data;
            $exception->confirmed = 0;
            $exception->save();
        } else {
            if($exception->confirmed == 0) {
                if (empty($exception->changed_data))
                    $exception->changed_data = $changed_data;
                else {
                    if (strpos($exception->changed_data, $changed_data) === false)
                        $exception->changed_data .= ', '.$changed_data;
                }
                $exception->save();
            }
        }
    }
}
