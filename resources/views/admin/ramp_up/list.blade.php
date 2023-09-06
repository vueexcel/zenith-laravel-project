<div class="table-responsive list-records">
    <table class="table table-hover table-bordered" id="ramp_up_table">
        <thead>
            <th>Ramp Up Weeks</th>
            <th style="width: 120px;">Actions</th>
        </thead>
        <tbody>
        @foreach ($records as $record)
            <tr>
                <td>
                    <a class="item-edit" data-item="ramp_up" data-item_id="{{ $record->id }}">{{ $record->ramp_up }}</a>
                </td>
                <!-- we will also add show, edit, and delete buttons -->
                <td>
                    <a class="btn btn-info btn-xs item-edit" data-item="ramp_up" data-item_id="{{ $record->id }}" style="cursor: pointer"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger btn-xs item-delete" data-item="ramp_up" data-item_id="{{ $record->id }}"  style="cursor: pointer"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
