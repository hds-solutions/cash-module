@extends('backend::layouts.master')

@section('page-name', __('cash::cashes.title'))

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6 d-flex align-items-center">
                <i class="fas fa-company-plus mr-2"></i>
                @lang('cash::cashes.edit')
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="{{ route('backend.cashes.create') }}"
                    class="btn btn-sm btn-outline-primary">@lang('cash::cashes.create')</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('backend.cashes.update', $resource) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('cash::cashes.form')
        </form>
    </div>
</div>

@endsection
