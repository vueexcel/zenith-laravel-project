<div class="row">
    <form id="edit-form" method="POST">
        {{ csrf_field() }}
        <div class="alert alert-danger" style="display:none"></div>
        <div class="col-md-12">
            <div class="form-group margin-b-5 margin-t-5">
                <label for="next_step">Ramp Up *</label>
                <input type="text" class="form-control required-field" name="ramp_up" placeholder="Ramp up Weeks" value="{{ isset($record->ramp_up)?$record->ramp_up:'' }}" required>
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col-md-12 -->

        <input type="hidden" name="item" value="ramp_up">
        <input type="hidden" name="item_id" value="{{ isset($record->id)?$record->id:0}}">
    </form>
</div>
