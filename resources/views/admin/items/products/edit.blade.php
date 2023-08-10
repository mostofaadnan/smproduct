@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.products.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <h6 class="card-title mb-20">@lang('Edit Product Form')</h6>
                        <div class="payment-method-item">
                            <div class="payment-method-header d-flex flex-wrap">

                                <div class="thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview"
                                            style="background-image: url('{{ getImage(imagePath()['product']['path'] . '/' . $item->image, imagePath()['product']['path']) }}')">
                                        </div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" name="image" class="profilePicUpload" id="image"
                                            accept=".png, .jpg, .jpeg" />
                                        <label for="image" class="bg-primary"><i class="la la-pencil"></i></label>
                                    </div>
                                </div>

                                <div class="payment-method-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">@lang('Product Name') <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="name"
                                                        class="form-control border-radius-5" value="{{ $item->name }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">@lang('Product SKU') <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="sku"
                                                        class="form-control border-radius-5" value="{{ $item->sku }}" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">@lang('Category') <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select name="category_id" class="form-control" id="category_id">
                                                        <option value="">Choice Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ $item->category_id == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">@lang('Sub-Category') <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select name="subcategory_id" class="form-control" id="sub_category_id">
                                                        <option value="">Choice Sub-Category</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">@lang('Unit') <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select name="unit_id" class="form-control">
                                                        <option value="">Choice Unit</option>
                                                        @foreach ($units as $unit)
                                                            <option value="{{ $unit->id }}"
                                                                {{ $item->unit_id == $unit->id ? 'selected' : '' }}>
                                                                {{ $unit->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">@lang('Cost price') <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="number" name="cost_price"
                                                        class="form-control border-radius-5"
                                                        value="{{ $item->cost_price }}" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">@lang('Sale price') <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="number" name="sale_price"
                                                        class="form-control border-radius-5"
                                                        value="{{ $item->sale_price }}" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">@lang('Discount Price') <span
                                                        class="text-danger"></span></label>
                                                <div class="input-group">
                                                    <input type="number" name="discount_price"
                                                        class="form-control border-radius-5"
                                                        value="{{ $item->discount_price }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                            <div class="form-group">
                                                <label>@lang('Status')</label>
                                                <input type="checkbox" data-width="100%" data-onstyle="-success"
                                                    data-offstyle="-danger" data-toggle="toggle" data-on="Active"
                                                    data-off="Inactive" @if ($item->status) checked @endif name="status">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6">
                                            <div class="card border--dark my-2">
                                                <h5 class="card-header bg--dark">@lang('Short Description') </h5>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <textarea rows="5" class="form-control border-radius-5 nicEdit" name="short_description">{{ $item->short_description }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6">
                                            <div class="card border--dark">
                                                <h5 class="card-header bg--dark">@lang('User data')
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-light float-right addUserData">
                                                        <i class="la la-fw la-plus"></i>@lang('Add New')
                                                    </button>
                                                </h5>
                                                <div class="card-body">
                                                    <div class="row addedField">
                                                        @if ($item->user_data != null)
                                                            @foreach ($item->user_data as $k => $v)
                                                           
                                                            <div class="col-md-12 user-data">
                                                                <div class="form-group">
                                                                    <div class="input-group mb-md-0 mb-4">
                                                                        <div class="col-md-5 mt-md-0 mt-2">
                                                                            <select name="attribute_type[]" class="form-control">
                                                                                @foreach ($attributetypes as $type)
                                                                                    <option value="{{ $type->name }}" {{ $v->attribute_type==$type->name?'selected':'' }}> {{ __($type->name) }} </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <input name="attribute_value[]" class="form-control" type="text" value="{{ $v->attribute_value }}" required
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
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn--primary btn-block">@lang('Save Product')</button>
                    </div>
                </form>
            </div><!-- card end -->
        </div>
    </div>
@endsection


@push('breadcrumb-plugins')
    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn--primary box--shadow1 text--small">
        <i class="la la-fw la-backward"></i> @lang('Go Back')
    </a>
@endpush

@push('script')
    <script>
        'use strict';
        (function($) {

            $("#category_id").on('change', function() {
                let id = $("#category_id").val();
                $.ajax({
                    url: "{{ url('admin/item_categories/get-subcategory') }}" + '/' + id,
                    type: 'GET',
                    dataType: "json",
                    success: function(data) {
                        $("#sub_category_id").empty();
                        $("#sub_category_id").append(
                            '<option value="">Choose Sub-Category</option>');
                        data.child.forEach(function(value) {
                            $("#sub_category_id").append('<option value="' + value.id +
                                '">' +
                                value.name + '</option>');
                        })
                    }
                });
            })

            $('.addUserData').on('click', function() {
                $.ajax({
                    type: 'get',
                    url: "{{ route('admin.products.AddAttribute') }}",
                    dataType: "HTML",
                    success: function(data) {
                        $(".addedField").append(data);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });

            $(document).on('click', '.removeBtn', function() {
                $(this).closest('.user-data').remove();
            });


        })(jQuery)
    </script>
@endpush
