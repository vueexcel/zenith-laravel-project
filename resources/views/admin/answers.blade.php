<table class="table table-bordered table-striped" id="answers_table">
    <tr><th colspan="2">Question: {{ $field->name }}</th></tr>
    <tr data-field="{{ $field->id }}">
        <td>
            <input type="text" name="answer_name" class="form-control" placeholder="Answer">
            <input type="hidden" name="answer_id" value="0">
        </td>
        <td style="text-align: center">
            <button type="button" class="btn btn-primary add-answer">Add</button>
        </td>
    </tr>
    @foreach($field->answers as $answer)
        <tr id="answer_{{$answer->id}}">
            <td>
                <i class="fa fa-check-circle"></i>
                <span id="span{{ $answer->id }}" style="display: inline; margin-left: 10px;">{{ $answer->name }}</span>
            </td>
            <td style="text-align: center;">
                <button type="button" class="btn bg-green btn-sm edit-answer" value="{{ $answer->id }}"
                        data-answer="{{ $answer->name }}">
                    <i class="fa fa-edit"></i>
                </button>
                <button type="button" class="btn btn-danger btn-sm delete-answer" value="{{ $answer->id }}">
                    <i class="fa fa-times"></i>
                </button>
            </td>
        </tr>
    @endforeach
</table>
