@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <form role="form" method="POST" action="{{ route('admin.sponsor_generetion_plans.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label>@lang('Title of the Plan') <span class="text-danger">*</span></label>
                                    <input type="text" name="plan_title" class="form-control"
                                        value="{{ old('plan_title') }}" placeholder="@lang('Title')" required>
                                </div>

                                <div class="form-group col-md-12 mx-auto">
                                    <label>@lang('Sponsore Commission') <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" name="sponsore_commission" class="form-control" value=""
                                            placeholder="@lang('Sponsore Commission')" {{ old('sponsore_commission') }} required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">@lang('%')</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 mx-auto">
                                    <label>@lang('Status')</label>
                                    <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                        data-toggle="toggle" data-on="Active" data-off="Inactive" name="status">
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group col-md-12 mx-auto">
                                    <label>@lang('Total Generation') (@lang('Generation Commission')) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" name="total_generation" id="total_generation"
                                            class="form-control" value="{{ old('total_generation') }}"
                                            placeholder="@lang('Total Generation')" min="1" required>
                                    </div>
                                </div>
                                <div id="plan_details"></div>
                            </div>
                        </div>

                        <div class="row pt-5 mt-5 border-top">
                            <div class="form-group col-md-12 mx-auto">
                                <button type="submit" class="btn btn--success btn-block btn-lg">@lang('Submit')</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.ptc.index') }}" class="icon-btn"><i class="fa fa-fw fa-backward"></i> @lang('Go Back') </a>
@endpush


@push('script')
    <script>
        "use strict";
        (function($) {
            $("#total_generation").on('keyup', function(e) {
                e.preventDefault();
                let total_generations = $(this).val();
                $.ajax({
                    type: 'get',
                    url: "{{ route('admin.sponsor_generetion_plans.addPlan') }}",
                    data: {
                        total_generations: total_generations,
                    },
                    dataType: "HTML",
                    success: function(data) {
                        console.log(data);
                        $("#plan_details").empty();
                        $("#plan_details").append(data);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });

        })(jQuery);
    </script>
@endpush
