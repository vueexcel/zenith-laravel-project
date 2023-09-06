<div class="col-sm-6">
    <div class="box box-primary">
        <div class="box-header" style="padding-top: 0; text-align: center;">
            <h3>Total Forms Outstanding</h3>
        </div>
        <div class="box-body" style="text-align: center">
            <div class="row">
                <div class="col-sm-4">
                    <label style="font-weight: normal; font-size: 20px;">Accident</label> <br/>
                    <div style="width: 75px; height: 75px; border-radius: 36px; margin: 0 auto; padding-top: 21px; font-size: 24px;" class="bg-gray">
                        {{ $outstanding_accident->count() }}
                    </div>
                </div>
                <div class="col-sm-4">
                    <label style="font-weight: normal; font-size: 20px;">MSS</label> <br/>
                    <div style="width: 75px; height: 75px; border-radius: 36px; margin: 0 auto; padding-top: 21px; font-size: 24px;" class="bg-gray">
                        {{ $outstanding_mss->count() }}
                    </div>
                </div>
                <div class="col-sm-4">
                    <label style="font-weight: normal; font-size: 20px;">Near Miss</label> <br/>
                    <div style="width: 75px; height: 75px; border-radius: 36px; margin: 0 auto; padding-top: 21px; font-size: 24px;" class="bg-gray">
                        {{ $outstanding_near_miss->count() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="box box-primary">
        <div class="box-header" style="padding-top: 0; text-align: center;">
            <h3>Total Forms Complete</h3>
        </div>
        <div class="box-body" style="text-align: center">
            <div class="row">
                <div class="col-sm-4">
                    <label style="font-weight: normal; font-size: 20px;">Accident</label> <br/>
                    <div style="width: 75px; height: 75px; border-radius: 36px; margin: 0 auto; padding-top: 21px; font-size: 24px;" class="bg-gray">
                        {{ $completed_accident->count() }}
                    </div>
                </div>
                <div class="col-sm-4">
                    <label style="font-weight: normal; font-size: 20px;">MSS</label> <br/>
                    <div style="width: 75px; height: 75px; border-radius: 36px; margin: 0 auto; padding-top: 21px; font-size: 24px;" class="bg-gray">
                        {{ $completed_mss->count() }}
                    </div>
                </div>
                <div class="col-sm-4">
                    <label style="font-weight: normal; font-size: 20px;">Near Miss</label> <br/>
                    <div style="width: 75px; height: 75px; border-radius: 36px; margin: 0 auto; padding-top: 21px; font-size: 24px;" class="bg-gray">
                        {{ $completed_near_miss->count() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body" style="text-align: center">
            <table class="table table-bordered table-striped" style="margin-top: 10px;">
                <thead>
                <tr>
                    <th>Member NO</th>
                    <th>Full Name</th>
                    <th>Form Type</th>
                    <th>Date Started</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                @foreach($outstanding_accident as $item)
                    <tr>
                        <td>{{ $item->member_no }}</td>
                        <td>{{ $item->full_name }}</td>
                        <td>Accident</td>
                        <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                        <td>Incomplete</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm edit-form" value="{{ $item->id }}" data-form="accident">View / Edit</button>
                        </td>
                    </tr>
                @endforeach
                @foreach($outstanding_mss as $item)
                    <tr>
                        <td>{{ $item->member_no }}</td>
                        <td>{{ $item->full_name }}</td>
                        <td>MSS</td>
                        <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                        <td>Incomplete</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm edit-form" value="{{ $item->id }}" data-form="mss">View / Edit</button>
                        </td>
                    </tr>
                @endforeach
                @foreach($outstanding_near_miss as $item)
                    <tr>
                        <td>{{ $item->member_no }}</td>
                        <td>{{ $item->full_name }}</td>
                        <td>Near Miss</td>
                        <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                        <td>Incomplete</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm edit-form" value="{{ $item->id }}" data-form="near_miss">View / Edit</button>
                        </td>
                    </tr>
                @endforeach
                @foreach($completed_accident as $item)
                    <tr>
                        <td>{{ $item->member_no }}</td>
                        <td>{{ $item->full_name }}</td>
                        <td>Accident</td>
                        <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                        <td>Complete</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm edit-form" value="{{ $item->id }}" data-form="accident">View / Edit</button>
                        </td>
                    </tr>
                @endforeach
                @foreach($completed_mss as $item)
                    <tr>
                        <td>{{ $item->member_no }}</td>
                        <td>{{ $item->full_name }}</td>
                        <td>MSS</td>
                        <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                        <td>Complete</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm edit-form" value="{{ $item->id }}" data-form="mss">View / Edit</button>
                        </td>
                    </tr>
                @endforeach
                @foreach($completed_near_miss as $item)
                    <tr>
                        <td>{{ $item->member_no }}</td>
                        <td>{{ $item->full_name }}</td>
                        <td>Near Miss</td>
                        <td>{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                        <td>Complete</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm edit-form" value="{{ $item->id }}" data-form="near_miss">View / Edit</button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
