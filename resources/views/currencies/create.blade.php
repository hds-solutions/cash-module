@extends('backend::layouts.master')

@section('page-name', __('cash::currencies.title'))

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <i class="fas fa-company-plus"></i>
                @lang('cash::currencies.create')
            </div>
            <div class="col-6 d-flex justify-content-end">
                {{-- <a href="{{ route('backend.currencies.create') }}"
                    class="btn btn-sm btn-primary">@lang('cash::currencies.create')</a> --}}
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('backend.currencies.store') }}" enctype="multipart/form-data">
            @csrf
            @onlyform
            @include('cash::currencies.form')
        </form>
    </div>
</div>

@endsection
