@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('Sl')</th>
                                    <th scope="col">@lang('Product')</th>
                                    <th scope="col">@lang('Category')</th>
                                    <th scope="col">@lang('Sub-Category')</th>
                                    <th scope="col">@lang('Unit')</th>
                                    <th scope="col">@lang('Cost Price')</th>
                                    <th scope="col">@lang('Sale Price') </th>
                                    <th scope="col">@lang('Discount Price') </th>
                                    <th scope="col">@lang('Status')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $key=>$item)
                                    <tr>
                                        <td data-label="@lang('Sl')" class="font-weight-bold">{{ $key + 1 }}
                                        </td>
                                        <td data-label="@lang('Product')">
                                            <div class="user">
                                                <div class="thumb"><img
                                                        src="{{ getImage(imagePath()['product']['path'] . '/' . $item->image, imagePath()['product']['size']) }}"
                                                        alt="@lang('image')"></div>

                                                <span class="name">{{ __($item->name) }}</span>
                                            </div>
                                        </td>
                                        <td data-label="@lang('Category')" class="font-weight-bold">
                                            {{ __($item->category ? $item->category->name : '') }}</td>
                                        <td data-label="@lang('Sub-Category')" class="font-weight-bold">
                                            {{ __($item->subcategory ? $item->subcategory->name : '') }}</td>
                                        <td data-label="@lang('Unit')" class="font-weight-bold">
                                            {{ __($item->unit ? $item->unit->name : '') }}</td>
                                        <td data-label="@lang('Cost Price')" class="font-weight-bold">{{ $item->cost_price }}
                                        </td>
                                        <td data-label="@lang('Sale Price')" class="font-weight-bold">{{ $item->sale_price }}
                                        </td>
                                        <td data-label="@lang('Discount Price')" class="font-weight-bold">
                                            {{ $item->discount_price }}</td>
                                        <td data-label="@lang('Status')">
                                            @if ($item->status == 1)
                                                <span
                                                    class="text--small badge font-weight-normal badge--success">@lang('Active')</span>
                                            @else
                                                <span
                                                    class="text--small badge font-weight-normal badge--warning">@lang('Disabled')</span>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Action')">
                                            <a href="{{ route('admin.products.edit', $item->id) }}" class="icon-btn ml-1"
                                                data-toggle="tooltip" data-original-title="@lang('Edit')"><i
                                                    class="las la-pen"></i></a>
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
            </div><!-- card end -->
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a class="btn btn-sm btn--primary box--shadow1 text--small" href="{{ route('admin.products.create') }}"><i
            class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
@endpush
