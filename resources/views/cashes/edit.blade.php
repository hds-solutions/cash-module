@extends('backend::layouts.master')

@section('page-name', __('cash::cashes.title'))

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <i class="fas fa-company-plus"></i>
                @lang('cash::cashes.edit')
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="{{ route('backend.cashes.create') }}"
                    class="btn btn-sm btn-primary">@lang('cash::cashes.add')</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('backend.cashes.update', $resource->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            @include('cash::cashes.form')
        </form>
    </div>
</div>

@endsection