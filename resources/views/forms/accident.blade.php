{{-- Extends Layout --}}
@extends('layouts.backend')

{{-- Page Title --}}
@section('page-title', 'Accident Form')

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
                        {{ $sections->first()->name }}
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
                            <fieldset data-section="{{ $section->name }}">
                                <div class="form-card" style="padding: 15px;">
                                    @foreach($section->fields as $field)
                                        <div class="form-group row">
                                            <label for="" class="col-sm-4 col-form-label">{{ $field->name }}</label>
                                            <div class="col-sm-3">
                                                @if($field->input_type == 'Text')
                                                    <input type="text" class="form-control" id="" placeholder="{{ $field->comment }}">
                                                @elseif($field->input_type == 'Date')
                                                    <input type="text" class="form-control datepicker" id="" placeholder="{{ $field->comment }}">
                                                @elseif($field->input_type == 'Datetime')
                                                    <input type="text" class="form-control datetimepicker" id="" placeholder="{{ $field->comment }}">
                                                @elseif($field->input_type == 'Text')
                                                    <textarea class="form-control" style="height: 100px;"></textarea>
                                                @else
                                                    <select class="form-control" name="">
                                                        <option></option>
                                                        @foreach($field->answers as $answer)
                                                            <option value="{{$answer->name}}">{{$answer->name}}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
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


        });
    </script>
@endsection
