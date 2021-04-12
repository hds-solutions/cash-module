@extends('backend::layouts.master')

@section('page-name', __('cash::cashmovements.title'))

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <i class="fas fa-company-plus"></i>
                @lang('cash::cashmovements.create')
            </div>
            <div class="col-6 d-flex justify-content-end">
                {{-- <a href="{{ route('backend.cashmovements.create') }}"
                    class="btn btn-sm btn-primary">@lang('cash::cashmovements.add')</a> --}}
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('backend.cashmovements.store') }}" enctype="multipart/form-data">
            @csrf
            @onlyform
            @include('cash::cashmovements.form')
        </form>
    </div>
</div>

@endsection
