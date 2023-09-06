<table class="table table-bordered table-striped">
    <tr>
        <td>Mbr No</td>
        <td>Surname</td>
        <td>Name</td>
        <td>Occupation</td>
        <td>Group_Code</td>
        <td>Department</td>
    </tr>
    @foreach($report_data as $record)
        <tr>
            <td>{{$record->member_no}}</td>
            <td>{{$record->surname}}</td>
            <td>{{$record->name}}</td>
            <td>{{$record->occupation}}</td>
            <td>{{$record->group_code}}</td>
            <td>{{$record->department}}</td>
        </tr>
    @endforeach
</table>
