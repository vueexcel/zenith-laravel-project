{{-- Extends Layout --}}
@extends('layouts.backend')
@section('head-extras')

@stop

{{-- Page Title --}}
@section('page-title', $title)

{{-- Page Subtitle --}}
@section('page-subtitle', $sub_title)

{{-- Header Extras to be Included --}}
@section('head-extras')
    @parent
@endsection

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Forms Report</h3>
                </div>
            </div>
        </div>

        <div class="col-md-12">

        </div>
    </div>
@endsection

{{-- Footer Extras to be Included --}}
@section('footer-extras')
    <link href="{{ cdn_asset('/css/report.css') }}" rel="stylesheet" type="text/css">
@endsection

@push('footer-scripts')
    <script src="{{ cdn_asset('/js/report.js') }}"></script>
@endpush
