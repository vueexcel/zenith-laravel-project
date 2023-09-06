<div class="row">
    <form id="edit-form" method="POST">
        {{ csrf_field() }}
        <div class="alert alert-danger" style="display:none"></div>
        <div class="col-md-12">
            <div class="form-group margin-b-5 margin-t-5">
                <label for="mss_number">Mss Number *</label>
                <input type="text" class="form-control required-field" name="mss_number" placeholder="Mss Number" value="{{ isset($record->mss_number)?$record->mss_number:'' }}" required>
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col-md-12 -->

        <div class="col-md-12">
            <div class="form-group margin-b-5 margin-t-5">
                <label for="mss_causation">Mss Causation *</label>
                <input type="text" class="form-control required-field" name="mss_causation" placeholder="Mss Causation" value="{{ isset($record->mss_causation)?$record->mss_causation:'' }}" required>
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col-md-12 -->

        <input type="hidden" name="item" value="mss_causation">
        <input type="hidden" name="item_id" value="{{ isset($record->id)?$record->id:0}}">
    </form>
</div>
