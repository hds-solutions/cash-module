@extends('backend::layouts.master')

@section('page-name', __('cash::cash_lines.title'))

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <i class="fas fa-company-plus"></i>
                @lang('cash::cash_lines.edit')
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="{{ route('backend.cash_lines.create') }}"
                    class="btn btn-sm btn-primary">@lang('cash::cash_lines.add')</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('backend.cash_lines.update', $resource->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            @include('cash::cash_lines.form')
        </form>
    </div>
</div>

@endsection
