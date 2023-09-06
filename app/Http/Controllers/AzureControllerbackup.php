<?php

namespace App\Http\Controllers;

use App\Models\HealthConcern;
use App\Models\BodyPart;
use App\Models\OriginType;
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
                    if ($content['CaseLegacyId'] && HealthConcern::where('episode_reference', $content['CaseLegacyId'])->count() || !$content['CaseLegacyId'] && $content['CaseReference'] && HealthConcern::where('episode_reference', strval($content['CaseReference']))->count()) {
                        if ($content['CaseLegacyId'])
                            $health_concern = HealthConcern::where('episode_reference', $content['CaseLegacyId'])->first();
                        else
                             $health_concern = HealthConcern::where('episode_reference', strval($content['CaseReference']))->first();
                        if ($health_concern) {
                            isset($content['EmployeeUniqueId']) && $health_concern->member_id = Member::where('member_no', $content['EmployeeUniqueId'])->value("id");
                            isset($content['OnsetDate']) && $health_concern->logged_date = $content['OnsetDate'];
                            isset($content['DateIssueFirstRaised']) && $health_concern->concern_date = $content['DateIssueFirstRaised'];
                            isset($content['ChronicRecurrentProblem']) && $health_concern->repeat = $content['ChronicRecurrentProblem'] ? "Yes" : "No";
                            isset($content['Symptoms']) && $health_concern->symptoms = implode(" / ", $content['Symptoms']);
                            isset($content['SubCategory']) && $health_concern->body_part_id = BodyPart::where('body_part', $content['SubCategory'])->value('id');
                            isset($content['Origin']) && $health_concern->origin = $content['Origin'] == "Non-WorkConcern" ? "Non-Work" : "Work";
                            isset($content['OriginType']) && $health_concern->origin_type_id = OriginType::where("origin_type", $content['OriginType'])->value("id");
                            isset($content['AppointmentDateTime']) && $health_concern->ohc_appointment = substr($content['AppointmentDateTime'], 0, 10);
                            isset($content['OhcAdviceReport']) && $health_concern->initial_advice = $content['OhcAdviceReport'];
                            $max = 1;
                            for ($i = 1; $i < 9; $i++) {
                                if (!$health_concern->{"Next_steps_{$i}"}) {
                                    $max = $i;
                                    break;
                                }
                            }
                            isset($content['CurrentStatus']) && $health_concern->{"next_steps_{$max}"} = $content['CurrentStatus'] == 'Absent' ? 1 : null;
                            isset($content['NumberOfWeeksToBeInPlace']) && $health_concern->ramp_up = $content['NumberOfWeeksToBeInPlace'] ? $content['NumberOfWeeksToBeInPlace'] . ($content['NumberOfWeeksToBeInPlace'] == 1 ? " Week" : " Weeks") : null;
                            isset($content['Level']) && $health_concern->current_level = $this->changeLevelStr($content['Level']);
                            isset($content['Level']) && $health_concern->outcome = $this->changeLevelStr($content['Level']);
                            isset($content['EstimatedReturnToWorkDate']) && $health_concern->{"next_steps_{$max}_date"} = $content['EstimatedReturnToWorkDate'];
                            $health_concern->is_deleted = 0;
                            $health_concern->save();
                        }
                    } else {
                        $health_concern = new HealthConcern;
                        $health_concern->episode_reference = $content['CaseReference'];
                        isset($content['OnsetDate']) && $health_concern->logged_date = $content['OnsetDate'];
                        isset($content['EmployeeUniqueId']) && $health_concern->member_id = Member::where('member_no', $content['EmployeeUniqueId'])->value("id");
                        isset($content['DateIssueFirstRaised']) && $health_concern->concern_date = $content['DateIssueFirstRaised'];
                        isset($content['ChronicRecurrentProblem']) && $health_concern->repeat = $content['ChronicRecurrentProblem'] ? "Yes" : "No";
                        isset($content['Symptoms']) && $health_concern->symptoms = implode(" / ", $content['Symptoms']);
                        isset($content['SubCategory']) && $health_concern->body_part_id = BodyPart::where('body_part', $content['SubCategory'])->value('id');
                        isset($content['Origin']) && $health_concern->origin = $content['Origin'] == "Non-WorkConcern" ? "Non-Work" : "Work";
                        isset($content['OriginType']) && $health_concern->origin_type_id = OriginType::where("origin_type", $content['OriginType'])->value("id");
                        isset($content['AppointmentDateTime']) && $health_concern->ohc_appointment = substr($content['AppointmentDateTime'], 0, 10);
                        isset($content['OhcAdviceReport']) && $health_concern->initial_advice = $content['OhcAdviceReport'];
                        isset($content['CurrentStatus']) && $health_concern->next_steps_1 = $content['CurrentStatus'] == 'Absent' ? 1 : null;
                        isset($content['NumberOfWeeksToBeInPlace']) && $health_concern->ramp_up = $content['NumberOfWeeksToBeInPlace'] ? $content['NumberOfWeeksToBeInPlace'] . ($content['NumberOfWeeksToBeInPlace'] == 1 ? " Week" : " Weeks") : null;
                        isset($content['Level']) && $health_concern->current_level = $this->changeLevelStr($content['Level']);
                        isset($content['Level']) && $health_concern->outcome = $this->changeLevelStr($content['Level']);
                        isset($content['EstimatedReturnToWorkDate']) && $health_concern->next_steps_1_date = $content['EstimatedReturnToWorkDate'];
                        $health_concern->save();
                    }
                }
            // } catch (\Exception $e) {
            //     // dd($e->getMessage());
            // }
        }
        dd("success");
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
            case "Level1Discharged";
                $ret = "level 1 - discharged";
                break;
            case "Level2Discharged";
                $ret = "level 2 - discharged";
                break;
            case "Level3Discharged";
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
}
