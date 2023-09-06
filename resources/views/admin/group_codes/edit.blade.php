<div class="row">
    <form id="edit-form" method="POST">
        {{ csrf_field() }}
        <div class="alert alert-danger" style="display:none"></div>
        <div class="col-md-12">
            <div class="form-group margin-b-5 margin-t-5">
                <label for="group_code">Group Code *</label>
                <input type="text" class="form-control required-field" name="group_code" placeholder="Group Code" value="{{ isset($record->group_code)?$record->group_code:'' }}" required>
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col-md-12 -->

        <div class="col-md-12">
            <div class="form-group margin-b-5 margin-t-5">
                <label for="s_generation">Generation</label>
                <input type="number" class="form-control" name="s_generation" placeholder="Generation" value="{{ isset($record->s_generation)?$record->s_generation:''}}">
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col-md-12 -->

        <div class="col-md-12">
            <div class="form-group margin-b-5 margin-t-5">
                <label for="s_guid">Guid</label>
                <input type="text" class="form-control" name="s_guid" placeholder="Guid" value="{{ isset($record->s_guid)?$record->s_guid:''}}">
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col-md-12 -->

        <div class="col-md-12">
            <div class="form-group margin-b-5 margin-t-5">
                <label for="s_lineage">Lineage</label>
                <input type="text" class="form-control" name="s_lineage" placeholder="Lineage" value="{{ isset($record->s_lineage)?$record->s_lineage:''}}">
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col-md-12 -->

        <div class="col-md-12">
            <div class="form-group margin-b-5 margin-t-5">
                <label for="section">Section</label>
                <input type="text" class="form-control" name="section" placeholder="Section" value="{{ isset($record->section)?$record->section:''}}">
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col-md-12 -->

        <div class="col-md-12">
            <div class="form-group margin-b-5 margin-t-5">
                <label for="department">Department</label>
                <input type="text" class="form-control" name="department" placeholder="Department" value="{{ isset($record->department)?$record->department:''}}">
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col-md-12 -->

        <div class="col-md-12">
            <div class="form-group margin-b-5 margin-t-5">
                <label for="division">Division</label>
                <input type="text" class="form-control" name="division" placeholder="Division" value="{{ isset($record->division)?$record->division:''}}">
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col-md-12 -->
        <input type="hidden" name="item" value="group_codes">
        <input type="hidden" name="item_id" value="{{ isset($record->id)?$record->id:0}}">
    </form>
</div>
