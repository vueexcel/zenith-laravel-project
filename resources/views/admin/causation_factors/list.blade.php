<div class="table-responsive list-records">
    <table class="table table-hover table-bordered" id="causation_factors_table">
        <thead>
            <th style="width: 100px;">Number</th>
            <th>Causation Factor</th>
            <th style="width: 120px;">Actions</th>
        </thead>
        <tbody>
        @foreach ($records as $record)
            <tr>
                <td>{{ $record->number }}</td>
                <td>
                    <a class="item-edit" data-item="causation_factors" data-item_id="{{ $record->id }}">{{ $record->causation_factor }}</a>
                </td>
                <!-- we will also add show, edit, and delete buttons -->
                <td>
                    <a class="btn btn-info btn-xs item-edit" data-item="causation_factors" data-item_id="{{ $record->id }}" style="cursor: pointer"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger btn-xs item-delete" data-item="causation_factors" data-item_id="{{ $record->id }}"  style="cursor: pointer"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
