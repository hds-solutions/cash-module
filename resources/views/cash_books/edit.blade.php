@extends('backend::layouts.master')

@section('page-name', __('cash::cash_books.title'))

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <i class="fas fa-company-plus"></i>
                @lang('cash::cash_books.edit')
            </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="{{ route('backend.cash_books.create') }}"
                    class="btn btn-sm btn-primary">@lang('cash::cash_books.add')</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('backend.cash_books.update', $resource->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            @include('cash::cash_books.form')
        </form>
    </div>
</div>

@endsection