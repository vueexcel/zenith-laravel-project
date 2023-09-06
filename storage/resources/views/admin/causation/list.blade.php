<div class="table-responsive list-records">
    <table class="table table-hover table-bordered" id="causation_table">
        <thead>
            <th>Causation</th>
            <th style="width: 120px;">Actions</th>
        </thead>
        <tbody>
        @foreach ($records as $record)
            <tr>
                <td>
                    <a class="item-edit" data-item="causation" data-item_id="{{ $record->id }}">{{ $record->causation }}</a>
                </td>
                <!-- we will also add show, edit, and delete buttons -->
                <td>
                    <a class="btn btn-info btn-xs item-edit" data-item="causation" data-item_id="{{ $record->id }}" style="cursor: pointer"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger btn-xs item-delete" data-item="causation" data-item_id="{{ $record->id }}"  style="cursor: pointer"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
