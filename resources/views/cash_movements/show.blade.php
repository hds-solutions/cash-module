@extends('backend::layouts.master')

@section('page-name', __('cash::cash_movements.title'))
@section('description', __('cash::cash_movements.description'))

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <i class="fas fa-user-plus"></i>
                @lang('cash::cash_movements.show')
            </div>
            <div class="col-6 d-flex justify-content-end">
                @if (!$resource->isCompleted())
                <a href="{{ route('backend.cash_movements.edit', $resource) }}"
                    class="btn btn-sm ml-2 btn-info">@lang('cash::cash_movements.edit')</a>
                @endif
                <a href="{{ route('backend.cash_movements.create') }}"
                    class="btn btn-sm ml-2 btn-primary">@lang('cash::cash_movements.create')</a>
            </div>
        </div>
    </div>
    <div class="card-body">

        @include('backend::components.errors')

        <div class="row">
            <div class="col-12">

                <div class="row">
                    <div class="col-4 col-lg-4">@lang('cash::cash_movement.cash_id.0'):</div>
                    <div class="col-8 col-lg-6 h4">{{ $resource->cash->cashBook->name }}</div>
                </div>

                <div class="row">
                    <div class="col-4 col-lg-4">@lang('cash::cash_movement.to_cash_id.0'):</div>
                    <div class="col-8 col-lg-6 h4">{{ $resource->toCash->cashBook->name }}</div>
                </div>

                {{-- <div class="row">
                    <div class="col-4 col-lg-4">@lang('cash::cash_movement.cash.currency.name.0'):</div>
                    <div class="col-8 col-lg-6 h4">{{ $resource->cash->cashBook->currency->name }}</div>
                </div> --}}

                <div class="row">
                    <div class="col-4 col-lg-4">@lang('cash::cash_movement.amount.0'):</div>
                    <div class="col-8 col-lg-6 h4">{{ amount($resource->amount, $resource->cash->cashBook->currency) }}</div>
                </div>

                <div class="row">
                    <div class="col-4 col-lg-4">@lang('cash::cash_movement.description.0'):</div>
                    <div class="col-8 col-lg-6 h4">{{ $resource->description }}</div>
                </div>

                <div class="row">
                    <div class="col-4 col-lg-4">@lang('cash::cash_movement.document_status.0'):</div>
                    <div class="col-8 col-lg-6 h4">{{ Document::__($resource->document_status) }}</div>
                </div>

            </div>
        </div>

        @include('backend::components.document-actions', [
            'route'     => 'backend.cash_movements.process',
            'resource'  => $resource,
        ])

    </div>
</div>

@endsection
