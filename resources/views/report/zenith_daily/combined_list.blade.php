<table class="table table-bordered table-striped">
    <tr>
        <td></td>
        <td>CHECK</td>
        <td>{{ count($report_data) }}</td>
        <td style="background: green">{{ count($report_data) }}</td>
        <td></td>
        <td></td>
        <td>{{ $ramp_up }}</td>
        <td>{{ $rest_mod_nwk }}</td>
        <td>{{ $rest_mod_wk }}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Mbr No</td>
        <td>Surname</td>
        <td>Name</td>
        <td>Occupation</td>
        <td>Group_Code</td>
        <td>Department</td>
        <td>Ramp Up</td>
        <td>Rest Mod 100% NWK</td>
        <td>Rest Mod 100% WK</td>
        <td>Red Flex Not Working</td>
        <td>Maternity</td>
        <td>X Cat</td>
        <td>X Cat Value</td>
        <td>DUPLICATES</td>
    </tr>
@foreach($report_data as $record)
    <tr>
        <td>{{$record['member']->member_no}}</td>
        <td>{{$record['member']->surname}}</td>
        <td>{{$record['member']->name}}</td>
        <td>{{$record['member']->occupation}}</td>
        <td>{{$record['member']->group_code}}</td>
        <td>{{$record['member']->department}}</td>
        <td style="border: 1px solid #4E5052; background: {{($record['ramp_up'] == 1)?'#7B858B':'#FFFFFF'}}"></td>
        <td style="border: 1px solid #4E5052; background: {{($record['rest_mod_nwk'] == 1)?'#7B858B':'#FFFFFF'}}"></td>
        <td style="border: 1px solid #4E5052; background: {{($record['rest_mod_wk'] == 1)?'#7B858B':'#FFFFFF'}}"></td>
        <td style="border: 1px solid #4E5052; background: {{($record['red_flex_not_working'] == 1)?'#7B858B':'#FFFFFF'}}"></td>
        <td style="border: 1px solid #4E5052; background: {{($record['maternity'] == 1)?'#7B858B':'#FFFFFF'}}"></td>
        <td style="border: 1px solid #4E5052; "></td>
        <td style="border: 1px solid #4E5052; "></td>
        <td style="border: 1px solid #4E5052; "></td>
    </tr>
@endforeach
</table>
