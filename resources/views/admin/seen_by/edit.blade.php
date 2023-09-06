<div class="row">
    <form id="edit-form" method="POST">
        {{ csrf_field() }}
        <div class="alert alert-danger" style="display:none"></div>
        <div class="col-md-12">
            <div class="form-group margin-b-5 margin-t-5">
                <label for="seen_by">Seen By *</label>
                <input type="text" class="form-control required-field" name="seen_by" placeholder="Seen By" value="{{ isset($record->seen_by)?$record->seen_by:'' }}" required>
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col-md-12 -->

        <input type="hidden" name="item" value="seen_by">
        <input type="hidden" name="item_id" value="{{ isset($record->id)?$record->id:0}}">
    </form>
</div>
