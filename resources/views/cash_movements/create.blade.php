@extends('backend::layouts.master')

@section('page-name', __('cash::cash_movements.title'))

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6 d-flex align-items-center">
                <i class="fas fa-company-plus"></i>
                @lang('cash::cash_movements.create')
            </div>
            <div class="col-6 d-flex justify-content-end">
                {{-- <a href="{{ route('backend.cash_movements.create') }}"
                    class="btn btn-sm btn-outline-primary">@lang('cash::cash_movements.create')</a> --}}
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('backend.cash_movements.store') }}" enctype="multipart/form-data">
            @csrf
            @onlyform
            @include('cash::cash_movements.form')
        </form>
    </div>
</div>

@endsection
