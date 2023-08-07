@extends('admin.layouts.app')
@section('panel')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="table-responsive--sm">
                <table class="table table--light style--two">
                    <thead>
                        <tr>
                            <th scope="col">@lang('Title')</th>
                            <th scope="col">@lang('Sponsore Commission')</th>
                            <th scope="col">@lang('Total Generation')</th>
                            <th scope="col">@lang('Status')</th>
                            <th scope="col">@lang('Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                        <tr>
                            <td data-label="@lang('Title')">{{shortDescription($item->plan_title,20)}}</td>
                            <td data-label="@lang('Sponsore Commission')">{{$item->sponsore_commission}} @lang('%')</td>
                            <td data-label="@lang('Total Generation')">{{$item->total_generation}}</td>
                            <td data-label="@lang('Status')">
                                @if($item->status == 1)
                                    <span class="font-weight-normal text--small badge badge--success">@lang('active')</span>
                                @else
                                    <span class="font-weight-normal text--small badge badge--warning">@lang('inactive')</span>
                                @endif
                            </td>
                            <td data-label="@lang('Action')"><a class="icon-btn" href="{{route('admin.sponsor_generetion_plans.edit',$item->id)}}"><i class="la la-pen"></i></a></td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-muted text-center" colspan="100%">{{ __($empty_message) }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer py-4">
                <nav aria-label="...">
                    {{ $items->links('admin.partials.paginate') }}
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb-plugins')
    <a class="btn btn-sm btn--success" href="{{route('admin.sponsor_generetion_plans.create')}}"><i class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
@endpush

