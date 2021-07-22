@extends('backend::layouts.master')

@section('page-name', __('cash::cashes.title'))

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6 d-flex align-items-center">
                <i class="fas fa-company-plus"></i>
                @lang('cash::cashes.create')
            </div>
            <div class="col-6 d-flex justify-content-end">
                {{-- <a href="{{ route('backend.cashes.create') }}"
                    class="btn btn-sm btn-outline-primary">@lang('cash::cashes.create')</a> --}}
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('backend.cashes.store') }}" enctype="multipart/form-data">
            @csrf
            @onlyform
            @include('cash::cashes.form')
        </form>
    </div>
</div>

@endsection
