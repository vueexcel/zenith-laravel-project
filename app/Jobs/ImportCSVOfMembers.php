<?php

namespace App\Jobs;

use App\Models\Accident;
use App\Models\GroupCode;
use App\Models\HealthConcern;
use App\Models\ImportCSV;
use App\Models\Member;
use App\Models\Supervisor;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Hash;
use Rap2hpoutre\FastExcel\FastExcel;
use Excel;

class ImportCSVOfMembers implements ShouldQueue
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
        $setting = ImportCSV::find(1);
        $import_url = $setting->import_url;
        $import_url = pathinfo($import_url, PATHINFO_FILENAME) . '.' . strtolower(pathinfo($import_url, PATHINFO_EXTENSION));

        (new FastExcel)->withoutHeaders()->import(storage_path($import_url), function ($line) {
            $manager_occupations = array(
                'DEPUTY MANAGING DIRECTOR',
                'GENERAL MANAGER',
                'MANAGER',
                'MANAGING DIRECTOR',
                'SECTION MANAGER (ENG)',
                'SECTION MANAGER (SGL)',
                'SECTION MANAGER (SPEC)',
                'SECTION MANAGER (STAND IN)',
                'SECTION MANAGER (STAND IN) GL',
                'SECTION MANAGER (STAND IN) SPC',
                'SENIOR MANAGER',
            );

            $member_no = '';
            $surname = '';
            $first_name = '';
            $occupation = '';
            $group_code = '';
            $section = '';
            $department = '';
            $division = '';
            $start_date = '';
            $ni_number = '';
            $supervisor = '';
            $employment_status = '';
            $leaving_date = '';

            foreach ($line as $index => $value) {
                $value = trim($value);
                switch ($index) {
                    case 0: $member_no = $value; break;
                    case 1: $surname = $value; break;
                    case 2: $first_name = $value; break;
                    case 3: $occupation = $value; break;
                    case 4: $group_code = $value; break;
                    case 5: $section = $value; break;
                    case 6: $department = $value; break;
                    case 7: $division = $value; break;
                    case 8: $start_date = $value; break;
                    case 9: $ni_number = $value; break;
                    case 10: $supervisor = $value; break;
                    case 11: $employment_status = $value; break;
                    case 12: $leaving_date = $value; break;
                    default: break;
                }
            }

            if(!empty($member_no)) {
                if(strlen($member_no) == 4)
                    $member_no = "0".$member_no;
                if(strlen($member_no) == 3)
                    $member_no = "00".$member_no;
                if(strlen($member_no) == 2)
                    $member_no = "000".$member_no;
                if(strlen($member_no) == 1)
                    $member_no = "0000".$member_no;
            } else {
                $member_no = null;
            }

            if(!empty($member_no)) {
                //Update Member
                $member = Member::where('member_no', $member_no)->first();
                if($member == null) {
                    $member = new Member();
                    $member->member_no = $member_no;
                }

                $member->surname = $surname;
                $member->name = $first_name;
                $member->occupation = $occupation;

                $group_id = 0;
                $member->group_code = $group_code;
                $group = GroupCode::where('group_code', $member->group_code)->first();
                if($group != null)
                    $group_id = $group->id;

                $member->section = $section;
                $member->department = $department;
                $member->division = $division;

                if (!empty($start_date)) {
                    $member->start_date = $this->date_convert($start_date);
                }

                $member->nid = $ni_number;

                if(!empty($supervisor)) {
                    $member->supervisor = $supervisor;
                    $supervisor = explode(",", $supervisor);
                    //Update Supervisor
                    if(count($supervisor) > 1) {
                        $sp = Supervisor::where('surname', $supervisor[0])->where('name', $supervisor[1])->first();
                        if($sp == null) {
                            $sp = new Supervisor();
                            $sp->surname = $supervisor[0];
                            $sp->name = $supervisor[1];
                            $sp->occupation = $occupation;
                            $sp->group_code_id = $group_id;
                            $sp->save();
                        }
                    } else {
                        $sp = Supervisor::where('surname', $supervisor[0])->first();
                        if($sp == null) {
                            $sp = new Supervisor();
                            $sp->surname = $supervisor[0];
                            $sp->occupation = $occupation;
                            $sp->group_code_id = $group_id;
                            $sp->save();
                        }
                    }
                }

                $member->empl_status = $employment_status;

                if (!empty($leaving_date)) {
                    $member->leaving_date = $this->date_convert($leaving_date);
                }

                $member->save();

                //if($member->empl_status == 'D' || $member->empl_status == 'R' || $member->empl_status == 'T') {
                if(!empty($leaving_date)) {
                    //Update Health Concerns and Accident
                    HealthConcern::where('member_id', $member->id)->update([
                        'current_level' => 'Level 2 Discharged',
                        'outcome' => 'Level 2 Discharged',
                        'discharge_date' => $member->leaving_date
                    ]);

                    /*Accident::where('member_id', $member->id)->update([
                        'current_level' => 'Level 2 Discharged',
                        'outcome' => 'Level 2 Discharged',
                        'discharge_date' => $member->leaving_date
                    ]);*/
                }

                //Import to user table
                $user = User::where('member_no', $member_no)->first();
                if($user == null) {
                    $user = new User();
                    $user->member_no = $member_no;
                    $user->password = Hash::make('12345678');
                    $user->logo_number = 1;
                    $user->is_hr = 0;
                }
                $user->timestamps = false;
                $user->name = $member->name;
                $user->surname = $member->surname;
                $user->email = strtolower(str_replace(" ", "", $member->name)).rand(0, 1000).'@email.com';
                $user->is_deleted = 0;
                //user permission
                if(in_array($member->occupation, $manager_occupations )) {
                    $user->is_admin = 1;
                } else {
                    $user->is_admin = 0;
                }
                $user->save();
            }
        });
    }

    public function date_convert($date_string)
    {
        $date_array = explode('/', $date_string);
        $year = $date_array[2];
        $month = $date_array[1];
        $day = $date_array[0];

        if(strlen($month) < 2)
            $month = '0'.$month;
        if(strlen($day) < 2)
            $day = '0'.$day;
        return $year.'-'.$month.'-'.$day;
    }
}
