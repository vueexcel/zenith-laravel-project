<?php

namespace App\Http\Controllers\Admin;

use App\Models\Answer;
use App\Models\Field;
use App\Models\Form;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormsController extends Controller
{
    //
    public function index()
    {
        $data['forms'] = Form::all();
        return view('admin.forms', $data);
    }

    //Sections
    public function save_section(Request $request)
    {
        $form_id = $request->get('form_id');
        $name = $request->get('section_name');
        //Get order number
        $last_section = Section::orderBy('order_number', 'DESC')->first();
        if($last_section)
            $order_number = $last_section->order_number + 1;
        else
            $order_number = 1;
        $section = new Section();
        $section->name = $name;
        $section->form_id = $form_id;
        $section->order_number = $order_number;
        $section->save();
        return 'Ok';

    }

    public function update_section(Request $request)
    {
        $name = $request->get('section_name');
        $section_id = $request->get('section_id');
        $section = Section::find($section_id);
        $section->name = $name;
        $section->save();
        return 'Ok';
    }

    public function delete_section(Section $section)
    {
        $section_id = $section->id;
        $fields = Field::where('section_id', $section_id)->get();
        foreach ($fields as $field){
            Answer::where('field_id', $field->id)->delete();
        }
        Field::where('section_id', $section_id)->delete();
        $section->delete();
        return 'Ok';
    }

    //Field
    public function save_field(Request $request)
    {
        $section_id = $request->get('section_id');
        $name = $request->get('field_name');
        $input_type = $request->get('input_type');
        $is_required = $request->get('is_required');
        $comment = $request->get('comment');
        $db_field = $request->get('db_field');

        if($request->has('field_id')){
            $field = Field::find($request->get('field_id'));
        } else {
            $field = new Field();
            //Get order number
            $last_item = Field::where('section_id', $section_id)->orderBy('order_number', 'DESC')->first();
            if($last_item)
                $order_number = $last_item->order_number + 1;
            else
                $order_number = 1;
            $field->order_number = $order_number;
        }

        $field->name = $name;
        $field->input_type = $input_type;
        $field->is_required = $is_required;
        $field->comment = $comment;
        $field->db_field = $db_field;
        $field->section_id = $section_id;
        $field->save();
        $data['section'] = Section::find($section_id);
        return view('admin.fields', $data);
    }

    public function update_field(Request $request)
    {
        $name = $request->get('field_name');
        $input_type = $request->get('input_type');
        $is_required = $request->get('is_required');
        $comment = $request->get('comment');
        $db_field = $request->get('db_field');
        $field = Field::find($request->get('field_id'));
        $field->name = $name;
        $field->input_type = $input_type;
        $field->is_required = $is_required;
        $field->comment = $comment;
        $field->db_field = $db_field;
        $field->save();
        $data['section'] = Section::find($field->section_id);
        return view('admin.fields', $data);
    }

    public function delete_field(Field $field)
    {
        $section_id = $field->section_id;
        Answer::where('field_id', $field->id)->delete();
        $field->delete();
        $data['section'] = Section::find($section_id);
        return view('admin.fields', $data);
    }

    //Answer
    public function read_answers(Request $request)
    {
        $field_id = $request->get('field_id');
        $data['field'] = Field::find($field_id);
        return view('admin.answers', $data);
    }

    public function save_answer(Request $request)
    {
        $field_id = $request->get('field_id');
        $name = $request->get('answer_name');
        $answer_id = $request->get('answer_id');
        if($answer_id != 0){
            $answer = Answer::find($answer_id);
        } else {
            $answer = new Answer();
            $last_item = Answer::where('field_id', $field_id)->orderBy('order_number', 'DESC')->first();
            if($last_item)
                $order_number = $last_item->order_number + 1;
            else
                $order_number = 1;
            $answer->order_number = $order_number;
        }

        $answer->name = $name;
        $answer->field_id = $field_id;
        $answer->save();

        $data['field'] = Field::find($field_id);
        return view('admin.answers', $data);
    }

    public function update_answer(Request $request)
    {
        $answer_id = $request->get('answer_id');
        $answer_name = $request->get('answer_name');
        $section_id = $request->get('section_id');
        $answer = Answer::find($answer_id);
        $answer->name = $answer_name;
        $answer->save();
        $data['section'] = Section::find($section_id);
        return view('admin.fields', $data);
    }

    public function delete_answer(Answer $answer)
    {
        $answer->delete();
        echo 'Ok';
    }

    public function update_order(Request $request)
    {
        $updated_order = $request->get('updated_order');
        $target = $request->get('target');
        foreach($updated_order as $index => $id)
        {
            if($target == 'field') {
                Field::where('id', $id)->update(['order_number'=>$index + 1]);
            }

            if($target == 'answer') {
                Answer::where('id', $id)->update(['order_number'=>$index + 1]);
            }

            if($target == 'section') {
                Section::where('id', $id)->update(['order_number'=>$index + 1]);
            }

        }
    }
}
