<div class="table-responsive list-records">
    <table class="table table-hover table-bordered" id="supervisors_table">
        <thead>
            <th style="width: 100px;">Surname</th>
            <th>Name</th>
            <th>Occupation</th>
            <th>Group Code</th>
            <th style="width: 120px;">Actions</th>
        </thead>
        <tbody>
        @foreach ($records as $record)
            <tr>
                <td>{{ $record->surname }}</td>
                <td>
                    <a class="item-edit" data-item="supervisors" data-item_id="{{ $record->id }}">{{ $record->name }}</a>
                </td>
                <td>{{ $record->occupation }}</td>
                <td>{{ ($record->group_code)?$record->group_code->group_code:'' }}</td>
                <!-- we will also add show, edit, and delete buttons -->
                <td>
                    <a class="btn btn-info btn-xs item-edit" data-item="supervisors" data-item_id="{{ $record->id }}" style="cursor: pointer"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger btn-xs item-delete" data-item="supervisors" data-item_id="{{ $record->id }}"  style="cursor: pointer"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
