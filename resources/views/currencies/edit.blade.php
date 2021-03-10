@extends('backend::layouts.master')

@section('page-name', __('cash::currencies.title'))

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <i class="fas fa-company-plus"></i>
                @lang('cash::currencies.edit')
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="{{ route('backend.currencies.create') }}"
                    class="btn btn-sm btn-primary">@lang('cash::currencies.add')</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('backend.currencies.update', $resource->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            @include('backend::currencies.form')
        </form>
    </div>
</div>

@endsection