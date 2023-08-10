<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">@lang('Edit Attribute Type')</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" action="{{ route('admin.attribute_types.update',$item->id) }}">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="font-weight-bold"> @lang('Name') :</label>
                    <input type="text" class="form-control" name="name" value="{{ $item->name }}" required>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">@lang('Status')</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ $item->status==1?'selected':'' }}>Active</option>
                        <option value="0" {{ $item->status==0?'selected':'' }}>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-block btn--primary">@lang('Update')</button>
            </div>
        </form>
    </div>
</div>
