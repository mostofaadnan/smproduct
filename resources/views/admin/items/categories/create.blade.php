 <div class="modal-dialog" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title">@lang('New Item Category')</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
         <form method="post" action="{{ route('admin.item_categories.store') }}">
             @csrf
             <div class="modal-body">
                 <div class="form-group">
                     <label class="font-weight-bold"> @lang('Category Name') :</label>
                     <input type="text" class="form-control " name="name"  placeholder="@lang('Category Name')" required>
                 </div>
                 <div class="form-group">
                     <label class="font-weight-bold">@lang('Parent Category')</label>
                     <select name="parent_id" class="form-control">
                        <option value="">Choice Parent Category</option>
                         @foreach ($categories as $category)
                             <option value="{{ $category->id }}">{{ $category->name }}</option>
                         @endforeach
                     </select>
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
