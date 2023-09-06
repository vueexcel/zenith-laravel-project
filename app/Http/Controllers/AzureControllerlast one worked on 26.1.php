<?php

namespace App\Http\Controllers;

use App\Models\Accident;
use App\Models\HealthConcern;
use App\Models\BodyPart;
use App\Models\OriginType;
use App\Models\GroupCode;
use App\Models\Member;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AzureController extends Controller
{
    public function index()
    {
        $files = Storage::files("azure");
        foreach ($files as $each_file) {
            $contents = Storage::get($each_file);
            $contents = trim($contents, "b");
            $contents = trim($contents, "'");
            $contents = str_replace("\'", "'", $contents);
            $contents = json_decode($contents, true);
            // try {
                foreach ($contents as $content) {
                    // if (isset($content['Origin'])) {
                    //     $parts = preg_split("/(?=[A-Z])/", $content['Origin']);
                    //     $content['Origin'] = trim(implode(" ", $parts));
                    // }
                    
                    if (($content['CaseLegacyId'] && HealthConcern::where('is_deleted', 0)->where('episode_reference', $content['CaseLegacyId'])->count()) || ($content['CaseReference'] && HealthConcern::where('is_deleted', 0)->where('episode_reference', strval($content['CaseReference']))->count())) {
                        
                        if ($content['CaseLegacyId'])
                            $health_concern = HealthConcern::where('is_deleted', 0)->where('episode_reference', $content['CaseLegacyId'])->first();
                        if (empty($health_concern) || !$content['CaseLegacyId']) {
                            $content['Episode_Reference'] = $content['CaseReference'];
                            $health_concern = HealthConcern::where('is_deleted', 0)->where('episode_reference', strval($content['CaseReference']))->first();
                        } else {
                            $content['Episode_Reference'] = $content['CaseLegacyId'];
                        }

                        if ($health_concern) {
                            isset($content['EmployeeUniqueId']) && $health_concern->member_id = $this->findMemberIdWithUniqueId($content['EmployeeUniqueId']);

                            isset($content['OnsetDate']) && $content['OnsetDate'] != 'Invalid date' && $health_concern->logged_date = $content['OnsetDate'];
                            isset($content['OnsetDate']) && $content['OnsetDate'] != 'Invalid date' && $health_concern->concern_date = $content['OnsetDate'];
                            isset($content['DateIssueFirstRaised']) && $content['DateIssueFirstRaised'] != 'Invalid date' && $health_concern->level1_raised_date = $content['DateIssueFirstRaised'];
                            isset($content['ChronicRecurrentProblem']) && $health_concern->repeat = $content['ChronicRecurrentProblem'] ? "Yes" : "No";
                            isset($content['Symptoms']) && $health_concern->symptoms = implode(" / ", $content['Symptoms']);
                            if (!empty($content['SubCategory'])) {
                                $body_part = BodyPart::where('body_part', $content['SubCategory'])->first();
                                if ($body_part)
                                    $health_concern->body_part_id = $body_part->id;
                                else {
                                    $body_part = new BodyPart;
                                    $body_part->body_part = $content['SubCategory'];
                                    $body_part->save();
                                    $health_concern->body_part_id = $body_part->id;
                                }
                            }
                            else if (isset($content['MedicalClassification'])) {
                                $body_part = BodyPart::where('body_part', $content['MedicalClassification'])->first();
                                if ($body_part)
                                    $health_concern->body_part_id = $body_part->id;
                                else {
                                    $body_part = new BodyPart;
                                    $body_part->body_part = $content['MedicalClassification'];
                                    $body_part->save();
                                    $health_concern->body_part_id = $body_part->id;
                                }
                            }
                            isset($content['Origin']) && $health_concern->origin = trim(str_replace("Concern", "", $content['Origin']));

                            if(!empty($content['OriginType'])) {
                                $origin_type = OriginType::where('origin_type', $content['OriginType'])->first();
                                if($origin_type){
                                    $health_concern->origin_type_id = $origin_type->id;
        
                                    //===If origin type ==  "Accident" and origin = "Work", Create accident===
                                    if($content['OriginType'] == "Accident" && ($health_concern->origin == 'Work' || $health_concern->origin == 'Work Aggravated')) {
                                        if ($health_concern->episode_reference && Accident::where('episode_reference', strval($health_concern->episode_reference))->count()== 0 || !$health_concern->episode_reference) {
                                            $accident = new Accident();
                                            $accident->timestamps = true;
                                            $accident_new = true;
            
                                            $accident->member_id = isset($health_concern->member_id) ? $health_concern->member_id: null;
                                            $accident->logged_date = isset($health_concern->ohc_appointment) ? $health_concern->ohc_appointment: null;
                                            $accident->episode_reference = strval($health_concern->episode_reference);
                                            //Body Part
                                            $accident->body_part_id = isset($health_concern->body_part_id) ? $health_concern->body_part_id: null;
            
                                            if ($accident->member_id) {
                                                $member = Member::find($accident->member_id);
                                                $group = GroupCode::where('group_code', $member->group_code)->first();
                                                $accident->group_code_id = $group->id;
                                            }
                                            
                                            if($health_concern->concern_date) {
                                                $accident->accident_date = $health_concern->concern_date;
                                                $accident->monthly_stats = date('n', strtotime($health_concern->concern_date));
                                            }
            
                                            isset($health_concern->concern_date) && $accident->reported_date = $health_concern->concern_date;
                                                
            
                                            if(empty($accident->causation_factor_id))
                                                $accident->causation_factor_id = 19;
            
                                            if(!empty($content['OhcAdviceReport']))
                                                $accident->ohc_comment = $content['OhcAdviceReport'];
            
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
                                    }
                                }
                            }
                            
                            isset($content['OhcAdviceReport']) && $health_concern->initial_advice = $content['OhcAdviceReport'];
                            if (isset($content['OrgLevelTwo'])) {
                                $group_code = GroupCode::where('group_code', $content['OrgLevelTwo'])->first();
                                if ($group_code)
                                    $health_concern->group_code_id = $group_code->id;
                            } else {
                                $member = Member::find($health_concern->member_id);
                                if ($member) {
                                    $group_code_value = $member->group_code;
                                    $group_code = GroupCode::where('group_code', $group_code_value)->first();
                                    if ($group_code)
                                        $health_concern->group_code_id = $group_code->id;
                                }
                            }
                            
                            
                            isset($content['NumberOfWeeksToBeInPlace']) && $health_concern->ramp_up = $content['NumberOfWeeksToBeInPlace'] ? $content['NumberOfWeeksToBeInPlace'] . ($content['NumberOfWeeksToBeInPlace'] == 1 ? " Week" : " Weeks") : null;
                            if (array_key_exists('NumberOfWeeksToBeInPlace', $content) && is_null($content['NumberOfWeeksToBeInPlace']))
                                $health_concern->ramp_up = null;
                            isset($content['Level']) && $health_concern->current_level = $this->changeLevelStr($content['Level']);
                            isset($content['Level']) && $health_concern->outcome = $this->changeLevelStr($content['Level']);
                            $health_concern->is_deleted = 0;

                            for ($i = 1; $i < 9; $i++) {
                                if (!$health_concern->{"next_steps_{$i}"} && !$health_concern->{"next_steps_{$i}_date"}) {
									if ($content['CaseReference'] == '1254421' || $content['CaseReference'] == 1254421) {
										dd($content, $health_concern);
									}
					isset($content['CurrentStatus'])&& $this->changeCurrentStatus($content['CurrentStatus']) && isset($content['AppointmentDateTime']) && $health_concern->{"next_steps_{$i}"} = $this->changeCurrentStatus($content['CurrentStatus']);
                                    isset($content['CurrentStatus']) && $this->changeCurrentStatus($content['CurrentStatus']) && isset($content['AppointmentDateTime']) && $health_concern->{"next_steps_{$i}_date"} = substr($content['AppointmentDateTime'],0,10);
                                    $health_concern = $this->regulate_steps($health_concern, $i);
                                    break;
                                }
                                if (isset($content['CurrentStatus']) && $this->changeCurrentStatus($content['CurrentStatus']) == $health_concern->{"next_steps_{$i}"}) {
                                    break;
                                }
                            }

                            $health_concern->save();
                        }
                    } else {
                        $health_concern = new HealthConcern;
                        $health_concern->episode_reference = $content['CaseReference'];
                        isset($content['OnsetDate']) && $content['OnsetDate'] != 'Invalid date' && $health_concern->logged_date = $content['OnsetDate'];
                        isset($content['EmployeeUniqueId']) && $health_concern->member_id = $this->findMemberIdWithUniqueId($content['EmployeeUniqueId']);
                        isset($content['OnsetDate']) && $content['OnsetDate'] != 'Invalid date' && $health_concern->concern_date = $content['OnsetDate'];
                        isset($content['DateIssueFirstRaised']) && $content['DateIssueFirstRaised'] != 'Invalid date' && $health_concern->level1_raised_date = $content['DateIssueFirstRaised'];
                        isset($content['ChronicRecurrentProblem']) && $health_concern->repeat = $content['ChronicRecurrentProblem'] ? "Yes" : "No";
                        isset($content['Symptoms']) && $health_concern->symptoms = implode(" / ", $content['Symptoms']);
                        if (!empty($content['SubCategory'])) {
                            $body_part = BodyPart::where('body_part', $content['SubCategory'])->first();
                            if ($body_part)
                                $health_concern->body_part_id = $body_part->id;
                            else {
                                $body_part = new BodyPart;
                                $body_part->body_part = $content['SubCategory'];
                                $body_part->save();
                                $health_concern->body_part_id = $body_part->id;
                            }
                        }
                        else if (isset($content['MedicalClassification'])) {
                            $body_part = BodyPart::where('body_part', $content['MedicalClassification'])->first();
                            if ($body_part)
                                $health_concern->body_part_id = $body_part->id;
                            else {
                                $body_part = new BodyPart;
                                $body_part->body_part = $content['MedicalClassification'];
                                $body_part->save();
                                $health_concern->body_part_id = $body_part->id;
                            }
                        }
                        isset($content['Origin']) && $health_concern->origin = trim(str_replace("Concern", "", $content['Origin']));
                        isset($content['AppointmentDateTime']) && $health_concern->ohc_appointment = substr($content['AppointmentDateTime'], 0, 10);
                        isset($content['OhcAdviceReport']) && $health_concern->initial_advice = $content['OhcAdviceReport'];
                        if (isset($content['OrgLevelTwo'])) {
                            $group_code = GroupCode::where('group_code', $content['OrgLevelTwo'])->first();
                            if ($group_code)
                                $health_concern->group_code_id = $group_code->id;
                        } else {
                            $member = Member::find($health_concern->member_id);
                            if ($member) {
                                $group_code_value = $member->group_code;
                                $group_code = GroupCode::where('group_code', $group_code_value)->first();
                                if ($group_code)
                                    $health_concern->group_code_id = $group_code->id;
                            }
                        }
                        isset($content['CurrentStatus']) && $health_concern->next_steps_1 = $this->changeCurrentStatus($content['CurrentStatus']);
                        isset($content['NumberOfWeeksToBeInPlace']) && $health_concern->ramp_up = $content['NumberOfWeeksToBeInPlace'] ? $content['NumberOfWeeksToBeInPlace'] . ($content['NumberOfWeeksToBeInPlace'] == 1 ? " Week" : " Weeks") : null;
                        if (array_key_exists('NumberOfWeeksToBeInPlace', $content) && is_null($content['NumberOfWeeksToBeInPlace']))
                            $health_concern->ramp_up = null;
                        isset($content['Level']) && $health_concern->current_level = $this->changeLevelStr($content['Level']);
                        isset($content['Level']) && $health_concern->outcome = $this->changeLevelStr($content['Level']);
                        isset($content['AppointmentDateTime']) && $health_concern->next_steps_1_date = substr($content['AppointmentDateTime'],0,10);
                        if(!empty($content['OriginType'])) {
                            $origin_type = OriginType::where('origin_type', $content['OriginType'])->first();
                            if($origin_type){
                                $health_concern->origin_type_id = $origin_type->id;
    
                                //===If origin type ==  "Accident" and origin = "Work", Create accident===
                                if($content['OriginType'] == "Accident" && ($health_concern->origin == 'Work' || $health_concern->origin == 'Work Aggravated')) {
                                    $accident = Accident::where('episode_reference', strval($health_concern->episode_reference))->count();
                                    if ( ! $accident) {
                                        $accident = new Accident();
                                        $accident->timestamps = true;
                                        $accident_new = true;
                                        $accident->episode_reference = strval($health_concern->episode_reference);
                                        $accident->member_id = isset($health_concern->member_id) ? $health_concern->member_id: null;
                                        $accident->logged_date = isset($health_concern->ohc_appointment) ? $health_concern->ohc_appointment : null;
        
                                        //Body Part
                                        $accident->body_part_id = isset($health_concern->body_part_id) ? $health_concern->body_part_id: null;
        
                                        if ($accident->member_id) {
                                            $member = Member::find($accident->member_id);
                                            $group = GroupCode::where('group_code', $member->group_code)->first();
                                            $accident->group_code_id = $group->id;
                                        }
                                        
                                        if($health_concern->concern_date) {
                                            $accident->accident_date = $health_concern->concern_date;
                                            $accident->monthly_stats = date('n', strtotime($health_concern->concern_date));
                                        }
        
                                        isset($health_concern->concern_date) && $accident->reported_date = $health_concern->concern_date;
                                            
        
                                        if(empty($accident->causation_factor_id))
                                            $accident->causation_factor_id = 19;
        
                                        if(!empty($content['OhcAdviceReport']))
                                            $accident->ohc_comment = $content['OhcAdviceReport'];
        
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
                                }
                            }
                        }
                        if (isset($content['OrgLevelTwo'])) {
                                $group_code = GroupCode::where('group_code', $content['OrgLevelTwo'])->first();
                                if ($group_code)
                                    $health_concern->group_code_id = $group_code->id;
                            } else {
                                $member = Member::find($health_concern->member_id);
                                if ($member) {
                                    $group_code_value = $member->group_code;
                                    $group_code = GroupCode::where('group_code', $group_code_value)->first();
                                    if ($group_code)
                                        $health_concern->group_code_id = $group_code->id;
                                }
                            }
                        $health_concern->save();
                    }
                }
            // } catch (\Exception $e) {
            //     dd($e->getMessage());
            // }
        }
        dd("success");
    }

    public function findMemberIdWithUniqueId($str) {
        $member = Member::where('member_no', $str)->value("id");
        if (!$member)
            $member = Member::where('member_no', "0".$str)->value("id");
        return $member;
    }
    public function changeLevelStr($str) {
        $ret = "";
        switch(strtolower($str)) {
            case "level1":
                $ret = "level 1";
                break;
            case "level2":
                $ret = "level 2";
                break;
            case "level3":
                $ret = "level 3";
                break;
            case "level4notplaced":
                $ret = "level 4 not placed";
                break;
            case "level1discharged";
                $ret = "level 1 - discharged";
                break;
            case "level2discharged";
                $ret = "level 2 - discharged";
                break;
            case "level3discharged";
                $ret = "level 3 - discharged";
                break;
            case "level4(redflex)discharged":
                $ret = "level 4 (red flex) discharged";
                break;
            case "level4(redflex)";
                $ret = "level 4 (red flex)";
                break;
            case "level4placed";
                $ret = "level 4 placed";
                break;
        }
        return $ret;
    }

    public function changeCurrentStatus($str) {
        $ret = "";
        switch(strtolower($str)) {
            case "worknormally": // Work Normally
                $ret = 1;
                break;
            case "workingnormallyppoandspo": // Work Normally
                $ret = 1;
                break;
            case "restricted": // Restricted
                $ret = 3;
                break;
            case "absent": // Absent
                $ret = 4;
                break;
            case "modifiedworkingnormallyppoorspo"; // Modified Work - WN
                $ret = 5;
                break;
            case "rampup"; // Ramp Up
                $ret = 7;
                break;
            case "null": // NULL
                $ret = 8;
                break;
            default:
                $ret = null;
                break;
        }
        return $ret;
    }

    public function regulate_steps($hs, $step) {
        if ($step != -1)
            for ($i = 0; $i< $step-1; $i++)
                for ($j = $i+1; $j < $step; $j++) {
                    if ($hs->{"next_steps_{$i}_date"} > $hs->{"next_steps_{$j}_date"}) {
                        $temp = $hs->{"next_steps_{$i}"};
                        $temp_date = $hs->{"next_steps_{$i}_date"};
                        $hs->{"next_steps_{$i}_date"} = $hs->{"next_steps_{$j}_date"};
                        $hs->{"next_steps_{$i}"} = $hs->{"next_steps_{$j}"};
                        $hs->{"next_steps_{$j}_date"} = $temp_date;
                        $hs->{"next_steps_{$j}"} = $temp;
                    }
                }
        return $hs;
    }
}
