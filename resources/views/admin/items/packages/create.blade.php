@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <h6 class="card-title mb-20">@lang('New Product Form')</h6>
                        <div class="payment-method-item">
                            <div class="payment-method-header">

                                <div class="thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview"
                                            style="background-image: url('{{ getImage(imagePath()['product']['path'], imagePath()['product']['size']) }}')">
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

                                        <div class="col-sm-12 col-md-4 col-lg-6 col-xl-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">@lang('Package Name') <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="name"
                                                        class="form-control border-radius-5" value="{{ old('name') }}" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">@lang('Package Code') <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="package_code"
                                                        class="form-control border-radius-5"
                                                        value="{{ old('package_code') }}" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">@lang('BV')(@lang('Business Volume'))<span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" name="bv"
                                                        class="form-control border-radius-5" value="{{ old('bv') }}" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">@lang('Purchase Commission Plan') <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select name="generation_id" class="form-control">
                                                        <option value="">Choice Plan</option>
                                                        @foreach ($commition_plans as $plan)
                                                            <option value="{{ $plan->id }}">{{ $plan->plan_title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">@lang('Purchase Commission Plan') <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select name="repurchase_generation_id" class="form-control">
                                                        <option value="">Choice Plan</option>
                                                        @foreach ($commition_plans as $plan)
                                                            <option value="{{ $plan->id }}">{{ $plan->plan_title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-4 col-lg-6 col-xl-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">@lang('Repurchase Able') <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <select name="re_purchase_able" class="form-control">
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                            <div class="form-group">
                                                <label>@lang('Status')</label>
                                                <input type="checkbox" data-width="100%" data-onstyle="-success"
                                                    data-offstyle="-danger" data-toggle="toggle" data-on="Active"
                                                    data-off="Inactive" name="status">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <div class="card border--dark">
                                                <h5 class="card-header bg--dark">@lang('User data')
                                                    <input type="text" name="bv"
                                                    class="form-control border-radius-5" value="{{ old('bv') }}" />
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-light float-right addUserData">
                                                        <i class="la la-fw la-plus"></i>@lang('Add New Product')
                                                    </button>
                                                </h5>
                                                <div class="card-body">
                                                    <div class="row addedField">
                                                        <div class="table-responsive--sm table-responsive">
                                                            <table class="table table--light style--two">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">@lang('Sl')</th>
                                                                        <th scope="col">@lang('Product Name')</th>
                                                                        <th scope="col">@lang('Product Price')</th>
                                                                        <th scope="col">@lang('Quantity')</th>
                                                                        <th scope="col">@lang('Amount')</th>
                                                                        <th scope="col">@lang('Action')</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                            <div class="form-group">
                                                                <label class="font-weight-bold">@lang('Cost price') <span
                                                                        class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="number" name="cost_price"
                                                                        class="form-control border-radius-5"
                                                                        value="{{ old('cost_price') }}" />
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
                                                                        value="{{ old('sale_price') }}" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                                            <div class="form-group">
                                                                <label class="font-weight-bold">@lang('Discount price') <span
                                                                        class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="number" name="sale_price"
                                                                        class="form-control border-radius-5"
                                                                        value="{{ old('sale_price') }}" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <div class="card border--dark my-2">
                                                <h5 class="card-header bg--dark">@lang('Short Description') </h5>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <textarea rows="5" class="form-control border-radius-5 nicEdit" name="short_description">{{ old('short_description') }}</textarea>
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
