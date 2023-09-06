{{-- Extends Layout --}}
@extends('layouts.backend')

{{-- Breadcrumbs --}}
@section('breadcrumbs')
    {!! Breadcrumbs::render('dashboard') !!}
@endsection

{{-- Page Title --}}
@section('page-title', $page_title)

{{-- Page Subtitle --}}
@section('page-subtitle', '')

{{-- Header Extras to be Included --}}
@section('head-extras')
<style>
.tableexport-caption{
    display: none;
}
</style>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-body" style="min-height: 600px;">
                    <table class="table table-hover table-bordered" id="health_concerns">
                        <thead>
                        <tr>
                            <th data-field="episode_reference">Episode Reference</th>
                            <th data-field="member_no">Member No</th>
                            <th data-field="member_name">Name</th>
                            <th data-field="member_surname">Surname</th>
                            <th data-field="group_code">Group Code</th>
                            <th data-field="ohc_appointment">OHC Date</th>
                            <th data-field="body_part">Body Part</th>
                            <th data-field="outcome">Outcome</th>
                            <th data-field="discharge_date">Discharge Date</th>
                            <th data-field="current_level">Current Level</th>
                            <th data-field="updated_at">Updated At</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($hs) == 0)
                            <tr><td colspan="11" style="text-align: center;"> No Data</td></tr>
                        @else
                            @foreach($hs as $item)
                                <tr>
                                    <td>{{$item->episode_reference}}</td>
                                    <td>{{$item->member->member_no}}</td>
                                    <td>{{$item->member->name}}</td>
                                    <td>{{$item->member->surname}}</td>
                                    <td>{{$item->member->group_code}}</td>
                                    <td>{{($item->ohc_appointment != null && $item->ohc_appointment != "")?date('d/m/Y', strtotime($item->ohc_appointment)):''}}</td>
                                    <td>{{$item->body_part->body_part}}</td>
                                    <td>{{$item->outcome}}</td>
                                    <td>{{($item->discharge_date != null && $item->discharge_date != "")?date('d/m/Y', strtotime($item->discharge_date)):''}}</td>
                                    <td>{{$item->current_level}}</td>
                                    <td>{{($item->updated_at != null && $item->updated_at != "")?date('d/m/Y H:i', strtotime($item->updated_at)):''}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection

{{-- Footer Extras to be Included --}}
@section('footer-extras')
    <script src="{{ cdn_asset('/adminlte/js/Chart.min.js') }}" type="text/javascript"></script>
    <script>
        $(function () {

        });
    </script>
@endsection
