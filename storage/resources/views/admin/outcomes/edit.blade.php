<div class="row">
    <form id="edit-form" method="POST">
        {{ csrf_field() }}
        <div class="alert alert-danger" style="display:none"></div>
        <div class="col-md-12">
            <div class="form-group margin-b-5 margin-t-5">
                <label for="outcome">Outcomes *</label>
                <input type="text" class="form-control required-field" name="outcome" placeholder="Outcome" value="{{ isset($record->outcome)?$record->outcome:'' }}" required>
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col-md-12 -->

        <input type="hidden" name="item" value="outcomes">
        <input type="hidden" name="item_id" value="{{ isset($record->id)?$record->id:0}}">
    </form>
</div>
