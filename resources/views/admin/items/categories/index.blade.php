@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('Sl')</th>
                                    <th scope="col">@lang('Name')</th>
                                    <th scope="col">@lang('Parent Category')</th>
                                    <th scope="col">@lang('Status')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $key => $item)
                                    <tr>
                                        <td data-label="@lang('Sl')">{{ $key + 1 }}</td>
                                        <td data-label="@lang('Name')">{{ $item->name }}</td>
                                        <td data-label="@lang('Parent Category')">{{ $item->parent?$item->parent->name:'' }}</td>
                                        <td data-label="@lang('Status')">
                                            @if ($item->status == 1)
                                                <span
                                                    class="text--small badge font-weight-normal badge--success">@lang('Active')</span>
                                            @else
                                                <span
                                                    class="text--small badge font-weight-normal badge--danger">@lang('Inactive')</span>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Action')">
                                            <a href="{{ route('admin.item_categories.edit', $item->id) }}" type="button"
                                                class="icon-btn edit btn_modal" data-toggle="tooltip"
                                                data-original-title="Edit">
                                                <i class="la la-pencil"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($empty_message) }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ $items->links('admin.partials.paginate') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.item_categories.create') }}" class="btn btn-sm btn--success btn_modal" type="modal"><i
            class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
@endpush
