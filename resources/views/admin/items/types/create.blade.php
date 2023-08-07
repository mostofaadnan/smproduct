 <div class="modal-dialog" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title">@lang('New Item Type')</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
         <form method="post" action="{{ route('admin.item_types.store') }}">
             @csrf
             <div class="modal-body">
                 <div class="form-group">
                     <label class="font-weight-bold"> @lang('Name') :</label>
                     <input type="text" class="form-control " name="name" required>
                 </div>
                 <div class="form-group">
                     <label class="font-weight-bold">@lang('Status')</label>
                     <select name="status" class="form-control">
                         <option value="1">Active</option>
                         <option value="0">Inactive</option>
                     </select>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="submit" class="btn btn-block btn--primary">@lang('Submit')</button>
             </div>
         </form>
     </div>
 </div>
