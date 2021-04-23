@extends('backend::layouts.master')

@section('page-name', __('cash::cash_lines.title'))

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <i class="fas fa-company-plus"></i>
                @lang('cash::cash_lines.create')
            </div>
            <div class="col-6 d-flex justify-content-end">
                {{-- <a href="{{ route('backend.cash_lines.create') }}"
                    class="btn btn-sm btn-primary">@lang('cash::cash_lines.create')</a> --}}
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('backend.cash_lines.store') }}" enctype="multipart/form-data">
            @csrf
            @onlyform
            @include('cash::cash_lines.form')
        </form>
    </div>
</div>

@endsection
