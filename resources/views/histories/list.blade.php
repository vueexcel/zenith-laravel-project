
<table class="table table-responsive table-bordered table-striped">
@if(isset($histories) && count($histories) > 0)
    <thead>
    <th>Date time</th>
    <th>Updated by</th>
    </thead>
    <tbody>
    @foreach($histories as $history)
        <tr>
            <td>{{$history->user->name}}</td>
            <td>{{date('d/m/Y H:i:s', strtotime($history->updated_at))}}</td>
        </tr>
    @endforeach
    </tbody>
@else
    <tr><td style="text-align: center;"> There is no history. </td></tr>
@endif
</table>