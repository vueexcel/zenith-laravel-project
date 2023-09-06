<table class="table table-bordered">
    <thead>
    <tr>
        <th>Group</th>
        <th>Dept</th>
        @foreach($columns as $column)
            <th>{{$column}}</th>
        @endforeach
        <th>TOTAL</th>
    </tr>
    </thead>
    <tbody>
    <!--------A-------->
    <tr>
        <td>A1???</td>
        <td style="text-align: left;">External Affairs</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>A2???</td>
        <td style="text-align: left;">External Affairs</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>A9???</td>
        <td style="text-align: left;">External Affairs</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        @foreach($columns as $column)
            <td>&nbsp;</td>
        @endforeach
        <td>&nbsp;</td>
    </tr>
    <tr style="background-color: yellow;">
        <td>CP & Dir</td>
        <td style="text-align: left;">Corporate Planning & Directors Office</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        @foreach($columns as $column)
            <td>&nbsp;</td>
        @endforeach
        <td>&nbsp;</td>
    </tr>

    <!--------B-------->
    <tr>
        <td>B1???</td>
        <td style="text-align: left;">Personnel & Employee Relations</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>B2???</td>
        <td style="text-align: left;">Headcount Planning Resourcing</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>B3???</td>
        <td style="text-align: left;">Health Safety</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>B4???</td>
        <td style="text-align: left;">Administration & HR Systems</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>B5???</td>
        <td style="text-align: left;">Organisation Development</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>B6???</td>
        <td style="text-align: left;">Ex-Pats / TME Xfr</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>B7???</td>
        <td style="text-align: left;">HR GM</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        @foreach($columns as $column)
            <td>&nbsp;</td>
        @endforeach
        <td>&nbsp;</td>
    </tr>
    <tr style="background-color: yellow;">
        <td>HR Div</td>
        <td style="text-align: left;">Human Resources</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        @foreach($columns as $column)
            <td>&nbsp;</td>
        @endforeach
        <td>&nbsp;</td>
    </tr>

    <!--------C-------->
    <tr>
        <td>C1???</td>
        <td style="text-align: left;">Accounts & Finance</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>C2???</td>
        <td style="text-align: left;">&nbsp;</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>C3???</td>
        <td style="text-align: left;">Corporate Services</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>C9???</td>
        <td style="text-align: left;">F&CS GM</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        @foreach($columns as $column)
            <td>&nbsp;</td>
        @endforeach
        <td>&nbsp;</td>
    </tr>
    <tr style="background-color: yellow;">
        <td>A&F Div</td>
        <td style="text-align: left;">Accounts & Finance</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>

    <!--------E---------->
    <tr>
        <td style="background-color: #00FFFF"></td>
        <td style="background-color: #00FFFF; text-align: left;">corporate office</td>
        @foreach($columns as $column)
            <td>&nbsp;</td>
        @endforeach
        <td>&nbsp;</td>
    </tr>

    <tr>
        <td>E1???</td>
        <td style="text-align: left;">Not Used Yet</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>E2???</td>
        <td style="text-align: left;">Not Used Yet</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>E3???</td>
        <td style="text-align: left;">Plant Management</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>E4???</td>
        <td style="text-align: left;">Supply Chain & Project Management</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>E5???</td>
        <td style="text-align: left;">Parts Flow Management</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>E6???</td>
        <td style="text-align: left;">Logistics Operations</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>E7???</td>
        <td style="text-align: left;">Project Management</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>E8???</td>
        <td style="text-align: left;">Project & Parts Control</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>E9???</td>
        <td style="text-align: left;">PC GM</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        @foreach($columns as $column)
            <td>&nbsp;</td>
        @endforeach
        <td>&nbsp;</td>
    </tr>
    <tr style="background-color: yellow;">
        <td>PC Div</td>
        <td style="text-align: left;">Production Control</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        @foreach($columns as $column)
            <td></td>
        @endforeach
        <td></td>
    </tr>

    <!-------------F---------------->
    <tr>
        <td>F1???</td>
        <td style="text-align: left;">Mass Production Quality</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>F2???</td>
        <td style="text-align: left;">Inspection Operations Line</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>F3???</td>
        <td style="text-align: left;">Special Projects</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>F4???</td>
        <td style="text-align: left;">Planning & Projects</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>F5???</td>
        <td style="text-align: left;">Audit Operations</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>F6???</td>
        <td style="text-align: left;">New Project Quality</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>F7???</td>
        <td style="text-align: left;">Not Used Yet</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>F8???</td>
        <td style="text-align: left;">Outside Contracts</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>F9???</td>
        <td style="text-align: left;">QA GM</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td></td>
        @foreach($columns as $column)
            <td>&nbsp;</td>
        @endforeach
        <td>&nbsp;</td>
    </tr>
    <tr style="background-color: yellow;">
        <td>QA Div</td>
        <td style="text-align: left;">Quality Assurance</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        @foreach($columns as $column)
            <td>&nbsp;</td>
        @endforeach
        <td>&nbsp;</td>
    </tr>

    <!--------------J--------------->

    <!--------------G--------------->

    <!--------------K--------------->

    <!--------------L--------------->
    <tr style="background-color: #00FFFF;">
        <td>Burnaston</td>
        <td style="text-align: left;">Burnaston</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        @foreach($columns as $column)
            <td>&nbsp;</td>
        @endforeach
        <td>&nbsp;</td>
    </tr>

    <!--------------H--------------->
    <tr>
        <td>H???</td>
        <td style="text-align: left;">Engine Other</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>H1???</td>
        <td style="text-align: left;">General Affairs</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>H25??</td>
        <td style="text-align: left;">Casting</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>H28??</td>
        <td style="text-align: left;">ZR</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>H3???</td>
        <td style="text-align: left;">QA</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>H4???</td>
        <td style="text-align: left;">PC</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>H5???</td>
        <td style="text-align: left;">Engineering</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>H6???</td>
        <td style="text-align: left;">Maintenance</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>H9???</td>
        <td style="text-align: left;">Engine Directors</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>


    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        @foreach($columns as $column)
            <td>&nbsp;</td>
        @endforeach
        <td>&nbsp;</td>
    </tr>

    <tr style="background-color: #00FFFF;">
        <td>Deeside</td>
        <td style="text-align: left;">Deeside</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        @foreach($columns as $column)
            <td>&nbsp;</td>
        @endforeach
        <td>&nbsp;</td>
    </tr>

    <tr style="background-color: #FF99CC;">
        <td>TMUK</td>
        <td style="text-align: left;">Toyota UK Total</td>
        @foreach($columns as $column)
            <td>0.00</td>
        @endforeach
        <td>0.00</td>
    </tr>

    </tbody>
</table>
