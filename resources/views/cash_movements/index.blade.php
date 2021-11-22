@extends('backend::layouts.master')

@section('page-name', __('cash::cash_movements.title'))
@section('description', __('cash::cash_movements.description'))

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6 d-flex align-items-center cursor-pointer"
                data-toggle="collapse" data-target="#filters">
                <i class="fas fa-table mr-2"></i>
                @lang('cash::cash_movements.index')
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="{{ route('backend.cash_movements.create') }}"
                    class="btn btn-sm btn-outline-primary">@lang('cash::cash_movements.create')</a>
            </div>
        </div>
        <div class="row collapse @if (request()->has('filters')) show @endif" id="filters">
            <form action="{{ route('backend.cash_movements') }}"
                class="col mt-2 pt-3 pb-2 border-top">

                <x-backend-form-foreign name="filters[cash_book]"
                    :values="$cashBooks" show="name" default="{{ request('filters.cash_book') }}"

                    label="cash::cash_movement.cash_id.0"
                    placeholder="cash::cash_movement.cash_id._"
                    {{-- helper="cash::cash_movement.cash_id.?" --}} />

                <x-backend-form-foreign name="filters[to_cash_book]"
                    :values="$cashBooks" show="name" default="{{ request('filters.to_cash_book') }}"

                    label="cash::cash_movement.to_cash_id.0"
                    placeholder="cash::cash_movement.to_cash_id._"
                    {{-- helper="cash::cash_movement.to_cash_id.?" --}} />

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
                    'resource'  => 'cash_movements',
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
                    <a href="{{ route('backend.cash_movements.create') }}" class="text-custom">
                        <ins>@lang('cash::cash_movements.create')</ins>
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
