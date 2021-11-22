@extends('backend::layouts.master')

@section('page-name', __('cash::cashes.title'))
@section('description', __('cash::cashes.description'))

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6 d-flex align-items-center cursor-pointer"
                data-toggle="collapse" data-target="#filters">
                <i class="fas fa-table mr-2"></i>
                @lang('cash::cashes.index')
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="{{ route('backend.cashes.create') }}"
                    class="btn btn-sm btn-outline-primary">@lang('cash::cashes.create')</a>
            </div>
        </div>
        <div class="row collapse @if (request()->has('filters')) show @endif" id="filters">
            <form action="{{ route('backend.cashes') }}"
                class="col mt-2 pt-3 pb-2 border-top">

                <x-backend-form-foreign name="filters[currency]"
                    :values="backend()->currencies()" show="name" default="{{ request('filters.currency') }}"

                    label="cash::cash.currency_id.0"
                    placeholder="cash::cash.currency_id._"
                    {{-- helper="cash::cash.currency_id.?" --}} />

                <x-backend-form-foreign name="filters[cash_book]"
                    :values="$cashBooks" show="name" default="{{ request('filters.cash_book') }}"

                    label="cash::cash.cash_book_id.0"
                    placeholder="cash::cash.cash_book_id._"
                    {{-- helper="cash::cash.cash_book_id.?" --}} />

                <button type="submit"
                    class="btn btn-sm btn-outline-primary">Filtrar</button>

                <button type="reset"
                    class="btn btn-sm btn-outline-secondary btn-hover-danger">Limpiar filtros</button>
            </form>
        </div>
    </div>
    <div class="card-body">
        @if ($count)
            <div class="table-responsive">
                {{ $dataTable->table() }}
                @include('backend::components.datatable-actions', [
                    'resource'  => 'cashes',
                    'actions'   => [ 'show', 'update', 'delete' ],
                    'label'     => '{resource.description}',
                ])
            </div>
        @else
            <div class="text-center m-t-30 m-b-30 p-b-10">
                <h2><i class="fas fa-table text-custom"></i></h2>
                <h3>@lang('backend.empty.title')</h3>
                <p class="text-muted">
                    @lang('backend.empty.description')
                    <a href="{{ route('backend.cashes.create') }}" class="text-custom">
                        <ins>@lang('cash::cashes.create')</ins>
                    </a>
                </p>
            </div>
        @endif
    </div>
</div>

@endsection

@push('config-scripts')
{{ $dataTable->scripts() }}
@endpush
