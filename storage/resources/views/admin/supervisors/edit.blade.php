<div class="row">
    <form id="edit-form" method="POST">
        {{ csrf_field() }}
        <div class="alert alert-danger" style="display:none"></div>
        <div class="col-md-12">
            <div class="form-group margin-b-5 margin-t-5">
                <label for="surname">Surname *</label>
                <input type="text" class="form-control required-field" name="surname" placeholder="Surname" value="{{ isset($record->surname)?$record->surname:'' }}" required>
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col-md-12 -->

        <div class="col-md-12">
            <div class="form-group margin-b-5 margin-t-5">
                <label for="name">Name *</label>
                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ isset($record->name)?$record->name:''}}" required>
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col-md-12 -->

        <div class="col-md-12">
            <div class="form-group margin-b-5 margin-t-5">
                <label for="occupation">Occupation</label>
                <input type="text" class="form-control" name="occupation" placeholder="Occupation" value="{{ isset($record->occupation)?$record->occupation:''}}">
            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col-md-12 -->

        <div class="col-md-12">
            <div class="form-group margin-b-5 margin-t-5">
                <label for="s_lineage">Group Code</label>
                <select name="group_code_id" class="form-control select2" style="width: 100%">
                @foreach($group_codes as $group_code)
                    <option value="{{$group_code->id}}" {{(isset($record->group_code_id) && $record->group_code_id == $group_code->id )? 'selected':''}}>{{$group_code->group_code}}</option>
                @endforeach
                </select>

            </div>
            <!-- /.form-group -->
        </div>
        <!-- /.col-md-12 -->


        <!-- /.col-md-12 -->
        <input type="hidden" name="item" value="supervisors">
        <input type="hidden" name="item_id" value="{{ isset($record->id)?$record->id:0}}">
    </form>
</div>
