<div class="table-responsive list-records">
    <table class="table table-hover table-bordered">
        <thead>
            <!--<th style="width: 10px;"><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>-->
            <th>Logged Date</th>
            <th>Accident Date</th>
            <th>Member No.</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Group Code</th>
            <th>Stop 6 Incident?</th>
            @if(Auth::user()->is_admin > 1)
                <th style="width: 120px;">Actions</th>
            @endif
        </thead>
        <tbody>
        @foreach ($records as $record)
            <?php
            $editLink = route($resourceRoutesAlias.'.edit', $record->id);
            $deleteLink = route($resourceRoutesAlias.'.destroy', $record->id);
            $formId = 'formDeleteModel_'.$record->id;
            $formIdImpersonate = 'impersonateForm_'.$record->id;

            $canUpdate = Auth::user()->can('update', $record);
            $canDelete = Auth::user()->can('delete', $record);
            $canImpersonate = Auth::user()->can('impersonate', $record);
            ?>
            <tr>
                <td>{{ $record->logged_date }}</td>
                <td>{{ $record->incident_date }}</td>
                <td class="table-text">
                    @if ($canUpdate)
                        <a href="{{ $editLink }}">{{ ($record->member)?$record->member->member_no:'' }}</a>
                    @else {{ ($record->member)?$record->member->member_no:'' }} @endif
                </td>
                <td class="table-text">
                    @if ($canUpdate)
                        <a href="{{ $editLink }}">{{ ($record->member)?$record->member->name:'' }}</a>
                    @else {{ ($record->member)?$record->member->name:'' }} @endif
                </td>
                <td class="table-text">
                    @if ($canUpdate)
                        <a href="{{ $editLink }}">{{ ($record->member)?$record->member->surname:'' }}</a>
                    @else {{ ($record->member)?$record->member->surname:'' }} @endif
                </td>
                <td>{{ ($record->group_code)?$record->group_code->group_code:'' }}</td>
                <td style="text-transform: uppercase">{{ $record->stop_6 }}</td>
                <!-- we will also add show, edit, and delete buttons -->
                <td>
                    <div class="btn-group">
                        @if ($canImpersonate)
                            <a href="#" class="btn btn-warning btn-sm"
                               onclick="event.preventDefault(); document.getElementById('{{$formIdImpersonate}}').submit();"
                            >
                                <i class="fa fa-user-secret"></i>
                            </a>
                            <form id="{{$formIdImpersonate}}" action="{{ route('impersonate', $record->id) }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        @endif
                        @if ($canUpdate)
                            <a href="{{ $editLink }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                        @endif
                        @if ($canDelete)
                            <a href="#" class="btn btn-danger btn-sm btnOpenerModalConfirmModelDelete"
                               data-form-id="{{ $formId }}"><i class="fa fa-trash-o"></i></a>
                        @endif
                    </div>
                    @if ($canDelete)
                        <!-- Delete Record Form -->
                        <form id="{{ $formId }}" action="{{ $deleteLink }}" method="POST"
                              style="display: none;" class="hidden form-inline">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
