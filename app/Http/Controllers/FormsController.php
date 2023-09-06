<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormAccident;
use App\Models\FormMss;
use App\Models\FormNearMiss;
use App\Models\Member;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class FormsController extends Controller
{
    //
    private $member;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->member = Member::where('member_no', Auth::user()->member_no)->first();
            return $next($request);
        });
    }

    public function accident()
    {
        $data['form'] = Form::find(1);
        $data['sections'] = Section::where('form_id', 1)->get();
        $data['progressbar_li_width'] = round(98 / ($data['sections']->count() + 1)) - 0.2 ;
        $data['total_step'] = $data['sections']->count();
        $data['member'] = $this->member;
        $data['page_title'] = 'Accident Form';
        $form_data = new FormAccident();
        $form_data->user_id = Auth::user()->id;
        $form_data->is_completed = 0;
        $form_data->save();
        $data['form_data'] = $form_data;
        return view('forms.index', $data);
    }

    public function mss()
    {
        $data['form'] = Form::find(2);
        $data['sections'] = Section::where('form_id', 2)->get();
        $data['progressbar_li_width'] = round(98 / ($data['sections']->count() + 1)) - 0.2 ;
        $data['total_step'] = $data['sections']->count();
        $data['member'] = $this->member;
        $data['page_title'] = 'MSS Form';
        $form_data = new FormMss();
        $form_data->user_id = Auth::user()->id;
        $form_data->is_completed = 0;
        $form_data->save();
        $data['form_data'] = $form_data;
        return view('forms.index', $data);
    }

    public function near_miss()
    {
        $data['form'] = Form::find(3);
        $data['sections'] = Section::where('form_id', 3)->get();
        $data['progressbar_li_width'] = round(98 / ($data['sections']->count() + 1)) - 0.2 ;
        $data['total_step'] = $data['sections']->count();
        $data['member'] = $this->member;
        $data['page_title'] = 'Near Miss Form';
        $form_data = new FormNearMiss();
        $form_data->user_id = Auth::user()->id;
        $form_data->is_completed = 0;
        $form_data->save();
        $data['form_data'] = $form_data;
        return view('forms.index', $data);
    }

    public function save_field(Request $request)
    {
        $field = $request->get('field');
        $field_type = $request->get('field_type');
        $value = $request->get('value');
        $form_id = $request->get('form_id');
        $form_name = $request->get('form_name');
        if($field_type == 'Date' ) {
            $date = \DateTime::createFromFormat('d/m/Y', $value);
            $value = $date->format('Y-m-d');
        }
        if($form_name == 'Accident') {
            $item = FormAccident::find($form_id);
            $table_name = 'form_accidents';
        } else if($form_name == 'MSS') {
            $item = FormMss::find($form_id);
            $table_name = 'form_mss';
        } else { //Near Miss
            $item = FormNearMiss::find($form_id);
            $table_name = 'form_near_miss';
        }

        //Check exist column
        if (!Schema::hasColumn($table_name, $field)) {
            Schema::table($table_name, function (Blueprint $table) use ($field, $field_type){
                if($field_type == 'Textarea')
                    $table->text($field)->nullable();
                else
                    $table->string($field)->nullable();
            });
        }

        $item->$field = $value;
        $item->save();
        echo 'Success';
    }

    public function complete_form(Request $request)
    {
        $form_id = $request->get('form_id');
        $form_name = $request->get('form_name');
        if($form_name == 'Accident') {
            $item = FormAccident::find($form_id);
        } else if($form_name == 'MSS') {
            $item = FormMss::find($form_id);
        } else { //Near Miss
            $item = FormNearMiss::find($form_id);
        }
        $item->is_completed = 1;
        $item->save();
        echo 'Success';
    }

    public function outstanding()
    {
        $user_id = Auth::user()->id;
        if(Auth::user()->is_admin > 1) {
            $data['outstanding_accident'] = FormAccident::where('is_completed', 0)
                ->get();
            $data['outstanding_mss'] = FormMss::where('is_completed', 0)
                ->get();
            $data['outstanding_near_miss'] = FormNearMiss::where('is_completed', 0)
                ->get();

            $data['completed_accident'] = FormAccident::where('is_completed', 1)
                ->get();
            $data['completed_mss'] = FormMss::where('is_completed', 1)
                ->get();
            $data['completed_near_miss'] = FormNearMiss::where('is_completed', 1)
                ->get();
        } else{
            $data['outstanding_accident'] = FormAccident::where('is_completed', 0)
                ->where('user_id', $user_id)
                ->get();
            $data['outstanding_mss'] = FormMss::where('is_completed', 0)
                ->where('user_id', $user_id)
                ->get();
            $data['outstanding_near_miss'] = FormNearMiss::where('is_completed', 0)
                ->where('user_id', $user_id)
                ->get();

            $data['completed_accident'] = FormAccident::where('is_completed', 1)
                ->where('user_id', $user_id)
                ->get();
            $data['completed_mss'] = FormMss::where('is_completed', 1)
                ->where('user_id', $user_id)
                ->get();
            $data['completed_near_miss'] = FormNearMiss::where('is_completed', 1)
                ->where('user_id', $user_id)
                ->get();
        }
        return view('forms.outstanding', $data);
    }

    public function filter_outstanding(Request $request)
    {
        $user_id = Auth::user()->id;
        if(Auth::user()->is_admin > 1) {
            if(!empty($request->get('year_month'))) {
                $year_month = explode("/", $request->get('year_month'));
                $year = $year_month[1];
                $month = $year_month[0];
                $data['outstanding_accident'] = FormAccident::where('is_completed', 0)
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->get();
                $data['outstanding_mss'] = FormMss::where('is_completed', 0)
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->get();
                $data['outstanding_near_miss'] = FormNearMiss::where('is_completed', 0)
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->get();
                $data['completed_accident'] = FormAccident::where('is_completed', 1)
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->get();
                $data['completed_mss'] = FormMss::where('is_completed', 1)
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->get();
                $data['completed_near_miss'] = FormNearMiss::where('is_completed', 1)
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->get();
            } else {
                $data['outstanding_accident'] = FormAccident::where('is_completed', 0)
                    ->get();
                $data['outstanding_mss'] = FormMss::where('is_completed', 0)
                    ->get();
                $data['outstanding_near_miss'] = FormNearMiss::where('is_completed', 0)
                    ->get();

                $data['completed_accident'] = FormAccident::where('is_completed', 1)
                    ->get();
                $data['completed_mss'] = FormMss::where('is_completed', 1)
                    ->get();
                $data['completed_near_miss'] = FormNearMiss::where('is_completed', 1)
                    ->get();
            }
        } else{
            if(!empty($request->get('year_month'))){
                $year_month = explode("/", $request->get('year_month'));
                $year = $year_month[1];
                $month = $year_month[0];
                $data['outstanding_accident'] = FormAccident::where('is_completed', 0)
                    ->where('user_id', $user_id)
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->get();
                $data['outstanding_mss'] = FormMss::where('is_completed', 0)
                    ->where('user_id', $user_id)
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->get();
                $data['outstanding_near_miss'] = FormNearMiss::where('is_completed', 0)
                    ->where('user_id', $user_id)
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->get();
                $data['completed_accident'] = FormAccident::where('is_completed', 1)
                    ->where('user_id', $user_id)
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->get();
                $data['completed_mss'] = FormMss::where('is_completed', 1)
                    ->where('user_id', $user_id)
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->get();
                $data['completed_near_miss'] = FormNearMiss::where('is_completed', 1)
                    ->where('user_id', $user_id)
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->get();
            } else {
                $data['outstanding_accident'] = FormAccident::where('is_completed', 0)
                    ->where('user_id', $user_id)
                    ->get();
                $data['outstanding_mss'] = FormMss::where('is_completed', 0)
                    ->where('user_id', $user_id)
                    ->get();
                $data['outstanding_near_miss'] = FormNearMiss::where('is_completed', 0)
                    ->where('user_id', $user_id)
                    ->get();

                $data['completed_accident'] = FormAccident::where('is_completed', 1)
                    ->where('user_id', $user_id)
                    ->get();
                $data['completed_mss'] = FormMss::where('is_completed', 1)
                    ->where('user_id', $user_id)
                    ->get();
                $data['completed_near_miss'] = FormNearMiss::where('is_completed', 1)
                    ->where('user_id', $user_id)
                    ->get();
            }
        }
        return view('forms.outstanding_list', $data);
    }

    public function edit(Request $request)
    {
        $form_name = $request->get('form_name');
        $form_id = $request->get('form_id');
        if($form_name == 'accident') {
            $data['form'] = Form::find(1);
            $data['sections'] = Section::where('form_id', 1)->get();
            $data['progressbar_li_width'] = round(98 / ($data['sections']->count() + 1)) - 0.2 ;
            $data['total_step'] = $data['sections']->count();
            $data['member'] = $this->member;
            $data['page_title'] = 'Accident Form';
            $form = FormAccident::find($form_id);
        }
        else if($form_name == 'mss') {
            $data['form'] = Form::find(2);
            $data['sections'] = Section::where('form_id', 2)->get();
            $data['progressbar_li_width'] = round(98 / ($data['sections']->count() + 1)) - 0.2 ;
            $data['total_step'] = $data['sections']->count();
            $data['member'] = $this->member;
            $data['page_title'] = 'MSS Form';
            $form = FormMss::find($form_id);
        }
        else {
            $data['form'] = Form::find(3);
            $data['sections'] = Section::where('form_id', 3)->get();
            $data['progressbar_li_width'] = round(98 / ($data['sections']->count() + 1)) - 0.2 ;
            $data['total_step'] = $data['sections']->count();
            $data['member'] = $this->member;
            $data['page_title'] = 'Near Miss Form';
            $form = FormNearMiss::find($form_id);
        }
        $data['form_data'] = $form->toArray();
        return view('forms.edit', $data);
    }
}
