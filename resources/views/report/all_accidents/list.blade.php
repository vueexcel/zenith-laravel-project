<table class="table table-bordered">
    <thead>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        @foreach($columns as $column)
            <th></th>
        @endforeach
    </tr>
    <tr>
        <th></th>
        <th class="th-center">Group</th>
        <th>Dept</th>
        @foreach($columns as $column)
            <th>{{$column['name']}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    <!--------A-------->
    @foreach($rows as $key => $row)
        @if($key != 'J')
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                @for($i=0; $i<count($columns); $i++)
                    <td>&nbsp;</td>
                @endfor
            </tr>
        @else
            <tr style="background-color: #B7DEE8">
                <td>&nbsp;</td>
                <td>J5???+JC???+JD???</td>
                <td style="text-align: left;">Paint Total</td>
                @foreach($j5_c_d as $item)
                    <td>{{$item['value']}}</td>
                @endforeach
            </tr>
        @endif

        @foreach($row['groups'] as $group)
            <tr>
                <td>&nbsp;</td>
                <td>{{$group['code']}}</td>
                <td style="text-align: left;">{{$group['department']}}</td>
                @foreach($group['columns'] as $column)
                    <td>{{$column['value']}}</td>
                @endforeach
            </tr>
        @endforeach

        @if($key == 'J')
            <tr style="background-color: #B7DEE8">
                <td>&nbsp;</td>
                <td>J6???+JA???+JB???</td>
                <td style="text-align: left;">Plastics Total</td>
                @foreach($j6_a_b as $item)
                    <td>{{$item['value']}}</td>
                @endforeach
            </tr>
        @elseif($key == 'G')
            <tr style="background-color: #B7DEE8">
                <td>&nbsp;</td>
                <td>GA/F/G</td>
                <td style="text-align: left;">Assembly Engineering and Maintenance</td>
                @foreach($ga_f_g as $item)
                    <td>{{$item['value']}}</td>
                @endforeach
            </tr>
        @else
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                @for($i=0; $i<count($columns); $i++)
                    <td>&nbsp;</td>
                @endfor
            </tr>
        @endif

        @if($key == "M" || $key == "H")
            <tr style="background-color: #00FFFF;">
        @else
            <tr style="background-color: yellow;">
        @endif
                <td>&nbsp;</td>
                <td>{{$row['code']}}</td>
                <td style="text-align: left;">{{$row['department']}}</td>
            @if($key == "M")
                @foreach($burnaston as $item)
                    <td>{{$item['value']}}</td>
                @endforeach
            @else
                @foreach($row['columns'] as $column)
                    <td>{{$column['value']}}</td>
                @endforeach
            @endif
        </tr>
    @endforeach
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            @for($i=0; $i<count($columns); $i++)
                <td>&nbsp;</td>
            @endfor
        </tr>

        <tr style="background-color: #FF99CC;">
            <td>&nbsp;</td>
            <td>TMUK</td>
            <td style="text-align: left;">Toyota UK Total</td>
            @foreach($tmuk as $item)
                <td>{{$item['value']}}</td>
            @endforeach
        </tr>
    </tbody>
</table>
