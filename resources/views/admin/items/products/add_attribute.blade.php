<div class="col-md-12 user-data">
    <div class="form-group">
        <div class="input-group mb-md-0 mb-4">
            <div class="col-md-5 mt-md-0 mt-2">
                <select name="attribute_type[]" class="form-control">
                    @foreach ($attributetypes as $type)
                        <option value="{{ $type->name }}"> {{ __($type->name) }} </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <input name="attribute_value[]" class="form-control" type="text" value="" required
                    placeholder="@lang('Attribute Value')">
            </div>
            <div class="col-md-2 mt-md-0 mt-2 text-right">
                <span class="input-group-btn">
                    <button class="btn btn--danger btn-lg removeBtn w-100" type="button">
                        <i class="fa fa-times"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>
</div>
