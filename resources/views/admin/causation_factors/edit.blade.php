<div class="row">
    <form id="edit-form" method="POST">
        {{ csrf_field() }}
        <div class="alert alert-danger" style="display:none"></div>
        <div class="col-md-12">
            <div class="form-group margin-b-5 margin-t-5">
                <label for="number">Number *</label>
                <input type="text" class="form-control required-field" name="number" placeholder="Number" value="{{ isset($record->number)?$record->number:'' }}" required>
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col-md-12 -->

        <div class="col-md-12">
            <div class="form-group margin-b-5 margin-t-5">
                <label for="causation_factor">Causation Factor *</label>
                <input type="text" class="form-control" name="causation_factor" placeholder="Causation Factor" value="{{ isset($record->causation_factor)?$record->causation_factor:''}}">
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col-md-12 -->

        <!-- /.col-md-12 -->
        <input type="hidden" name="item" value="causation_factors">
        <input type="hidden" name="item_id" value="{{ isset($record->id)?$record->id:0}}">
    </form>
</div>
