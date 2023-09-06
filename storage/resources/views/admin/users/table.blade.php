<div class="table-responsive list-records" style="padding: 10px">
    <table class="table table-hover table-bordered">
        <thead>
            <!--<th style="width: 10px;"><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>-->
            <th>#</th>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Admin</th>
            <th style="width: 120px;">Actions</th>
        </thead>
        <tbody>
        @foreach ($records as $record)
            <?php
            $tableCounter++;
            $editLink = route($resourceRoutesAlias.'.edit', $record->id);
            $deleteLink = route($resourceRoutesAlias.'.destroy', $record->id);
            $formId = 'formDeleteModel_'.$record->id;
            $formIdImpersonate = 'impersonateForm_'.$record->id;

            $canUpdate = Auth::user()->can('update', $record);
            $canDelete = Auth::user()->can('delete', $record);
            $canImpersonate = Auth::user()->can('impersonate', $record);
            ?>
            <tr>
            <!--<td><input type="checkbox" name="ids[]" value="{{ $record->id }}" class="square-blue"></td>-->
                <td>{{ $tableCounter }}</td>
                <td>
                    @if ($canUpdate)
                        <a href="{{ $editLink }}">{{ $record->id }}</a>
                    @else {{ $record->id }} @endif
                </td>
                <td class="table-text">
                    <a href="{{ $editLink }}">{{ $record->name }}</a>
                </td>
                <td>{{ $record->email }}</td>
                @if ($record->is_admin == 1)
                    <td><div class="label label-info">Admin</div></td>
                @else
                    <td><div class="label label-warning">User</div></td>
                @endif

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

@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.table').DataTable({
                'paging'      : false,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false,
                "order": [[ 0, "desc" ]]
            });
        })
    </script>
@endpush