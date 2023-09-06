{{-- Extends Layout --}}
@extends('layouts.backend')

{{-- Page Title --}}
@section('page-title', $page_title)

{{-- Page Subtitle --}}
@section('page-subtitle', '')

{{-- Header Extras to be Included --}}
@section('head-extras')
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <style>
        #progressbar li {
            list-style-type: none;
            font-size: 15px;
            width: {{ $progressbar_li_width }}%;
            float: left;
            position: relative;
            font-weight: 400
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box" style="padding-top: 15px;">
                <div class="box-body" style="text-align: center">
                    <button class="btn btn-danger" id="btn_section_name" type="button" style="font-size: 20px; min-width: 400px; width: auto; margin: 0 auto">
                        @if($sections->count() > 0)
                            {{ $sections->first()->name }}
                        @endif
                    </button>
                    <form id="msform">
                        <!-- progressbar -->
                        <ul id="progressbar">
                            @foreach($sections as $index => $section)
                                <li class="{{ ($index == 0)?'active':'' }}" id="step{{ $index + 1 }}"><strong>Step{{ $index + 1 }}</strong></li>
                            @endforeach
                            <li id="confirm"><strong>Complete</strong></li>
                        </ul>

                        @foreach($sections as $index => $section)
                            <fieldset data-section="{{ $section->name }}" data-item="{{ $form_data->id }}">
                                <div class="form-card" style="padding: 15px;">
                                    @foreach($section->fields as $field)
                                        <div class="form-group row">
                                            <label for="" class="col-sm-4 col-form-label">{{ $field->name }}</label>
                                            <div class="col-sm-4" data-field-type="{{ $field->input_type }}">
                                                @if($field->comment == 'Member No' && !empty($member))
                                                    <input type="text" class="form-control form-data" id="{{ $field->db_field }}" name="{{ $field->db_field }}"
                                                           {{ ($field->is_required == 1)?'required':'' }}
                                                           value="{{ $member->member_no }}">
                                                @elseif($field->comment == 'Member Full Name' && !empty($member))
                                                    <input type="text" class="form-control form-data" id="{{ $field->db_field }}" name="{{ $field->db_field }}"
                                                           {{ ($field->is_required == 1)?'required':'' }}
                                                           value="{{ $member->name }} {{ $member->surname }}">
                                                @elseif($field->comment == 'Member Group Code' && !empty($member))
                                                    <input type="text" class="form-control form-data" id="{{ $field->db_field }}" name="{{ $field->db_field }}"
                                                           {{ ($field->is_required == 1)?'required':'' }}
                                                           value="{{ $member->group_code }}">
                                                @else
                                                    @if($field->input_type == 'Text')
                                                        <input type="text" class="form-control form-data" id="{{ $field->db_field }}" name="{{ $field->db_field }}"
                                                            {{ ($field->is_required == 1)?'required':'' }}>
                                                    @elseif($field->input_type == 'Date')
                                                        <input type="text" class="form-control datetimepicker-single form-data" id="{{ $field->db_field }}" name="{{ $field->db_field }}"
                                                            {{ ($field->is_required == 1)?'required':'' }} value="{{ ($field->db_field == 'accident_date')?date('d/m/Y'):'' }}">
                                                    @elseif($field->input_type == 'Datetime')
                                                        <input type="text" class="form-control datetimepicker form-data" id="{{ $field->db_field }}" name="{{ $field->db_field }}"
                                                            {{ ($field->is_required == 1)?'required':'' }}>
                                                    @elseif($field->input_type == 'Textarea')
                                                        <textarea class="form-control form-data" style="height: 100px;" id="{{ $field->db_field }}" name="{{ $field->db_field }}" {{ ($field->is_required == 1)?'required':'' }}></textarea>
                                                    @else
                                                        <select class="form-control form-data" id="{{ $field->db_field }}" name="{{ $field->db_field }}" {{ ($field->is_required == 1)?'required':'' }}>>
                                                            <option></option>
                                                            @foreach($field->answers as $answer)
                                                                <option value="{{$answer->name}}">{{$answer->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="col-sm-4">
                                                @if($field->is_required == 1)
                                                    <span style="display: inline; color: red; font-size: 16px;"><i class="fa fa-certificate" aria-hidden="true"></i></span>
                                                @endif
                                                <span style="display: inline; color: #656464; margin-left: 10px;">{{ $field->comment }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @if($index < $total_step - 1)
                                    <button type="button" name="next" class="btn btn-primary pull-right next action-button" style="width: 120px; margin: 5px;" value="Next">Next</button>
                                @endif

                                @if($index == $total_step - 1)
                                    <button type="button" class="btn btn-success pull-right next action-button" style="width: 120px; margin: 5px;" value="finish">Submit</button>
                                @endif

                                @if($index > 0)
                                    <button type="button" class="btn btn-default pull-right previous action-button-previous" style="width: 120px; margin: 5px;" value="finish">Previous</button>
                                @endif
                            </fieldset>
                        @endforeach

                        <fieldset data-section="Complete Form">
                            <div class="form-card">
                                <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                                <div class="row">
                                    <div class="col-md-12" style="text-align: center;">
                                        <img src="{{ asset('img/success.jpg') }}" style="width: 300px; height: auto;">
                                    </div>
                                </div>
                                <br><br>
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <h5 class="purple-text text-center">You have Successfully submitted accident information</h5>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <input type="hidden" id="form_name" name="form_name" value="{{ $form->name }}">
                    </form>
                </div>

            </div>
        </div>
    </div>


@endsection

{{-- Footer Extras to be Included --}}
@section('footer-extras')
    <script src="{{ asset('js/forms.js') }}"></script>
    <script>
        $(function () {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });

            $(".datetimepicker-single").on('dp.hide', function (e) {
                alert($(this).attr('id'));
            });

            $(document).on('change', '.form-data', function () {
                var value = $(this).val();
                var field = $(this).attr('id');
                var field_type = $(this).closest('div').attr('data-field-type');
                var form_id = $(this).closest('fieldset').attr('data-item');
                var form_name = $("#form_name").val();
                $.ajax({
                    url: route('forms::save_field'),
                    type: "POST",
                    data: {
                        field: field,
                        field_type: field_type,
                        value: value,
                        form_name: form_name,
                        form_id: form_id
                    },
                    success: function(result) {
                        console.log(result);
                    },
                });
            });
        });
    </script>
@endsection
