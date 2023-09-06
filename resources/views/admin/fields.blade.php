<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered field-table" id="section_table{{ $section->id }}">
            <thead>
            <tr>
                <th style="width: 420px">Question</th>
                <th style="width: 220px">Answer Type</th>
                <th>Is Required</th>
                <th>Comment</th>
                <th style="width: 220px">DB Field Name</th>
                <th style="width: 120px"></th>
            </tr>
            <tr>
                <td>
                    <input type="text" name="field_name" class="form-control" placeholder="Question">
                </td>
                <td>
                    <select class="form-control" name="input_type">
                        <option value="Text">Text</option>
                        <option value="Textarea">Textarea</option>
                        <option value="Date">Date</option>
                        <option value="Datetime">Datetime</option>
                        <option value="Dropdown options">Dropdown options</option>
                    </select>
                </td>
                <td>
                    <select class="form-control" name="is_required">
                        <option value="1">Required</option>
                        <option value="0">Optional</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="comment" class="form-control" placeholder="Comment">
                </td>
                <td>
                    <input type="text" name="db_field" class="form-control" placeholder="DB Field Name">
                </td>

                <td style="text-align: center;">
                    <button type="button" class="btn btn-primary add-field">Add</button>
                </td>
            </tr>
            </thead>
            @foreach($section->fields as $field)
                <tr id="field_{{ $field->id }}">
                    <td class="field_name">{{ $field->name }}</td>
                    <td class="input_type">
                        {{ $field->input_type }}
                        @if($field->input_type == 'Dropdown options')
                            <button class="btn btn-sm btn-warning view-answers" value="{{ $field->id }}">Answers</button>
                        @endif
                    </td>
                    <td class="is_required" data-required="{{$field->is_required}}" style="text-align: center;color: {{ ($field->is_required == 1)?'red':'black' }};">
                        @if($field->is_required == 1)
                            Required
                        @else
                            Optional
                        @endif
                    </td>
                    <td class="comment">{{ $field->comment }}</td>
                    <td class="db_field">{{ $field->db_field }}</td>
                    <td style="text-align: center;">
                        <button type="button" class="btn bg-green btn-sm edit-field" value="{{ $field->id }}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm delete-field" value="{{ $field->id }}">
                            <i class="fa fa-times"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
